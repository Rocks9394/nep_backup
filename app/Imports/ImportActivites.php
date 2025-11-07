<?php

namespace App\Imports;

use DB;
use Auth;
use DateTime;

use App\Models\Sclass;
use App\Models\School;
use App\Models\Activity;
use App\Models\Sstudent;
use App\Models\ScustomClass;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Exports\ExportImproperData;


class ImportActivites implements ToCollection, WithHeadingRow  {

// class ImportActivites implements ToCollection, WithHeadingRow , WithChunkReading, ShouldQueue {

    protected $action, $teachingIds, $classIds;
    protected $duplicates = [], $imported = [], $failed = [];
    protected int $totalRecords = 0;

    public function __construct($action, $teachingIds, $classIds)
    {

        $this->action = $action;
        $this->teachingIds = $teachingIds;
        $this->classIds = $classIds;
    }


    public function getTotalRecords(): int
    {
        return $this->totalRecords;
    }

    public function getDuplicateRecords()
    {
        return $this->duplicates;
    }

    public function getImportedData()
    {
        return $this->imported;
    }

    public function imProperFormatData()
    {
        return $this->failed;
    }


    public function collection(Collection $rows) {

        

        $invalidData = collect();

        $skills = DB::table('skillareas')->pluck('id', 'name')->mapWithKeys(fn($id, $name) => [strtolower(trim($name)) => $id]);
        $sports = DB::table('sports')->pluck('id', 'name')->mapWithKeys(fn($id, $name) => [strtolower(trim($name)) => $id]);
        $techniques = DB::table('techniques')->pluck('id', 'name')->mapWithKeys(fn($id, $name) => [strtolower(trim($name)) => $id]);


        $rows->each(function ($row, $key) use ($invalidData, $skills, $sports, $techniques) {
            
            $this->totalRecords++;

            $validation = $this->validateRow($row, $this->action);
            if (!$validation->passes()) {

                $this->addValidationErrors($row, $key, $validation->errors()->all());
                return;
            }

            $skillAreaName = strtolower(trim($row['skill_area']));
            $sportName     = strtolower(trim($row['skill_sport']));
            $techniqueName = strtolower(trim($row['techniques']));

            $activityTitle = trim($row['activity']);
            $url           = $row['video_url'] ?? null;

            $skillAreaId   = $skills[$skillAreaName] ?? null;
            $sportId       = $sports[$sportName] ?? null;
            $techniqueId   = $techniques[$techniqueName] ?? null;


            if (!$skillAreaId || !$sportId || !$techniqueId) {
                $this->addMappingError($row, $key, $skillAreaId, $sportId, $techniqueId);
                return;
            }


            $activityData = [
                'title' => $activityTitle,
                'url'   => $url,
                'user_id' => 2,
                'status'  => 1,
            ];

            if(!empty($this->teachingIds)){
                // $activityData['teach_id'] = $this->teachingIds;
                $activityData['teach_id'] = implode(',', $this->teachingIds);
            }


            if (!empty($row['description'])) {
                $activityData['description'] = $row['description'];
            }

            if (!empty($row['learning_outcomes'])) {
                $activityData['learning_outcomes'] = $row['learning_outcomes'];
            }


            $existingActivity = DB::table('activity')
            ->join('activity_technique', 'activity_technique.act_id', '=', 'activity.id')
            ->where('activity.title', $activityTitle)
            ->where('activity_technique.skillarea_id', $skillAreaId)
            ->where('activity_technique.sportskill_id', $sportId)
            ->where('activity_technique.technique_id', $techniqueId)
            ->select('activity.*')
            ->first();

            $existingActivity = $existingActivity ? Activity::find($existingActivity->id) : null;

            if (!empty($row['act_id'])) {
                if ($existingActivity && $existingActivity->id != $row['act_id']) {
                    $this->errormessage[] = [
                        'row' => $key + 1,
                        'errors' => 'Provided Activity ID does not match the existing mapped record.'
                    ];
                    $this->failed[] = array_merge($row->toArray(), ['Error' => 'Activity ID mismatch with mapped values']);
                    return;
                }

                if (!$existingActivity) {
                    $existingActivity = Activity::find($row['act_id']);
                }
            }


            if ($existingActivity) {
               
                $this->duplicates[] = array_merge($row->toArray(), [
                    'Error' =>  [
                        'Matched Activity ID' => $existingActivity->id,
                        'Note' => 'Duplicate activity based on title and mapping'
                    ]  
                ]);


                if ($this->action === 'preview' || $this->action === 'skipandimport') {
                    return; 
                }

                if ($this->action === 'override') {
                    
                    $existingActivity->update($activityData);
                    $this->imported[] = $existingActivity->toArray();
                
                }

                return;

            } else {
  
                if ($this->action === 'preview') {
                    return; 
                }

            
                $newRecord = Activity::create($activityData);
                $this->imported[] = $newRecord->toArray();

                foreach ($this->classIds as $classId) {
                    $exists = DB::table('activity_technique')
                        ->where('act_id', $newRecord->id)
                        ->where('technique_id', $techniqueId)
                        ->where('class_id', $classId)
                        ->where('skillarea_id', $skillAreaId)
                        ->where('sportskill_id', $sportId)
                        ->exists();

                    if (!$exists) {
                        DB::table('activity_technique')->insert([
                            'act_id'        => $newRecord->id,
                            'technique_id'  => $techniqueId,
                            'class_id'      => $classId,
                            'skillarea_id'  => $skillAreaId,
                            'sportskill_id' => $sportId,
                        ]);
                    }
                }
                
            }            
        });

        if (!empty($this->duplicates)) {
            Storage::disk('local')->put('duplicate_records.json', json_encode($this->duplicates));
        }

        if (!empty($this->failed)) {
            Storage::disk('local')->put('error_activity.json', json_encode($this->failed));
        }
    }


    protected function addValidationErrors($row, $key, array $errors)  {

        foreach ($errors as $error) {
            $this->errormessage[] = [
                'row' => $key + 1,
                'errors' => $error,
            ];
        }

        $this->failed[] = array_merge($row->toArray(), [
            'Error' => implode(', ', $errors)
        ]);
    }

    protected function addMappingError($row, $key, $skillAreaId, $sportId, $techniqueId) {
        $missing = [];
        if (!$skillAreaId) $missing[] = 'Skill Area ID';
        if (!$sportId) $missing[] = 'Sport ID';
        if (!$techniqueId) $missing[] = 'Technique ID';

        $this->errormessage[] = [
            'row' => $key + 1,
            'errors' => 'Invalid mapping for: ' . implode(', ', $missing)
        ];

        $this->failed[] = array_merge(
            $row->toArray(),
            [
                'Error' => sprintf(
                    'Invalid ID mapping - SkillAreaID: %s, SportID: %s, TechniqueID: %s',
                    $skillAreaId ?: 'null',
                    $sportId ?: 'null',
                    $techniqueId ?: 'null'
                )
            ]
        );
    }



    public function validateRow(Collection $row, $action)  {

        $validator = \Validator::make(
            $row->toArray(),
            $this->rules($action),
            $this->customValidationMessages()
        );

        return $validator;
    }



    public function rules($action): array {

        $rules = [];

        $rules = [
            'skill_area'         => 'required|string|max:255',
            'skill_sport'       => 'required|string|max:255',
            'techniques'         => 'required|string|max:255',
            'activity'           => 'required|string|max:255', 
            // 'image'              => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', 
            'video_url'          => 'nullable|max:500', 

            'learning_outcomes'  => 'nullable|string|max:1000',
            'description'        => 'nullable|string|max:2000', 
            'variation'          => 'nullable|string|max:2000',
            'coaching'           => 'nullable|string|max:1000', 
            'equipment'          => 'nullable|string|max:1000',
            'status'             => 'nullable|in:0,1'
        ];

        return $rules;
    }


    public function customValidationMessages() {
        return [
            'skill_area.required'         => 'Skill Area is required.',
            'skill_area.string'           => 'Skill Area must be a valid text.',

            'skill_sports.required'       => 'Skill Sports is required.',
            // 'skill_sports.in'             => 'Skill Sports must be either Male or Female.',

            'techniques.required'         => 'Techniques field is required.',
            'techniques.string'           => 'Techniques must be a valid text.',

            'activity.required'           => 'Activity Title is required.',
            'activity.string'             => 'Activity Title must be a valid text.',

            // 'image.image'                 => 'Image must be a valid image file.',
            // 'image.mimes'                 => 'Image must be a file of type: jpg, jpeg, png, gif.',
            // 'image.max'                   => 'Image size should not exceed 2MB.',

            // 'video_url.url'               => 'Video URL must be a valid URL.',
            'video_url.max'               => 'Video URL should not exceed 500 characters.',

            // 'learning_outcomes.required'  => 'Learning Outcomes are required.',
            'learning_outcomes.string'    => 'Learning Outcomes must be a valid text.',

            // 'description.required'        => 'Description is required.',
            'description.string'          => 'Description must be a valid text.',

            'variation.string'            => 'Variation must be a valid text.',
            'variation.max'               => 'Variation should not exceed 1000 characters.',

            'coaching.string'             => 'Coaching points must be a valid text.',
            'coaching.max'                => 'Coaching points should not exceed 1000 characters.',

            'equipment.string'            => 'Equipment must be a valid text.',
            'equipment.max'               => 'Equipment should not exceed 1000 characters.',

            // 'status.required'             => 'Status is required.',
            'status.in'                   => 'Status must be 1 or 0.',
        ];
    }

    
}


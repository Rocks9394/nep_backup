<?php

namespace App\Imports;

use DB;
use App\Models\Sclass;
use App\Models\Sstudent;
use App\Models\ScustomClass;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithStartRow;
use DateTime;
use Auth;
use App\Models\School;

use PhpOffice\PhpSpreadsheet\Shared\Date;


class ImportStudentProfile implements ToCollection, WithHeadingRow  {

    protected $schoolId;
    protected $action;
    protected $insertedRowIds = [];
    protected $importedData = [];
    protected $imProperFormatData = [];

    function __construct($schoolId,$action){
        $this->school_id = $schoolId;
        $this->action = $action;
    }

    public function getInsertedRowIds() {
        return $this->insertedRowIds;
    }

    public function getImportedData(){
        return $this->importedData;
    }

    public function imProperFormatData(){
        return $this->imProperFormatData;
    }

    public function checkduplciate(){

    }

    public function convertRomanToNumeric($roman) {

        $map = array('X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = 0;
        $length = strlen($roman);

        if (!preg_match('/^[IVX]+$/', $roman)) {            
            if($roman == 'Pre-Nur'){
                $roman = 'Pre Nursery';
            }
            return $roman;
        }

        for ($i = 0; $i < $length; $i++) {
            $currentSymbol = $roman[$i];
            $nextSymbol = $i + 1 < $length ? $roman[$i + 1] : '';

            if (isset($map[$currentSymbol . $nextSymbol])) {
                $returnValue += $map[$currentSymbol . $nextSymbol];
                $i++; // Skip next symbol
            } else {
                $returnValue += $map[$currentSymbol];
            }
        }

        return 'Class ' .$returnValue;
    }


    public function collection(Collection $rows) {

        $invalidData = collect();

        $rows->each(function($row, $key) use ($invalidData) {

            if (isset($row['dob_ddmmyyyy']) && is_numeric($row['dob_ddmmyyyy'])) {
                try {
                    $date = Date::excelToDateTimeObject($row['dob_ddmmyyyy']);
                    $row['dob_ddmmyyyy'] = $date->format('d/m/Y'); 
                } catch (\Exception $e) {
                   
                }
            }

            $class = self::convertRomanToNumeric(trim($row['class']));
            $section = trim($row['section']);

            $validation = $this->validateRow($row, $this->action);

            if (!$validation->passes()) {
                foreach ($validation->errors()->all() as $error) {
                    $this->errormessage[] = [
                        'row' => $key + 1,
                        'errors' => $error,
                    ];
                }

                $this->imProperFormatData[] = array_merge($row->toArray(), ['Error' => implode(', ', $validation->errors()->all())]);
                $invalidData->push($row->toArray());

            } else {


               $dob = \Carbon\Carbon::createFromFormat('d/m/Y', $row['dob_ddmmyyyy'])->format('Y-m-d');

                $name = explode(' ', $row['name']);
                $class_id = Sclass::whereRaw('LOWER(REPLACE(name, " ", "")) LIKE ?', ['%' . strtolower(str_replace(' ', '', trim($class))) . '%'])->value('id');
                $custom_class_id = DB::table('custom_classes')
                    ->where('class_id', $class_id)
                    ->where('section', $section)
                    ->where('school_id', $this->school_id)
                    ->value('id');

                if (is_null($custom_class_id)) {
                    $maxValue = ScustomClass::max('orders') ?? 0;

                    $customClass = ScustomClass::create([
                        'school_id' => $this->school_id,
                        'class_id'  => $class_id,
                        'section'   => $section,
                        'orders'    => $maxValue + 1,
                        'status'    => 1,
                    ]);

                    $custom_class_id = $customClass->id;
                }
                $year = date('Y');
                $month = date('m');

                if ($month >= 4) {
                    $academicYear = $year . '-' . ($year + 1);
                } else {
                    $academicYear = ($year - 1) . '-' . $year;
                }

                $studentData = [
                    'school_id'     => $this->school_id,
                    'school_code'   => $row['school_code'],
                    'student_uid'   => $row['student_uid'],
                    'student_name'  => $row['name'],
                    'gender'        => $row['gender'],
                    'class_id'      => $class_id,
                    'custom_class_id'=> $custom_class_id,
                    'section_id'    => $row['section'],
                    'dob'           => $dob,
                    'user_id'       => $row['school_code'] . $row['student_uid'],
                    'password'      => strtolower($name[0]) . '@' . $row['student_uid'],
                    'email_id'      => $row['email'] ?? '',
                    'rollno'        => $row['roll_no'],
                    'domicile'      => $row['domicile_hometown'],
                    'fav_sport'     => $row['favorite_sports'],
                    'hobbies'       => $row['hobbies'],
                    'status'        => 'active',
                    'academic_year'	=> $academicYear
                ];

                // Check if the student already exists
                $existingStudent = Sstudent::where('school_id', $this->school_id)
                    ->where('student_uid', $row['student_uid'])
                    ->first();

                if ($existingStudent) {
                    $existingStudent->update($studentData);
                    $newRecord = $existingStudent;
                } else {
                    $newRecord = Sstudent::create($studentData);
                }

                $this->insertedRowIds[] = $newRecord->id;
                $this->importedData[] = $newRecord->toArray();
            }

        });
    }


    public function rules($action): array {

        $rules = [];
        $rules = [
            'name'                  => 'required|string',
            'gender'                => 'required|in:Male,Female',
            'section'               => 'required|string',
            'dob_ddmmyyyy'          => 'required|date_format:d/m/Y',
            'email_id'              => 'nullable|email|unique:students,email_id',
            'roll_no'               => 'required|integer',
            'class'                 => 'required|string',
            'domicile_hometown'     => 'nullable|string',
            'favorite_sports'       => 'nullable|string',
            'hobbies'               => 'nullable|string',
            'school_code'           => ['required', function ($attribute, $value, $fail){
                $school_user_id = Auth::user()->id;
                $school_id = \DB::table('school_reference')->where('school_user_id', $school_user_id)->value('school_id');
                $school_code = School::find($school_id);
                if($school_code === null || $school_code->school_code != $value){
                    $fail('School code does not match with school code provided by fitness365.');
                }
            }
            ],
        ];

        if($action == 'override'){
            $rules['student_uid'] = 'required';
        }else{
            $rules['student_uid'] = 'required|unique:students,student_uid';
        }

        return $rules;
    }

    public function customValidationMessages() {
        return [
            'school_code.required'          => 'School Code should no empty',
            // 'school_code.integer'           => 'School Code should be an numeric value',
            'student_uid.required'          => 'Student Admission Number should not be a empty',
            // 'student_uid.integer'           => 'Student Admission Number should be a numeric value',
            'student_uid.unique'            => 'Student Admission Number already exist',
            'name.required'                 => 'Student Name should be a empty',
            'name.string'                   => 'Student Name should be a string',
            'gender.required'               => 'Gender should not be a empty',
            'gender.in'                     => 'Gender should be either Male or Female',
            'class.required'                => 'Class should not be a empty',
            'class.string'                  => 'Class should be character',
            'section.required'              => 'Section should not be a empty',
            'section.string'                => 'Section should not be an numeric value',
            'dob_ddmmyyyy.required'          => 'Date of Birth not be a empty',
            'dob_ddmmyyyy.date_format'       => 'Date of Birth should be in the format dd/mm/YYYY',
            'email_id.unique'               => 'Student Email ID already exist',
            'roll_no.required'              => 'Roll Number not be a empty',
            'roll_no.integer'               => 'Roll Number should be an numeric value',
            'domicile_hometown.string'      => 'Hometown name should be a string',
            'favorite_sports.string'        => 'Sports should be a string',
            'hobbies.string'                => 'Hobbies should be a string',

        ];
    }

    public function validateRow(Collection $row, $action)  {

        $validator = \Validator::make(
            $row->toArray(),
            $this->rules($action),
            $this->customValidationMessages()
        );

        return $validator;
    }
}


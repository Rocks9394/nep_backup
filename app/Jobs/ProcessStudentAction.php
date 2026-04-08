<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Models\Sstudent;
use App\Models\ScustomClass;
use Auth;

class ProcessStudentAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $ids;
    public string $action;
    public int $userId;

    public function __construct(array $ids, string $action, int $userId)
    {
        $this->ids = $ids;
        $this->action = $action;
        $this->userId = $userId;
    }

    public function handle()
    {
        $chunkSize = 500; // backend chunking to avoid memory issues
        $promotedCount = $transferredCount = $deletedCount = 0;

        if ($this->action === 'delete') {
            foreach (array_chunk($this->ids, $chunkSize) as $chunk) {
                $students = DB::table('students')->whereIn('id', $chunk)->get();
                $deletedData = [];
                $now = now();

                foreach ($students as $student) {
                    $deletedData[] = [
                        'student_id' => $student->id,
                        'name' => $student->student_name,
                        'deleted_by' => $this->userId,
                        'deleted_at' => $now,
                        'school_id' => $student->school_id,
                        'custom_class_id' => $student->custom_class_id,
                        'student_uid' => $student->student_uid,
                        'json_data' => json_encode((array)$student),
                    ];
                }

                if (!empty($deletedData)) {
                    DB::table('deleted_students')->insert($deletedData);
                }

                $deletedCount += DB::table('students')->whereIn('id', $chunk)->delete();
            }

            return ['deleted' => $deletedCount];
        }

        if ($this->action === 'promote') {
            $students = Sstudent::whereIn('id', $this->ids)->where('status', 'active')->get();
            if ($students->isEmpty()) return ['promoted' => 0, 'transferred' => 0];

            $classes = DB::table('class')->orderBy('orders')->get();
            $nextClassMap = [];
            for ($i = 0; $i < $classes->count() - 1; $i++) {
                $nextClassMap[$classes[$i]->id] = $classes[$i + 1]->id;
            }

            $schoolId = DB::table('school_reference')
                ->where('school_user_id', $this->userId)
                ->where('status', 1)
                ->value('school_id');

            $nextClassPairs = $students->map(fn($student) => [
                'next_class_id' => $nextClassMap[$student->class_id] ?? null,
                'section_id' => $student->section_id
            ])->unique();

            $customClasses = DB::table('custom_classes')
                ->where('school_id', $schoolId)
                ->whereIn('class_id', $nextClassPairs->pluck('next_class_id'))
                ->whereIn('section', $nextClassPairs->pluck('section_id'))
                ->get()
                ->keyBy(fn($item) => $item->class_id . '_' . $item->section);

            $year = date('Y'); $month = date('m');
            $academicYear = $month >= 4 ? "$year-" . ($year + 1) : ($year - 1) . "-$year";

            foreach ($students as $student) {
                if ($student->class_id == 12) {
                    $student->update(['status' => 'transfer']);
                    $transferredCount++;
                    continue;
                }

                $nextClassId = $student->class_id + 1;
                $key = $nextClassId . '_' . $student->section_id;
                $customClassId = $customClasses[$key]->id ?? null;

                if (!$customClassId) {
                    $maxValue = ScustomClass::max('orders') ?? 0;
                    $customClass = ScustomClass::create([
                        'school_id' => $schoolId,
                        'class_id' => $nextClassId,
                        'section' => $student->section_id,
                        'orders' => $maxValue + 1,
                        'status' => 1
                    ]);
                    $customClassId = $customClass->id;
                }

                $student->update([
                    'class_id' => $nextClassId,
                    'custom_class_id' => $customClassId,
                    'academic_year' => $academicYear
                ]);

                $promotedCount++;
            }

            return ['promoted' => $promotedCount, 'transferred' => $transferredCount];
        }
    }
}
<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentSportsMappingExport implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    protected $ids;
    protected $schoolId;
    protected $schoolName;

    public function __construct($ids, $schoolId, $schoolName)
    {
        $this->ids = $ids;
        $this->schoolId = $schoolId;
        $this->schoolName = $schoolName;
    }

    public function collection()
    {
        $schoolId = $this->schoolId;

        $query = DB::table('students as s')
            ->leftJoin('class as c', 's.class_id', '=', 'c.id')
            ->leftJoin('custom_classes', 's.custom_class_id', '=', 'custom_classes.id')
            ->leftJoin('student_map_sports as sms', function ($join) use ($schoolId) {
                $join->on('s.id', '=', 'sms.student_id')
                     ->where('sms.school_id', '=', $schoolId);
            })
            ->leftJoin('sports as sp', 'sms.sports_id', '=', 'sp.id')
            ->leftJoin('users as u', 'sms.submitted_by', '=', 'u.id')
            ->where('s.school_id', '=', $schoolId)
            ->whereIn('s.id', $this->ids)
            ->select(


                 DB::raw("CASE 
                            WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
                            THEN custom_classes.nomenclature 
                            ELSE c.name 
                         END AS display_classname"), 'custom_classes.section',

                's.rollno as roll_no',
                's.student_name as student_name',
                DB::raw("COALESCE(sp.name, '---') as sport_name"),
                DB::raw("COALESCE(u.name, '---') as submitted_by"),
                DB::raw("CASE WHEN sms.created_at IS NULL THEN '---' ELSE DATE_FORMAT(sms.created_at, '%d-%m-%Y') END as mapped_on"),
               
            )
            ->orderByRaw('CASE WHEN sp.id IS NULL THEN 1 ELSE 0 END')
            ->orderBy('s.class_id')
            ->orderBy('s.section_id')
            ->orderBy('s.student_name')
            ->get();

        return $query;
    }

    public function headings(): array
    {
        return [
            'Class',
            'Section',
            'Roll No.',
            'Student Name',
            'Sport',
            'Mapped By',
            'Mapped Date',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Insert school name and report title at the top
                $sheet->insertNewRowBefore(1, 2);

                // Merge header cells across all columns
                $sheet->mergeCells('A1:G1');

                // Set the header text
                $sheet->setCellValue('A1', "{$this->schoolName} - Students Sports Mapping List");

                // Style the header
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['rgb' => '1F497D'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}

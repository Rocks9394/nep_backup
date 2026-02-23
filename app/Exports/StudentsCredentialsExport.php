<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use DB;

class StudentsCredentialsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting, WithColumnWidths
{
    protected $studentIds;
    protected $className;
    protected $sectionName;

    public function __construct(array $studentIds, string $className = null, string $sectionName = null)
    {
        $this->studentIds = $studentIds;
        $this->className = $className;
        $this->sectionName = $sectionName;
    }

    public function collection()
    {
        $query = DB::table('students')
            ->leftJoin('class', 'students.class_id', '=', 'class.id')
            ->leftJoin('custom_classes', 'students.custom_class_id', '=', 'custom_classes.id')
            ->select(
                'students.id',
                'students.student_name',
                'class.name as class_name',
                'custom_classes.nomenclature as custom_class_name',
                'custom_classes.section',  
                'students.rollno', 
                'student_uid',
                'students.user_id',
                'students.password',
                DB::raw("CASE 
                    WHEN custom_classes.nomenclature IS NOT NULL AND custom_classes.nomenclature <> '' 
                    THEN custom_classes.nomenclature 
                    ELSE class.name 
                END AS display_classname")
            )
            ->whereIn('students.id', $this->studentIds)
            ->where('students.status', 'active');

        // Filter by class and section if provided
        if ($this->className) {
            $query->where(function($q) {
                $q->where('class.name', $this->className)
                  ->orWhere('custom_classes.nomenclature', $this->className);
            });
        }

        if ($this->sectionName) {
            $query->where('custom_classes.section', $this->sectionName);
        }

        return $query->orderby('custom_classes.orders')
            ->orderBy('custom_classes.section')
            ->orderBy('students.rollno')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Class',
            'Section',
            'Roll No',
            'Student Name',
            'Username',
            'Password',
        ];
    }

    public function map($student): array
    {
        $firstName = strtolower(trim(explode(' ', $student->student_name)[0]));
        $plainPassword = $firstName . '@' . trim($student->student_uid);
        return [
            $student->display_classname, 
            $student->section, 
            $student->rollno, 
            $student->student_name, 
            (string) $student->user_id, 
            $plainPassword
        ];
    }

    public function columnFormats(): array {
        return [
            'E' => NumberFormat::FORMAT_TEXT, // Username as text
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15, 
            'B' => 10,
            'C' => 10, 
            'D' => 25, 
            'E' => 25, 
            'F' => 15, 
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => 'FFE0E0E0']
                ]
            ],
            'A:F' => [
                'autoSize' => false,
            ],
        ];
    }
}
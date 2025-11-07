<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExportDuplicateActivities implements FromCollection, WithHeadings, WithEvents, WithColumnFormatting
{
    private $data;
    protected $action;

    public function __construct($data, $action)
    {
        $this->data = $data;
        $this->action = $action;
    }

    public function collection() {
      
        return collect($this->data)->map(function ($item) {
            return [
                'skill_area'  => $item['skill_area'] ?? '',
                'skill_sport' => $item['skill_sport'] ?? '',
                'techniques' => $item['techniques'] ?? '',
                'activity' => $item['activity'] ?? '',
                'teaching_through' => $item['teaching_through'] ?? '',
                'description' => $item['description'] ?? '',
                'learning_outcomes' => $item['learning_outcomes'] ?? '',
                'video_url' => $item['video_url'] ?? '',
                'variations' => $item['variations'] ?? '',
                'coaching' => $item['coaching'] ?? '',
                'equipment' => $item['equipment'] ?? '',
                'status' => $item['status'] ?? '',
                'error'  => $item['Error'] ?? '',
            ];
        });

        //return collect($this->data);
    }


    public function headings(): array
    {
        if ($this->action === 'duplicate') {
            return [
                'Skill Area', 'Skill Sport', 'Techniques', 'Activity', 'Teaching Through', 'Description',
                'Learning Outcomes', 'Video Url', 'Variations', 'Coaching', 'Equipment', 'Status'
            ];
        } elseif ($this->action === 'error_list') {
            return [
                'Skill Area', 'Skill Sport', 'Techniques', 'Activity', 'Teaching Through', 'Description',
                'Learning Outcomes', 'Video Url', 'Variations', 'Coaching', 'Equipment', 'Status', 'Error'
            ];
        } else {
            return [
                'Skill Area', 'Skill Sport', 'Techniques', 'Activity', 'Teaching Through', 'Description',
                'Learning Outcomes', 'Video Url', 'Variations', 'Coaching', 'Equipment', 'Status'
            ];
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $headerStyle = [
                    'fill' => [
                        'fillType' => 'solid',
                        'color' => ['rgb' => '4F81BD'],
                    ],
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                ];

                $errorHeaderStyle = [
                    'fill' => [
                        'fillType' => 'solid',
                        'color' => ['rgb' => 'FF0000'],
                    ],
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                ];

                $lastColumn = $this->action === 'error_list' ? 'M' : 'L';
                $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray($headerStyle);

                if ($this->action === 'error_list') {
                    $sheet->getStyle('M1')->applyFromArray($errorHeaderStyle);
                }

             
                foreach (range('A', $lastColumn) as $column) {
                    $sheet->getColumnDimension($column)->setWidth(30);
                }
            },
        ];
    }

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_TEXT, 
        ];
    }
}

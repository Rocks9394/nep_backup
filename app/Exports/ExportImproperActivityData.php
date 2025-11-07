<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Carbon\Carbon;

class ExportImproperActivityData implements FromCollection, WithHeadings, WithEvents , WithColumnFormatting
{


    private $data;
    private $error_message;
    protected $action;
 
    public function startCell(): string {
        return 'A1';
    }

    public function __construct($data, $action) {

        $this->data = $data;
        $this->action = $action;
    }

    public function collection()  {


        // echo "<pre>"; print_r($this->data);exit();

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
    }

    public function columnFormats(): array {
        return [
            'I1' => '@', // Format DOB column as text
        ];
    }

    public function headings(): array {

        if ($this->action == 'duplicate') {
            return ['Skill Area','Skill Sport','Techniques','Activity', 'Teaching Through', 'Description','Learning Outcomes','Video Url','Variations','Coaching','Equipment','Status'];
        } elseif ($this->action == 'error_list') {
            return ['Skill Area','Skill Sport','Techniques','Activity', 'Teaching Through', 'Description','Learning Outcomes','Video Url','Variations','Coaching','Equipment','Status', 'Error'];
        } else {
            return ['Act_id','Skill Area','Skill Sport','Techniques','Activity', 'Teaching Through', 'Description','Learning Outcomes','Video Url','Variations','Coaching','Equipment','Status'];
        }
    }
 
    public function registerEvents(): array {

        return [
            AfterSheet::class    => function(AfterSheet $event) { 

                $sheet = $event->sheet->getDelegate();                
                $headerStyle = [
                    'fill' => [
                        'fillType' => 'solid',
                        'color' => ['rgb' => '4F81BD'], // Blue color
                    ],
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'], // White text
                    ],
                ];

                $errorHeaderStyle = [
                    'fill' => [
                        'fillType' => 'solid',
                        'color' => ['rgb' => 'FF0000'], // Red color
                    ],
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'], // White text
                    ],
                ];

                $sheet->getStyle('A1:L1')->applyFromArray($headerStyle);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(30);    //Skill Area
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(30);    //Skill Sport
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);    //Techniques
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(40);    //Activity
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(15);    //Image
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(35);    //Video Url
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(35);    
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(35);   
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(35);    
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(35);    
                $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(35);    
                $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(35);   
                if($this->action == 'error_list'){
                    $sheet->getStyle('M1')->applyFromArray($errorHeaderStyle);
                }
            },
        ];
    }

}

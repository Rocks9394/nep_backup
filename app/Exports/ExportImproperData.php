<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Carbon\Carbon;

class ExportImproperData implements FromCollection, WithHeadings, WithEvents , WithColumnFormatting
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
        return collect($this->data);

        //echo "<pre>"; print_r(collect($this->data));exit();

    }

    public function columnFormats(): array {
        return [
            'I1' => '@', // Format DOB column as text
        ];
    }

    public function headings(): array {

        if($this->action == 'duplicate'){
            return ['School Code','Student UID ','Name','Gender', 'Class' ,'Section','Roll No','DOB(DD/MM/YYYY)','Domicile (Hometown)','Favorite Sports','Hobbies','Email'];
        }else{
           return ['School Code','Student UID ','Name','Gender', 'Class' ,'Section','Roll No','DOB(DD/MM/YYYY)','Email','Domicile (Hometown)','Favorite Sports','Hobbies','Error'];
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

                $sheet->getStyle('A1:I1')->applyFromArray($headerStyle);
                if($this->action == 'error_list'){
                    $sheet->getStyle('M1')->applyFromArray($errorHeaderStyle);
                }
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(16);    //school code
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(21);    //student admission no.
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(25);    //Student Name
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(11);    //Gender
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(15);    //Class
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(11);    //Section
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(10);    //Roll No.
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(20);    //DOB
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(43);    //Email                
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(34);    //Domicile (Hometown)
                $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(27);    //Favorite Sports
                $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(20);    //Email
                if($this->action == 'error_list'){
                    $event->sheet->getDelegate()->getColumnDimension('M')->setWidth(10); 
                }
            },
        ];
    }

}

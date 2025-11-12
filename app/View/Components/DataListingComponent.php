<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Auth;
use DB;
use App\Models\School;
use App\Models\Sclass;


class DataListingComponent extends Component
{
    public $id;
    public $headers;
    public $columns;
    public $ajaxUrl;
    public $title;
    public $exportButtons;

    public $enableClassFilter;
    public $classes;
    public $statuses;

    public function __construct($id, $headers = [], $columns = [], $ajaxUrl = '', $title = '', $exportButtons = [], $classes = [], $enableClassFilter = false) {


        $this->id = $id;
        $this->headers = $headers;
        $this->columns = $columns;
        $this->ajaxUrl = $ajaxUrl;
               


        $this->enableClassFilter = filter_var($enableClassFilter, FILTER_VALIDATE_BOOLEAN);

        if ($this->enableClassFilter) {

            $creatorId = Auth::id();
            $schoolId = DB::table('school_reference')
                ->where('school_user_id', $creatorId)
                ->where('status', 1)
                ->value('school_id');

            $school = School::find($schoolId);
            $classList = $school->getClasses;
            foreach ($classList as $class) {
                $originalClass = Sclass::where('id', $class->class_id)->orderBy('orders')->first();
                $class->name = !empty($class->nomenclature) 
                    ? $class->nomenclature 
                    : ($originalClass ? $originalClass->name : null);

            }

            $this->classes = $classList;
        } else {
            $this->classes = collect(); // empty
        }


        $defaultButtons = [
            // ['type' => 'excelHtml5', 'text' => 'Excel'] default button ->removed
        ];


        $this->exportButtons = array_merge($defaultButtons, $exportButtons ?? []);
    }

    public function render()
    {
        return view('components.listing-data');
    }
}

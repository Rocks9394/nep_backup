<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GetStudentList extends Component
{


    public $classes;
    public $type;

    /**
     * Create a new component instance.
     *
     * @param array $classes
     */
    public function __construct($classes = [], $type)
    {
        $this->classes  = $classes;
        $this->type = $type;
    }
     /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.get-student-list');
    }
}

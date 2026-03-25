<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GetStudentList extends Component
{

	public $classes;
	public $type;
	public $title;

    /**
     * Create a new component instance.
     *
     * @param array $classes
     */
	// FIX: Move required parameters ($type, $title) before the optional one ($classes)
	public function __construct($type, $title, $classes = [])
	{
		$this->classes = $classes;
		$this->type = $type;
		$this->title = $title;
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

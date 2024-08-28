<?php

namespace App\View\Components\Staff;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    /**
     * Create a new component instance.
     */
    public function __construct(public $staffs, public $staff)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.staff.table');
    }
}

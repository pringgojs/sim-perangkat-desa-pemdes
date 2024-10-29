<?php

namespace App\View\Components\Utils;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownMenuAction extends Component
{
    public $items;
    public $id;

    public function __construct($id, $items = [])
    {
        $this->id = $id;
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.dropdown-menu-action');
    }
}

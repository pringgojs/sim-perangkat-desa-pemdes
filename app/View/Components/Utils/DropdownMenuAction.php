<?php

namespace App\View\Components\Utils;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownMenuAction extends Component
{
    public $items;
    public $id;
    public $modalName;

    public function __construct($id, $items = [], $modalName = 'modalConfirm')
    {
        $this->id = $id;
        $this->items = $items;
        $this->modalName = $modalName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.dropdown-menu-action');
    }
}

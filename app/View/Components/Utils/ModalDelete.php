<?php

namespace App\View\Components\Utils;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalDelete extends Component
{
    public $id;
    public $desc;
    /**
     * Create a new component instance.
     */
    public function __construct($id = null, $desc = null)
    {
        $this->id = $id;
        $this->desc = $desc;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utils.modal-delete');
    }
}

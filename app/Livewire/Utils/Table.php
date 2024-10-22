<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class Table extends Component
{
    public $headers;
    public function render()
    {
        return view('livewire.utils.table');
    }
}

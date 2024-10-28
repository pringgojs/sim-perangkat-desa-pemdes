<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class Table extends Component
{
    public $headers;

    /**
     * Create a new component instance.
     *
     * @param array $headers
     */
    public function __construct($headers = [])
    {
        $this->headers = $headers;
    }
    
    public function render()
    {
        return view('livewire.utils.table');
    }
}

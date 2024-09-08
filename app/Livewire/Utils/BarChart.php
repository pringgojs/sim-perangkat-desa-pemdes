<?php

namespace App\Livewire\Utils;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class BarChart extends Component
{

    #[Reactive] 
    public $legend = [];

    #[Reactive] 
    public $series = [];

    public $id;
    
    protected $listeners = ['refreshComponent' => '$refresh', 'updateChart'];

    public function updateChart($series = [], $legend = [])
    {
        $this->dispatch('update-chart', legend: $legend, series: $series);
    }

    public function render()
    {
        return view('livewire.utils.bar-chart');
    }
}

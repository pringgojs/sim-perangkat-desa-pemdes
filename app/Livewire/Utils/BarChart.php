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
    // public function mount($legend, $series, $id)
    // {
    //     info('series');
    //     info($series);
    //     $this->legend = $legend;
    //     $this->series = $series;
    //     $this->id = $id;
    // }

    public function updateChart($params = [])
    {
        info('dari INDEX: $params');

        if(isset($params['legend'])) {
            $this->legend = $params['legend'];
        }

        if(isset($params['series'])) {
            $this->series = $params['series'];
            info('$this->series');
            info($this->series);
        }
    }

    public function render()
    {
        return view('livewire.utils.bar-chart');
    }
}

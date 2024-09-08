<?php

namespace App\Livewire\Pages\Statistic;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;
use App\Models\VillageStaff;
use App\Livewire\Utils\BarChart;

class Index extends Component
{
    public $legend = [];
    public $series = [];
    protected $listeners = ['refreshComponent' => '$refresh', 'initChart'];
    
    public function mount()
    {
        self::initChart();
    }

    public function initChart($district = null)
    {
        $this->legend = Option::positionTypes()->orderByDefault()->pluck('name')->toArray();
        
        $data = [];
        foreach (Option::positionTypes()->orderByDefault()->get() as $item) {
            $data[] = VillageStaff::district($district)
                ->type($item->id)
                ->activeStatus(true)
                ->count();
        }

        $this->series = [
            [
                'name' => 'Jumlah',
                'data' => $data
            ]
        ];

        // $this->emit('updateChart', $this->series, $this->categories);

        $this->dispatch('updateChart', $this->series, $this->legend )->to(BarChart::class);
    } 

    public function render()
    {
        return view('livewire.pages.statistic.index');
    }
}

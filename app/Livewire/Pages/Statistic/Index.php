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
    public $title;
    protected $listeners = ['refreshComponent' => '$refresh', 'initChart'];
    
    public function mount()
    {
        self::initChart();
    }

    public function initChart($districtId = null)
    {
        $this->title = 'Grafik Jumlah Perangkat Berdasarkan Jenis Jabatan ';
        
        $district = Option::find($districtId);
        if ($district) {
            $this->title .= '(Kec.'.$district->name.')';
        }
        
        $this->legend = Option::positionTypes()->orderByDefault()->pluck('name')->toArray();

        $data_male = [];
        $data_famale = [];
        foreach (Option::positionTypes()->orderByDefault()->get() as $item) {
            $data_male[] = VillageStaff::district($districtId)
                ->type($item->id)
                ->activeStatus(true)
                ->gender(true)
                ->count();

            $data_famale[] = VillageStaff::district($districtId)
                ->type($item->id)
                ->activeStatus(true)
                ->gender(false)
                ->count();
        }

        $this->series = [
            [
                'name' => 'Laki-laki',
                'data' => $data_male
            ],
            [
                'name' => 'Perempuan',
                'data' => $data_famale
            ]

        ];

        $this->dispatch('updateChart')->to(BarChart::class);
    } 

    public function render()
    {
        return view('livewire.pages.statistic.index');
    }
}

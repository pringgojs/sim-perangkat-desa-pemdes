<?php

namespace App\Livewire\Pages\StatisticStatusData;

use App\Models\Option;
use App\Models\VillageStaff;
use Livewire\Component;
use Pringgojs\LivewireCharts\BarChartComponent;

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
        $this->title = 'Grafik Jumlah Perangkat Berdasarkan Status Data ';

        $district = Option::find($districtId);
        if ($district) {
            $this->title .= '(Kec.'.$district->name.')';
        }

        $this->legend = Option::positionTypes()->orderByDefault()->pluck('name')->toArray();
        $statusData = Option::statusData()->orderByDefault()->get();

        $series = [];
        $data_famale = [];
        $data = [];
        foreach ($statusData as $status) {
            $data = [];
            foreach (Option::positionTypes()->orderByDefault()->get() as $item) {
                $data[] = VillageStaff::district($districtId)
                    ->activeStatus(true, $status->id)
                    ->type($item->id)
                    ->gender(true)
                    ->count();
            }

            $series[] = [
                'name' => $status->name,
                'data' => $data,
            ];
        }

        $this->series = $series;
        $this->dispatch('updateChart', $this->legend, $this->series)->to(BarChartComponent::class);
    }

    public function render()
    {
        return view('livewire.pages.statistic-status-data.index');
    }
}

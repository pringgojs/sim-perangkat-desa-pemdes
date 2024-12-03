<?php

namespace App\Livewire\Pages\StatisticStatusData\Section;

use App\Livewire\Pages\StatisticStatusData\Index as StatusDataIndex;
use App\Models\Option;
use App\Models\Village;
use Livewire\Component;

class Filter extends Component
{
    public $districts = [];

    public $status_data = [];

    public $villages = [];

    public $search;

    public $district;

    public $isOperator = false;

    public function mount()
    {
        $this->districts = Option::districts()->get();
        $this->status_data = Option::statusData()->get();

        /* jika yang login adalah operator desa, seting village dan district otomatis terisi */
        self::ifOperator();
    }

    public function setDistrict($id)
    {
        $this->district = $id;

        self::filter();
    }

    public function filter()
    {
        $params = [
            'district' => $this->district,
            'search' => $this->search,
        ];

        $this->dispatch('filter', $params)->to(Table::class);
        if ($this->district) {
            $this->dispatch('initChart', $this->district)->to(StatusDataIndex::class);
        }
    }

    public function export()
    {
        $this->dispatch('export')->to(Table::class);
    }

    public function ifOperator()
    {
        $user = auth()->user();
        $this->isOperator = $user->hasRole('operator') ? true : false;
    }

    public function render()
    {
        return view('livewire.pages.statistic-status-data.section.filter');
    }
}

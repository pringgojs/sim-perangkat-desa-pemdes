<?php

namespace App\Livewire\Pages\Statistic\Section;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;
use App\Livewire\Pages\Statistic\Index;
use App\Livewire\Pages\Statistic\Section\Table;

class Filter extends Component
{
    public $position_types;
    public $districts = [];
    public $status_data = [];
    public $villages = [];
    
    public $search;
    public $district_id;
    public $status_data_id;
    public $position_type_id;
    public $village_id;
    public $isOperator = false;

    public function mount()
    {
        $this->position_types = Option::positionTypes()->get();
        $this->districts = Option::districts()->get();
        $this->status_data = Option::statusData()->get();

        /* jika yang login adalah operator desa, seting village dan district otomatis terisi */
        self::ifOperator();
    }

    public function getVillages($id)
    {
        $this->villages = Village::where('district_id', $id)->get();
        $this->district_id = $id;

        self::filter();
    }

    public function filter()
    {
        $params = [
            'district' => $this->district_id,
            'search' => $this->search,
        ];

        $this->dispatch('filter', $params )->to(Table::class);
        if ($this->district_id) {
            $this->dispatch('initChart', $this->district_id )->to(Index::class);
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
        return view('livewire.pages.statistic.section.filter');
    }
}

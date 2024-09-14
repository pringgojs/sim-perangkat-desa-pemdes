<?php

namespace App\Livewire\Pages\Village\Section;

use App\Models\Option;
use Livewire\Component;
use App\Livewire\Pages\Village\Section\Table;

class Filter extends Component
{
    public $village_types;
    public $districts = [];
    
    public $search;
    public $district;
    public $type;

    public function mount()
    {
        $this->village_types = Option::villageTypes()->get();
        $this->districts = Option::districts()->get();
    }

    public function setDistrict($id)
    {
        $this->district = $id;
        self::filter();
    }

    public function setType($id)
    {
        $this->type = $id;
        self::filter();
    }

    public function filter()
    {
        $params = [
            'district' => $this->district,
            'type' => $this->type,
            'search' => $this->search,
        ];

        $this->dispatch('filter', $params )->to(Table::class);
    }

    public function export()
    {
        $this->dispatch('export')->to(Table::class);
    }

    public function render()
    {
        return view('livewire.pages.village.section.filter');
    }
}

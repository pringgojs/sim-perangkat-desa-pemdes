<?php

namespace App\Livewire\Pages\VillagePositionType\Section;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;
use App\Livewire\Pages\VillagePositionType\Section\Table;

class Filter extends Component
{
    public $districts;
    public $villages;
    public $positionTypes;
    public $positionTypeStatus;
    public function mount()
    {
        $this->districts = Option::districts()->get();
        $this->positionTypes = Option::positionTypes()->get();
        $this->villages = Village::with(['district'])->orderByDefault()->get();
        $this->positionTypeStatus = Option::positionTypeStatus()->get();
    }

    public function filter($area = null, $search = null, $positionType = null, $selectedDistrict = [], $selectedVillage = [], $positionStatus = null, $isParkir = false)
    {
        $params = [
            'area' => $area,
            'search' => $search,
            'positionType' => $positionType,
            'selectedDistrict' => $selectedDistrict,
            'selectedVillage' => $selectedVillage,
            'isParkir' => $isParkir,
            'positionStatus' => $positionStatus,
        ];

        $this->dispatch('filter', $params )->to(Table::class);
    }

    public function render()
    {
        return view('livewire.pages.village-position-type.section.filter');
    }
}

<?php

namespace App\Livewire\Utils;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;

class Filter extends Component
{
    public $districts;
    public $villages;
    public $positionType;
    public $positionTypes;
    public $positionTypeStatus;
    public $table;
    
    public $useNullPerson = false;
    
    public function mount($table, $positionType = null)
    {
        $this->districts = Option::districts()->get();
        $this->positionTypes = Option::positionTypes()->get();
        $this->villages = Village::with(['district'])->orderByDefault()->get();
        $this->positionTypeStatus = Option::positionTypeStatus()->get();
        $this->table = $table;
        $this->positionType = $positionType;
    }

    public function filter($area = null, $search = null, $positionType = null, $selectedDistrict = [], $selectedVillage = [], $positionStatus = null, $isParkir = false, $isNullPerson = false)
    {
        $params = [
            'area' => $area,
            'search' => $search,
            'positionType' => $positionType,
            'selectedDistrict' => $selectedDistrict,
            'selectedVillage' => $selectedVillage,
            'isParkir' => $isParkir,
            'positionStatus' => $positionStatus,
            'isNullPerson' => $isNullPerson,
        ];
        $this->dispatch('filter', $params )->to($this->table);
    }

    public function render()
    {
        return view('livewire.utils.filter');
    }
}

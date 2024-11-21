<?php

namespace App\Livewire\Utils;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;

class Filter extends Component
{
    public $districts;
    public $villages;
    public $positionTypes;
    public $listStatusData;
    
    public $statusData;
    public $statusDataName;
    public $positionType;
    public $positionTypeName;
    public $positionTypeStatus;
    public $table;
    public $params;
    
    public $useNullPerson = false;
    public $useStatusData = false;
    
    public function mount($table, $positionType = null)
    {
        $statusData = request()->input('statusData');
        $this->statusData = $statusData ? : null;
        $this->districts = Option::districts()->get();
        $this->positionTypes = Option::positionTypes()->get();
        $this->listStatusData = Option::statusData()->get();
        $this->villages = Village::with(['district'])->orderByDefault()->get();
        $this->positionTypeStatus = Option::positionTypeStatus()->get();
        $this->table = $table;
        $this->positionType = $positionType;
        $this->positionTypeName = $positionType ? Option::findOrFail($positionType)->name : '';
        $this->statusDataName = $this->statusData ? Option::findOrFail($this->statusData)->name : '';
    }

    public function filter($area = null, $search = null, $positionType = null, $selectedDistrict = [], $selectedVillage = [], $positionStatus = null, $isParkir = false, $isNullPerson = false, $statusData= null)
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
            'statusData' => $statusData,
        ];

        info($params);

        $this->params = $params;

        $this->dispatch('filter', $params )->to($this->table);
    }

    public function export()
    {
        $this->dispatch('export')->to($this->table);
    }

    public function render()
    {
        return view('livewire.utils.filter');
    }
}

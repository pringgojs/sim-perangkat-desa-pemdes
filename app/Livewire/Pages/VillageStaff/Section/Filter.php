<?php

namespace App\Livewire\Pages\VillageStaff\Section;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;

class Filter extends Component
{
    public $position_types;
    public $districts = [];
    public $status_data = [];
    public $villages = [];
    
    public $district_id;
    public $status_data_id;
    public $position_type_id;
    public $village_id;
    public function mount()
    {
        $this->position_types = Option::positionTypes()->get();
        $this->districts = Option::districts()->get();
        $this->status_data = Option::statusData()->get();
        // if ($this->id) {
        //     $model = VillageStaff::find($this->id);
        //     $this->form->setModel($model);
        //     self::getVillages(); // memanggil list desa
        // }

        /* jika yang login adalah operator desa, seting village dan district otomatis terisi */
        self::ifOperator();
    }

    public function getVillages($id)
    {
        $this->villages = Village::where('district_id', $id)->get();
        $this->district_id = $id;
    }

    public function setVillageId($id)
    {
        $this->village_id = $id;
    }

    public function setStatusDataId($id)
    {
        $this->status_data_id = $id;
    }

    public function setPositionTypeId($id)
    {
        $this->position_type_id = $id;
    }

    public function ifOperator()
    {
        $user = auth()->user(); 
        if ($user->hasRole('operator')) {
            $village = $user->staff()->village;
            $this->form->village = $village->id;
            $this->form->district = $village->district_id;

            self::getVillages();
        }
    }


    public function render()
    {
        return view('livewire.pages.village-staff.section.filter');
    }
}

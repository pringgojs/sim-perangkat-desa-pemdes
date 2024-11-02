<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;
use App\Models\VillagePositionType;
use App\Models\VillageStaffHistory;
use App\Rules\UniqueVillagePositionType;

class VillageStaffHistoryForm extends Form
{
    public $id;
    public $staffId;
    
    
    public $villagePositionType;
    public $positionTypeStatus;
    public $isParkir;
    public $skNumber;
    public $skTmt;
    public $skDate;
    public $dateOfAppointment;
    public $enddateOfOffice;

    public function rules()
    {
        return [
            'villagePositionType' => 'required',
        ];

    }

    public function messages() 
    {
        return [
            'villagePositionType.required' => 'Jenis jabatan wajib diisi.',
        ];
    }

    public function store() 
    {
        $this->validate();
 
        $villagePositionType = VillagePositionType::find($this->villagePositionType);
        
        $payload = [
            'village_staff_id' => $this->staffId,
            'village_position_type_id' => $villagePositionType->id,
            'village_id' => $villagePositionType->village_id,
            'position_code' => $villagePositionType->position_name,
            'position_type_id' => $villagePositionType->position_type_id,
            'position_name' => $villagePositionType->position_name,
            'position_type_status_id' => $villagePositionType->position_type_status_id,
            'siltap' => $villagePositionType->siltap,
            'tunjangan' => $villagePositionType->tunjangan,
            'thp' => $villagePositionType->siltap + $villagePositionType->tunjangan,
            'no_sk' => $this->skNumber,
            'date_of_sk' => $this->skDate,
            'date_of_appointment' => $this->dateOfAppointment,
            'enddate_of_office' => $this->enddateOfOffice,
        ];

        /* proses simpan */
        $model = VillageStaffHistory::updateOrCreate([
            'id' => $this->id
        ], $payload);

        return $model;
    }

    public function setModel(VillageStaffHistory $model)
    {
        $this->villagePositionType = $model->village_position_type_id;
        $this->skNumber = $model->no_sk;
        $this->skDate = $model->date_of_sk;
        $this->dateOfAppointment = $model->date_of_appointment;
        $this->enddateOfOffice = $model->enddate_of_office;
        $this->staffId = $model->village_staff_id;
    }

    public function setStaffId($id)
    {
        $this->staffId = $id;
    }
}

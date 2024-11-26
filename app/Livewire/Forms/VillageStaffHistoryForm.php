<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\VillageStaff;
use Livewire\Attributes\Validate;
use App\Models\VillagePositionType;
use App\Models\VillageStaffHistory;
use App\Services\StaffHistoriesService;
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
    public $siltap;
    public $tunjangan;

    public function rules()
    {
        return [
            'positionTypeStatus' => 'required',
            'villagePositionType' => 'required',
            'siltap' => 'required',
            'tunjangan' => 'required',
        ];

    }

    public function messages() 
    {
        return [
            'villagePositionType.required' => 'Jenis jabatan wajib diisi.',
            'positionTypeStatus.required' => 'Status jabatan wajib diisi.',
        ];
    }

    public function store() 
    {
        $this->validate();
 
        $tunjangan = \format_price($this->tunjangan);
        $siltap = \format_price($this->siltap);
        $thp = $tunjangan + $siltap;
        
        $villagePositionType = VillagePositionType::findOrFail($this->villagePositionType);
        $staff = VillageStaff::findOrFail($this->staffId);

        $historyService = new StaffHistoriesService($villagePositionType, $staff);
        $historyService->store([
            'no_sk' => $this->skNumber,
            'date_of_sk' => $this->skDate,
            'date_of_appointment' => $this->dateOfAppointment,
            'enddate_of_office' => $this->enddateOfOffice,
            'is_active' => true,
            'siltap' => $siltap,
            'tunjangan' => $tunjangan,
            'thp' => $thp,
            'is_parkir' => $this->isParkir,
            'position_type_status_id' => $this->positionTypeStatus
        ], $this->id);

        return $historyService;
    }

    public function setModel(VillageStaffHistory $model)
    {
        $this->id = $model->id;
        $this->villagePositionType = $model->village_position_type_id;
        $this->skNumber = $model->no_sk;
        $this->skDate = $model->date_of_sk ? $model->date_of_sk->format('Y-m-d') : null;
        $this->dateOfAppointment = $model->date_of_appointment ? $model->date_of_appointment->format('Y-m-d') : null;
        $this->enddateOfOffice = $model->enddate_of_office ? $model->enddate_of_office->format('Y-m-d') : null;
        $this->staffId = $model->village_staff_id;
    }

    public function setStaffId($id)
    {
        $this->staffId = $id;
    }
}

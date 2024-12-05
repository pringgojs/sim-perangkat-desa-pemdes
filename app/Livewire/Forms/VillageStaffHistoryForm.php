<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\VillageStaff;
use App\Models\VillagePositionType;
use App\Models\VillageStaffHistory;
use App\Services\StaffHistoriesService;
use App\Rules\UniquePositionStatusHistory;

class VillageStaffHistoryForm extends Form
{
    public $id;

    public $staffId;

    public $villagePositionType;

    public $positionTypeStatus;

    public $isParkir = false;

    public $skNumber;

    public $skTmt;

    public $skDate;

    public $dateOfAppointment;

    public $enddateOfOffice;

    public $siltap;

    public $tunjangan;

    public $authorizedSignature;

    public function rules()
    {
        return [
            'villagePositionType' => 'required',
            'siltap' => 'required',
            'tunjangan' => 'required',
            'positionTypeStatus' => [
                'required',
                new UniquePositionStatusHistory($this->positionTypeStatus, $this->staffId, $this->id),
            ],
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

        // dd($tunjangan);

        $villagePositionType = VillagePositionType::findOrFail($this->villagePositionType);
        $staff = VillageStaff::findOrFail($this->staffId);

        $payload = [
            'village_staff_id' => $staff->id,
            'village_position_type_id' => $villagePositionType->id,
            'village_id' => $villagePositionType->village_id,
            'position_code' => $villagePositionType->code,
            'position_type_id' => $villagePositionType->position_type_id,
            'position_name' => $villagePositionType->position_name,
            'non_active_at' => null,
            'is_active' => true,
            'created_by' => auth()->user()->id,
            // ---
            'no_sk' => $this->skNumber,
            'date_of_sk' => $this->skDate,
            'date_of_appointment' => $this->dateOfAppointment,
            'enddate_of_office' => $this->enddateOfOffice,
            'is_active' => true,
            'siltap' => $siltap,
            'tunjangan' => $tunjangan,
            'thp' => $thp,
            'is_parkir' => $this->isParkir,
            'authorized_signature' => $this->authorizedSignature,
            'position_type_status_id' => $this->positionTypeStatus,
        ];

        /* proses simpan */
        $model = VillageStaffHistory::updateOrCreate([
            'id' => $this->id,
        ], $payload);

        $service = new StaffHistoriesService;
        $service->setActive($model);

        return $model;
    }

    public function setModel(VillageStaffHistory $model)
    {
        $this->id = $model->id;
        $this->villagePositionType = $model->village_position_type_id;
        $this->positionTypeStatus = $model->position_type_status_id;
        $this->skNumber = $model->no_sk;
        $this->isParkir = $model->is_parkir ? true : false;
        $this->skDate = $model->date_of_sk ? $model->date_of_sk->format('Y-m-d') : null;
        $this->dateOfAppointment = $model->date_of_appointment ? $model->date_of_appointment->format('Y-m-d') : null;
        $this->enddateOfOffice = $model->enddate_of_office ? $model->enddate_of_office->format('Y-m-d') : null;
        $this->staffId = $model->village_staff_id;
        $this->siltap = $model->siltap;
        $this->tunjangan = $model->tunjangan;
        $this->authorizedSignature = $model->authorized_signature;
        // dd($this);
    }

    public function setStaffId($id)
    {
        $this->staffId = $id;
    }
}

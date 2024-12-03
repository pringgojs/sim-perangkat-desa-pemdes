<?php

namespace App\Livewire\Forms;

use App\Models\VillagePositionType;
use App\Models\VillageStaff;
use App\Models\VillageStaffHistory;
use App\Rules\UniquePositionStatusHistory;
use Livewire\Form;

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
            'position_type_status_id' => $this->positionTypeStatus,
        ];

        /* proses simpan */
        $model = VillageStaffHistory::updateOrCreate([
            'id' => $this->id,
        ], $payload);

        /* update village position type */
        $villagePositionType->tunjangan = $tunjangan;
        $villagePositionType->siltap = $siltap;
        $villagePositionType->is_parkir = $this->isParkir;
        $villagePositionType->position_type_status_id = $this->positionTypeStatus;
        $villagePositionType->save();

        /* update staff */
        if (option_is_match('definitif', $villagePositionType->position_type_id)) {
            $staff->position_id = $villagePositionType->position_type_id;
            $staff->position_name = $villagePositionType->position_name;
            $staff->position_code = $villagePositionType->code;
            $staff->position_is_active = true;
            $staff->save();
        } else {
            $staff->position_plt_id = $villagePositionType->position_type_id;
            $staff->position_plt_name = $villagePositionType->position_name;
            $staff->position_plt_code = $villagePositionType->code;
            $staff->position_plt_is_active = true;
            $staff->save();
        }

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
        // dd($this);
    }

    public function setStaffId($id)
    {
        $this->staffId = $id;
    }
}

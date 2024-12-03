<?php

namespace App\Livewire\Forms;

use App\Models\VillageSiltap;
use App\Rules\UniqueVillageSiltap;
use Livewire\Form;

class VillageSiltapForm extends Form
{
    public $id;

    public $district;

    public $village;

    public $positionType;

    public $siltap;

    public $tunjangan;

    public $thp;

    public $villagePositionType;

    public function rules()
    {
        return [
            'district' => 'nullable',
            'village' => 'required',
            'positionType' => [
                'required',
                'exists:options,id',
                new UniqueVillageSiltap($this->village, $this->positionType, $this->id),
            ],
            'siltap' => 'required',
            'tunjangan' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'village.required' => 'Desa wajib diisi.',
            'positionType.required' => 'Jabatan wajib diisi.',
            'siltap.required' => 'Siltap wajib diisi.',
            'tunjangan.required' => 'Tunjangan wajib diisi.',
        ];
    }

    public function store()
    {
        $this->validate();

        $tunjangan = \format_price($this->tunjangan);
        $siltap = \format_price($this->siltap);
        $thp = $tunjangan + $siltap;

        $payload = [
            'village_id' => $this->village,
            'position_type_id' => $this->positionType,
            'siltap' => $siltap,
            'tunjangan' => $tunjangan,
            'thp' => $thp,
            'code' => $this->code,
        ];

        /* proses simpan */
        $model = VillageSiltap::updateOrCreate([
            'id' => $this->id,
        ], $payload);

        return $model;
    }

    public function setModel(VillageSiltap $model)
    {
        $this->id = $model->id;
        $this->villagePositionType = $model; // untuk validasi email unique

        $this->district = $model->village->district->id;
        $this->village = $model->village_id;
        $this->positionType = $model->position_type_id;
        $this->positionTypeStatus = $model->position_type_status_id;
        $this->positionName = $model->position_name;
        $this->siltap = $model->siltap;
        $this->tunjangan = $model->tunjangan;
        $this->thp = $model->thp;
        $this->isParkir = $model->is_parkir;
        $this->code = $model->code;
    }
}

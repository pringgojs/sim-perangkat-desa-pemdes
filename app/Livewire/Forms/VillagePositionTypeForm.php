<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;
use App\Models\VillagePositionType;
use App\Rules\UniqueVillagePositionType;

class VillagePositionTypeForm extends Form
{
    public $id;

    public $district;
    public $village;
    public $positionType;
    public $positionTypeStatus;
    public $positionName;
    public $siltap;
    public $tunjangan;
    public $thp;
    public $isParkir;
    public $code;

    public $villagePositionType;

    public function rules()
    {
        return [
            'district' => 'nullable',
            'village' => 'required',
            'positionType' => [
                'required',
                'exists:options,id',
                new UniqueVillagePositionType($this->village, $this->positionType, $this->id),
            ],
            'positionTypeStatus' => 'required',
            'positionName' => 'required|max:20',
            'siltap' => 'required',
            'tunjangan' => 'required',
            'code' => 'required|string|max:50',
        ];

    }

    public function messages() 
    {
        return [
            'village.required' => 'Desa wajib diisi.',
            'positionType.required' => 'Jabatan wajib diisi.',
            'positionTypeStatus.required' => 'Status jabatan wajib diisi.',
            'positionName.required' => 'Nama jabatan wajib diisi.',
            'siltap.required' => 'Siltap wajib diisi.',
            'tunjangan.required' => 'Tunjangan wajib diisi.',
            'isParkir.required' => 'Status parkir wajib diisi.',
            'code.max' => 'Kode jabatan maksimal 50 karakter.',
            'code.required' => 'Kode jabatan wajib diisi.',
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
            'position_type_status_id' => $this->positionTypeStatus,
            'position_name' => $this->positionName,
            'siltap' => $siltap,
            'tunjangan' => $tunjangan,
            'thp' => $thp,
            'code' => $this->code,
        ];

        /* proses simpan */
        $model = VillagePositionType::updateOrCreate([
            'id' => $this->id
        ], $payload);

        return $model;
    }

    public function setModel(VillagePositionType $model)
    {
        $this->villagePositionType = $model; // untuk validasi email unique

        $this->district = $model->district->id;
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
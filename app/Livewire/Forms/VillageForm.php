<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Village;
use App\Rules\UniqueVillageCode;
use Livewire\Attributes\Validate;

class VillageForm extends Form
{
    public $id = ''; // digunakan untuk edit

    // #[Validate('required|max:250')]
    public $name = '';

    // #[Validate('required|max:250')]
    public $address = '';

    // #[Validate('required|max:250')]
    public $district = '';

    // #[Validate('required|string|email')]
    public $phone = '';
    
    public $code = '';

    // #[Validate('required|string|min:6')]
    public $type = '';

    // #[Validate('required|string|min:6')]
    public $no_sotk = '';

    // #[Validate('required_with:password|same:password|min:6')]
    // public $repassword = '';

    public $village;

    public function rules()
    {
        return [
            'code' => [
                'required',
                'max:250',
                new UniqueVillageCode($this->code, $this->village),
            ],
            'name' => 'required|max:250',
            'address' => 'required|max:255',
            'phone' => 'required|max:20',
            'district' => 'required',
            'type' => 'required',
            'no_sotk' => 'nullable',
        ];

    }

    public function messages()
    {
        return [
            'code.required' => 'Kode desa wajib diisi.',
            'code.max' => 'Kode desa tidak boleh lebih dari 250 karakter.',
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 250 karakter.',
            'address.required' => 'Alamat wajib diisi.',
            'address.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
            'district.required' => 'Kecamatan wajib diisi.',
            'type.required' => 'Jenis wajib diisi.',
        ];
    }

    public function store()
    {
        $this->validate();

        $payload = [
            'name' => $this->name,
            'code' => $this->code,
            'district_id' => $this->district,
            'address' => $this->address,
            'phone' => $this->phone,
            'type_id' => $this->type,
            'no_sotk' => $this->no_sotk,
        ];

        /* proses simpan */
        $model = Village::updateOrCreate([
            'id' => $this->id,
        ], $payload);

        return $model;
    }

    public function setModel(Village $village)
    {
        $this->village = $village; // untuk validasi email unique

        $this->id = $village->id;
        $this->name = $village->name;
        $this->code = $village->code;
        $this->address = $village->address;
        $this->phone = $village->phone;
        $this->type_id = $village->type_id;
        $this->district = $village->district->id;
        $this->type = $village->type->id;
    }
}

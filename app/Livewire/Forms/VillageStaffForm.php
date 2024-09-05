<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use App\Models\Village;
use App\Models\VillageStaff;
use App\Rules\UniqueUsername;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Spatie\LivewireFilepond\WithFilePond;
use App\Rules\UniqueStaffPositionInVillage;

class VillageStaffForm extends Form
{
    use WithFilePond;

    public $id; // digunakan untuk edit

    public $name;
    public $address;
    public $place_of_birth;
    public $date_of_birth;
    public $ktp;
    public $phone;
    public $position_name;
    public $sk_number;
    public $sk_tmt;
    public $sk_date;
    public $username;
    public $password;
    public $email;
    public $gender;

    public $tmpUrl; // temporary URL img upload
    public $district;
    public $village;
    public $village_staff;
    public $position_type;
    public $data_status;
    public $user;
    public $ktp_old;

    public function rules()
    {
        return [
            'username' => [
                'required',
                'max:10',
                new UniqueUsername($this->username, $this->user)
            ],
            'name' => 'required|max:250',
            'gender' => $this->isMyAccount() ? 'required' : 'nullable',
            'address' => $this->isMyAccount() ? 'required|max:250' : 'nullable',
            'phone' => $this->isMyAccount() ? 'required|max:20' : 'nullable',
            'place_of_birth' => $this->isMyAccount() ? 'required|max:250' : 'nullable',
            'date_of_birth' => $this->isMyAccount() ? 'required' : 'nullable',
            'ktp' => $this->isKtp() ? 'required|image|mimes:jpeg,png|max:300' : 'nullable', // 300 KB
            'position_type' => [
                'required',
                'exists:options,id',
                new UniqueStaffPositionInVillage($this->village, $this->position_type, $this->id),
            ],
            'district' => 'required',
            'village' => 'required',
            'position_name' => $this->isMyAccount() ? 'required|max:250': 'nullable',
            'sk_number' => $this->isMyAccount() && $this->isBPD() ? 'required|max:250' : 'nullable',
            'sk_tmt' => $this->isMyAccount() && $this->isBPD() ? 'required|max:250' : 'nullable',
            'sk_date' => $this->isMyAccount() && $this->isBPD() ? 'required|max:250' : 'nullable',
            'password' => $this->user ? 'nullable' : 'required|string|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/',
            // 'email' => [
            //     'required',
            //     'string',
            //     'email',
            //     Rule::unique('users')->ignore($this->user), 
            // ],
        ];

    }

    public function messages() 
    {
        return [
            'position_type.required' => 'Jenis jabatan wajib diisi.',
            'district.required' => 'Kecamatan wajib diisi.',
            'village.required' => 'Desa wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.max' => 'Username tidak boleh lebih dari 250 karakter.',
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 250 karakter.',
            'address.required' => 'Alamat wajib diisi.',
            'address.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
            'place_of_birth.required' => 'Tempat lahir wajib diisi.',
            'date_of_birth.required' => 'Tanggal lahir wajib diisi.',
            'place_of_birth.required' => 'Tempat lahir wajib diisi.',
            'position_name.required' => 'Jabatan wajib diisi.',
            'ktp.required' => 'Gambar harus diunggah.',
            'ktp.image' => 'File yang diunggah harus berupa gambar.',
            'ktp.mimes' => 'Gambar harus berformat JPEG atau PNG.',
            'ktp.max' => 'Ukuran gambar tidak boleh lebih dari 300KB.',
        ];
    }

    /* $from = admin, maka jangan rubah statusnya */
    public function store($from = null) 
    {
        $this->validate();
        
        $user = self::createUser();

        $payload = [
            'user_id' => $user->id,
            'name' => $this->name,
            'district_id' => $this->district,
            'village_id' => $this->village,
            'address' => $this->address ?? null,
            'phone_number' => $this->phone ?? null,
            'position_type_id' => $this->position_type,
            'date_of_birth' => $this->date_of_birth ?? null,
            'place_of_birth' => $this->place_of_birth ?? null,
            'position_name' => $this->position_name ?? null,
            'sk_number' => $this->sk_number ?? null,
            'sk_tmt' => $this->sk_tmt ?? null,
            'sk_date' => $this->sk_date ?? null,
        ];

        /* jika dari mode tinjau admin, status tidak perlu di rubah ke draft */
        if ($from != 'admin') {
            $payload['data_status_id'] = key_option('draft');
        }

        if ($this->ktp) {
            /* jika ktp is string, maka data ktp di load dari DB, kalau bukan, berarti dari Object Livewire Upload */
            if (!is_string($this->ktp)) {
                /* remove old file */
                if ($this->ktp_old) {
                    // ktp/QnvSbHox97cW0RChaEOI1pmRB6xJJLgAI6k1qAIr.png
                    Storage::delete('public/'.$this->ktp_old);
                }

                $path = $this->ktp->store('ktp', 'public');
                $payload['ktp_scan'] = $path;
            }
        }

        /* proses simpan */
        $model = VillageStaff::updateOrCreate([
            'id' => $this->id
        ], $payload);

        return $model;
    }

    public function createUser()
    {
        $payload = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
        ];

        /* jika password terisi, maka masukkan ke proses simpan */
        if ($this->password) {
            $payload['password'] = bcrypt($this->password);
        }

        $user = User::updateOrCreate([
            'id' => $this->user->id ?? null
        ], $payload);

        $user->assignRole('operator');
        
        return $user;
    }

    public function setModel(VillageStaff $village_staff)
    {
        $this->village_staff = $village_staff;
        $this->user = $village_staff->user;
        $this->data_status = $village_staff->dataStatus->id;
        $this->village = $village_staff->village->id;
        $this->position_type = $village_staff->position_type_id;
        $this->district = $village_staff->village->district_id;
        $this->ktp_old = $village_staff->ktp_scan;

        $this->id = $village_staff->id;
        $this->name = $village_staff->user->name;
        $this->address = $village_staff->address;
        $this->phone = $village_staff->phone_number;
        $this->gender = $village_staff->gender;
        $this->date_of_birth = $village_staff->date_of_birth;
        $this->place_of_birth = $village_staff->place_of_birth;
        $this->ktp = $village_staff->ktp_scan;
        $this->position_name = $village_staff->position_name;
        $this->sk_number = $village_staff->sk_number;
        $this->sk_tmt = $village_staff->sk_tmt;
        $this->sk_date = $village_staff->sk_date;
        $this->is_active = $village_staff->is_active;

        $this->username = $this->user->username;
        $this->email = $this->user->email;
    }

    public function validateFilePhoto()
    {
        $this->tmpUrl = '';
        $this->validateOnly('ktp');
        $this->tmpUrl = $this->ktp->temporaryUrl();
    }

    /* validasi inputan file */
    public function isKtp()
    {
        if (is_string($this->ktp)) return false; // user tidak upload KTP (isi ktp string path)

        return $this->isMyAccount() ? true : false;
    }

    /* validasi untuk beberapa field yang required adalah jika dia mengedit data dia sendiri */
    public function isMyAccount()
    {
        if (!$this->user) return false;
        return $this->user->id == auth()->user()->id;
    }

    public function isBPD()
    {
        return option_is_match('bpd', $this->position_type);
    }

    public function sendToVerification()
    {
        $status = key_option('diajukan');
        $this->village_staff->data_status_id = $status;
        $this->village_staff->save();
    }

    /* method ini dipanggil dari detail staff */
    public function processToApprve($key, $reason = null)
    {
        $status = key_option($key);
        $this->village_staff->data_status_id = $status;
        if ($reason) {
            $this->village_staff->reason_note = $reason;
        }
        $this->village_staff->save();
    }
}

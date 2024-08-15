<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use App\Models\Village;
use App\Models\VillageStaff;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;

class VillageStaffForm extends Form
{
    public $id = ''; // digunakan untuk edit

    public $name = '';
    public $address = '';
    public $place_of_birth = '';
    public $date_of_birth = '';
    public $ktp_scan = '';
    public $phone = '';
    public $position_name = '';
    public $sk_number = '';
    public $sk_tmt = '';
    public $sk_date = '';

    public $username;
    public $password;
    public $email;
    // #[Validate('required_with:password|same:password|min:6')]
    // public $repassword = '';

    public $district;
    public $village;
    public $village_staff;
    public $position_type;
    public $data_status;
    public $user;

    public function rules()
    {
        return [
            'name' => 'required|max:250',
            'address' => 'required|max:250',
            'phone' => 'required|max:20',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'ktp_scan' => $this->id ? 'nullable' : 'required|image|mimes:jpeg,png|max:100', // 100 KB
            'position_name' => 'required',
            'sk_number' => 'nullable',
            'sk_tmt' => 'nullable',
            'sk_date' => 'nullable',
            'role' => 'required',
            'password' => $this->user ? 'nullable' : 'required|string|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/',
            // 'repassword' => !$this->password ? 'nullable' : 'required_with:password|same:password|min:6',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($this->user), 
            ],
        ];

    }

    public function messages() 
    {
        return [
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
            'ktp_scan.required' => 'Gambar harus diunggah.',
            'ktp_scan.image' => 'File yang diunggah harus berupa gambar.',
            'ktp_scan.mimes' => 'Gambar harus berformat JPEG atau PNG.',
            'ktp_scan.max' => 'Ukuran gambar tidak boleh lebih dari 100KB.',
        ];
    }

    public function store() 
    {
        $this->validate();
 
        
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

        $payload = [
            'name' => $this->name,
            'district_id' => $this->district,
            'address' => $this->address,
            'phone' => $this->phone,
            'position_type_id' => $this->position_type,
            'date_of_birth' => $this->date_of_birth,
            'place_of_birth' => $this->place_of_birth,
            'position_name' => $this->position_name,
            'sk_number' => $this->sk_number,
            'sk_tmt' => $this->sk_tmt,
            'sk_date' => $this->sk_date,
        ];

        /* proses simpan */
        $model = VillageStaff::updateOrCreate([
            'id' => $this->id
        ], $payload);

        return $model;
    }

    public function setModel(VillageStaff $village_staff)
    {
        $this->village_staff = $village_staff;
        $this->user = $village_staff->user;
        $this->data_status = $village_staff->data_status->id;
        $this->village = $village_staff->village->id;

        $this->id = $village_staff->id;
        $this->name = $village_staff->name;
        $this->address = $village_staff->address;
        $this->phone = $village_staff->phone_number;
        $this->date_of_birth = $village_staff->date_of_birth;
        $this->place_of_birth = $village_staff->place_of_birth;
        $this->ktp_scan = $village_staff->ktp_scan;
        $this->position_name = $village_staff->place_of_birth;
        $this->sk_number = $village_staff->sk_number;
        $this->sk_tmt = $village_staff->sk_tmt;
        $this->sk_date = $village_staff->sk_date;
        $this->is_active = $village_staff->is_active;

        $this->username = $this->user->username;
        $this->email = $this->user->email;
    }
}

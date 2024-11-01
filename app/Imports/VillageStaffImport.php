<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Village;
use App\Models\VillageStaff;
use App\Models\VillageSiltap;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\VillagePositionType;
use Maatwebsite\Excel\Concerns\ToCollection;

class VillageStaffImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // 0 => "Username"
        // 1 => "Jabatan Definitif"
        // 2 => "Nama Jabatan Definitif"
        // 3 => "Jabatan Plt Plh Pj"
        // 4 => "Nama Jabatan Plt Plh Pj"
        // 5 => "N A M A"
        // 6 => "NAMA DARI KECAMATAN"
        // 7 => "TEMPAT LAHIR"
        // 8 => "TANGGAL LAHIR"
        // 9 => "PENDIDIKAN"
        // 10 => "JENIS KELAMIN"
        // 11 => "KET"

        // DB::beginTransaction();

        foreach ($collection as $i => $item) {
            if ($i == 0) continue;

            echo $i; echo "\n";

            $username = $item[0];
            $jabatan_definitif = $item[1];
            $jabatan_definitif_nama = $item[2];
            $jabatan_plt = $item[3];
            $jabatan_plt_nama = $item[4];
            $nama = $item[5];
            $nama_2 = $item[6];
            $tempat_lahir = $item[7];
            $tanggal_lahir = $item[8];
            $pendidikan = strtolower($item[9]);
            $jenis_kelamin = $item[10];
            $ket = $item[11];
            $kode_desa = explode('-', $jabatan_definitif);
            
            if (!$nama) return;
            
            $position_type_definitif = VillagePositionType::code($jabatan_definitif)->first();
            $position_type_plt = VillagePositionType::code($jabatan_plt)->first();
            $village = $position_type_definitif ? $position_type_definitif->village : null;
            
            $position_type_id = null;
            if ($position_type_definitif) {
                $position_type_id = $position_type_definitif->position_type_id;
            }
            
            $position_type_plt_status_id = null; 
            $position_type_plt_id = null;
            if ($position_type_plt) {
                $position_type_plt_id = $position_type_plt->position_type_id;
                $position_type_plt_status_id = $position_type_plt->positionTypeStatus->id;
            }

            if (!$village) {
                $village = $position_type_plt ? $position_type_plt->village : null;
            }

            if (!$village) return;
            

            $education_level_id = key_option($pendidikan);

            $date = str_replace("'", "", $tanggal_lahir);
            $carbon = null;
            if ($date) {
                $carbon = Carbon::createFromFormat('d/m/Y', $date);
            }

            /* user seeder */
            $user = User::create([
                'name' => $nama,
                'username' => $username,
                'email' => $username.'@gmail.com',
                'password' => bcrypt('password'),
            ]);
    
            $user->assignRole('operator');

            $staff = new VillageStaff;
            $staff->user_id = $user->id;
            $staff->village_id = $village->id;
            $staff->place_of_birth = $tempat_lahir;
            $staff->date_of_birth = $carbon ? $carbon->format('Y-m-d') : null;
            $staff->address = null;
            $staff->name = $nama;
            $staff->another_name = $nama_2;
            $staff->ktp_scan = null;
            $staff->phone_number = null;
            $staff->is_active = true;
            $staff->gender = $jenis_kelamin;
            $staff->education_level_id = $education_level_id;
            $staff->position_id = $position_type_id;
            $staff->position_plt_id = $position_type_plt_id;
            $staff->reason_note = null;
            $staff->data_status_id = key_option('draft');
            $staff->position_name = $jabatan_definitif_nama;
            $staff->position_plt_name = $jabatan_plt_nama;
            $staff->position_code = $jabatan_definitif;
            $staff->position_plt_code = $jabatan_plt;
            $staff->position_plt_status_id = $position_type_plt_status_id;
            $staff->save();

        }

        // DB::commit();
    }
}

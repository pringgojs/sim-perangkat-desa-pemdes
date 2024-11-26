<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Village;
use App\Models\VillageStaff;
use App\Models\VillageSiltap;
use Illuminate\Support\Carbon;
use App\Scopes\VillageStaffScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\VillagePositionType;
use App\Models\VillageStaffHistory;
use Maatwebsite\Excel\Concerns\ToCollection;

class VillageStaffHistoryImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

        // 0 => "Username"
        // 1 => "Kode Jabatan"
        // 2 => "Status"
        // 3 => "PEJABAT"
        // 4 => "NO SK"
        // 5 => "TANGGAL"
        // 6 => "TANGGAL PELANTIKAN"
        // 7 => "HABIS MASA JABATAN"

        // dd($collection);
        foreach ($collection as $i => $item) {
            if ($i == 0) continue;

            $username = $item[0];
            $kode_jabatan = $item[1];
            $status = $item[2];
            $pejabat = $item[3];
            $no_sk = $item[4];

            $tanggal_sk = str_replace('-', '/', $item[5]);
            $tanggal_pelantikan = str_replace('-', '/', $item[6]);
            $tanggal_masa_jabatan = str_replace('-', '/', $item[7]);
            
            $tanggal_sk = str_replace(' ', '', $tanggal_sk);
            $tanggal_pelantikan = str_replace(' ', '', $tanggal_pelantikan);
            $tanggal_masa_jabatan = str_replace(' ', '', $tanggal_masa_jabatan);

            $tanggal_sk = str_replace('//', '/', $tanggal_sk);
            $tanggal_pelantikan = str_replace('//', '/', $tanggal_pelantikan);
            $tanggal_masa_jabatan = str_replace('//', '/', $tanggal_masa_jabatan);

            $staff = VillageStaff::withoutGlobalScope(VillageStaffScope::class)->where('position_code', $kode_jabatan)->orWhere('position_plt_code', $kode_jabatan)->first();
            if (!$staff) continue;

            $village_postition_type = VillagePositionType::code($kode_jabatan)->first();
            if (!$village_postition_type) continue;
            
            echo $i; echo "\n";
            $tanggal_sk = trim(str_replace("'", "", $tanggal_sk));
            
            try {
                if ($tanggal_sk) {
                    $tanggal_sk = Carbon::createFromFormat('d/m/Y', $tanggal_sk);
                }
            } catch (\Throwable $th) {
                //throw $th;
                $tanggal_sk = null;
            }

            $tanggal_pelantikan = trim(str_replace("'", "", $tanggal_pelantikan));
            try {
                if ($tanggal_pelantikan) {
                    $tanggal_pelantikan = Carbon::createFromFormat('d/m/Y', $tanggal_pelantikan);
                }
            } catch (\Throwable $th) {
                $tanggal_pelantikan = null;
            }

            try {
                $tanggal_masa_jabatan = trim(str_replace("'", "", $tanggal_masa_jabatan));
                if ($tanggal_masa_jabatan) {
                    $tanggal_masa_jabatan = Carbon::createFromFormat('d/m/Y', $tanggal_masa_jabatan);
                }
            } catch (\Throwable $th) {
                $tanggal_masa_jabatan = null;
            }

            $history = new VillageStaffHistory;
            $history->village_staff_id = $staff->id;
            $history->village_position_type_id = $village_postition_type->id;
            $history->village_id = $village_postition_type->village_id;
            $history->position_code = $kode_jabatan;
            $history->position_type_id = $village_postition_type->position_type_id;
            $history->position_name = $village_postition_type->position_name;
            $history->position_type_status_id = $village_postition_type->position_type_status_id;
            $history->siltap = $village_postition_type->siltap;
            $history->tunjangan = $village_postition_type->tunjangan;
            $history->thp = $village_postition_type->thp;
            $history->no_sk = $no_sk;
            if ($tanggal_sk) {
                $history->date_of_sk = $tanggal_sk ?? null;
            }

            if ($tanggal_pelantikan) {
                $history->date_of_appointment = $tanggal_pelantikan ?? null;
            }

            if ($tanggal_masa_jabatan) {
                $history->enddate_of_office = $tanggal_masa_jabatan ?? null;
            }

            $history->save();

            /* update status terisi position type */
            // $village_postition_type->is_null_position = true;
            // $village_postition_type->save();
        }
    }
}

<?php

namespace App\Imports;

use App\Models\Option;
use App\Models\Village;
use Illuminate\Support\Collection;
use App\Models\VillagePositionType;
use Maatwebsite\Excel\Concerns\ToCollection;

class VillagePositionTypeImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        #items: array:10 [
        //     0 => "Kode Jabatan"
        //     1 => "NO URUT JABATAN"
        //     2 => "DESA"
        //     3 => "KODE DESA"
        //     4 => "NAMA JABATAN"
        //     5 => "JENIS JABATAN"
        //     6 => "SILTAP"
        //     7 => "TUNJANGAN"
        //     8 => "JUMLAH"
        //     9 => "STATUS"
        // ]

        foreach ($collection as $i => $item) {
            if ($i == 0) continue;

            $villageId = Village::code($item[3])->first()->id;
            if (!$villageId) dd($item);

            $code = $item[0];
            $position_name = $item[4];
            $position_type = $item[5];
            $siltap = $item[6];
            $tunjangan = $item[7];
            $total = $item[8];
            $status = $item[9];

            if ($position_type == 'Staf Seksi') $key = 'staf';
            if ($position_type == 'Staf Urusan') $key = 'staf';
            if ($position_type == 'Kepala Urusan') $key = 'kaur';
            if ($position_type == 'Kepala Seksi') $key = 'kasi';
            if ($position_type == 'Kepala Desa') $key = 'kepala_desa';
            if ($position_type == 'Kepala Wilayah') $key = 'kepala_wilayah';
            if ($position_type == 'Sekretaris Desa') $key = 'sekretaris_desa';

            $position_type_id = key_option($key);
            $status = Option::search($status)->first();
            
            $model = new VillagePositionType;
            $model->code = $code;
            $model->village_id = $villageId;
            $model->position_name = $position_name;
            $model->position_type_id = $position_type_id;
            $model->position_type_status_id = $status->id;
            $model->siltap = $siltap ?? 0;
            $model->tunjangan = $tunjangan ?? 0;
            $model->thp = $total ?? 0;
            $model->save();
        }
    }
}

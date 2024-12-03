<?php

namespace App\Imports;

use App\Models\Village;
use App\Models\VillageSiltap;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class VillageSiltapImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        // 0 => "No"
        // 1 => "Kecamatan"
        // 2 => "Kode Kecamatan"
        // 3 => "Desa"
        // 4 => "Kode Desa"
        // 5 => "Siltap Kades"
        // 6 => "Siltap Sekdes"
        // 7 => "Siltap Kaur"
        // 8 => "Siltap Kamituwo"
        // 9 => "Siltap Kasi"
        // 10 => "Siltap Staf"
        // 11 => "Tunjangan Kades"
        // 12 => "Tunjangan Sekdes"
        // 13 => "Tunjangan Kaur"
        // 14 => "Tunjangan Kamituwo"
        // 15 => "Tunjangan Kasi"
        // 16 => "Tunjangan Staf"

        foreach ($collection as $i => $item) {
            if ($i == 0) {
                continue;
            }

            $villageId = Village::code($item[4])->first()->id;

            $siltap_kades = $item[5];
            $siltap_sekdes = $item[6];
            $siltap_kaur = $item[7];
            $siltap_kamituwo = $item[8];
            $siltap_kasi = $item[9];
            $siltap_staf = $item[10];
            $tunjangan_kades = $item[11];
            $tunjangan_sekdes = $item[12];
            $tunjangan_kaur = $item[13];
            $tunjangan_kamituwo = $item[14];
            $tunjangan_kasi = $item[15];
            $tunjangan_staf = $item[16];

            self::store($villageId, key_option('kepala_desa'), $siltap_kades, $tunjangan_kades);
            self::store($villageId, key_option('sekretaris_desa'), $siltap_sekdes, $tunjangan_sekdes);
            self::store($villageId, key_option('kasi'), $siltap_kasi, $tunjangan_kasi);
            self::store($villageId, key_option('kaur'), $siltap_kaur, $tunjangan_kaur);
            self::store($villageId, key_option('kepala_wilayah'), $siltap_kamituwo, $tunjangan_kamituwo);
            self::store($villageId, key_option('staf'), $siltap_staf, $tunjangan_staf);
        }
    }

    public function store($id, $type_id, $siltap, $tunjangan)
    {
        $model = new VillageSiltap;
        $model->village_id = $id;
        $model->position_type_id = $type_id;
        $model->siltap = $siltap;
        $model->tunjangan = $tunjangan;
        $model->save();

    }
}

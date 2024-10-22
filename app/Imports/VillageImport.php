<?php

namespace App\Imports;

use App\Models\Option;
use App\Models\Village;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class VillageImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // 0 => "KECAMATAN"
        // 1 => "KODE KECAMATAN"
        // 2 => "DESA"
        // 3 => "KODE DESA"
        // 4 => "JUMLAH KASI"
        // 5 => "JUMLAH KAUR"
        // 6 => "KLASIFIKASI"
        foreach ($collection as $i => $item) {
            if ($i == 0) continue;
            
            $district_name = $item[0];
            $village_name = ucwords(strtolower($item[2]));
            $village_code = $item[3];
            $total_kasi = $item[4];
            $total_kaur = $item[5];
            $type = ucwords($item[6]);

            $district = Option::districts()->search(ucwords($district_name))->first();
            $type = Option::search(ucwords($type))->first();

            $data = [
                'id' => Str::uuid(),
                'name' => $village_name,
                'code' => $village_code,
                'total_kasi' => $total_kasi,
                'total_kaur' => $total_kaur,
                'district_id' => $district->id,
                'type_id' => $type->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        
            Village::insert($data);
        }
    }
}

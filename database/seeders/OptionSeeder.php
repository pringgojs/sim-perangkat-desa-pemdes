<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Village;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\VillageTypeDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        self::district();
        self::statusData();
        self::positionType();
        self::villageType();
        self::statusJabatan();

    }

    public function district()
    {
        $districts = [
            'SLAHUNG' => '35.02.01',
            'NGRAYUN' => '35.02.02',
            'BUNGKAL' => '35.02.03',
            'SAMBIT' => '35.02.04',
            'SAWOO' => '35.02.05',
            'SOOKO' => '35.02.06',
            'PULUNG' => '35.02.07',
            'MLARAK' => '35.02.08',
            'JETIS' => '35.02.09',
            'SIMAN' => '35.02.10',
            'BALONG' => '35.02.11',
            'KAUMAN' => '35.02.12',
            'BADEGAN' => '35.02.13',
            'SAMPUNG' => '35.02.14',
            'SUKOREJO' => '35.02.15',
            'BABADAN' => '35.02.16',
            'JENANGAN' => '35.02.18',
            'NGEBEL' => '35.02.19',
            'JAMBON' => '35.02.20',
            'PUDAK' => '35.02.21',
        ];
    
        $data = collect($districts)->map(fn($index, $value) => [
            'id' => Str::uuid(),
            'name' => ucwords($value),
            'key' => null,
            'extra' => serialize(['code' => $index]),
            'type' => 'district',
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();
    
        Option::insert($data);
    }

    public function statusData()
    {
        $options = [
            'Draft', 'Diajukan', 'Revisi', 'Final'];
    
        $data = collect($options)->map(fn($value) => [
            'id' => Str::uuid(),
            'name' => $value,
            'key' => strtolower($value),
            'type' => 'status_data',
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();
    
        Option::insert($data);
    }
    
    public function statusJabatan()
    {
        $options = [
            'Definitif', 'Plt', 'Pj', 'Plh'];
    
        $data = collect($options)->map(fn($value) => [
            'id' => Str::uuid(),
            'name' => $value,
            'key' => strtolower($value),
            'type' => 'status_jabatan',
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();
    
        Option::insert($data);
    }

    public function positionType()
    {
        $options = [
            'Kasi', 'Kaur', 'Sekretaris Desa', 'Kepala Desa', 'Kepala Wilayah', 'BPD', "Staf"];
    
        $data = collect($options)->map(fn($value) => [
            'id' => Str::uuid(),
            'name' => $value,
            'key' => str_replace(' ', '_', strtolower($value)),
            'type' => 'position_type',
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();
    
        Option::insert($data);
    }

    public function villageType()
    {
        $options = [
            'Swadaya', 'Swakarya', 'Swasembada'];
    
        $max_kasi = [2,3,3];

        $data = collect($options)->map(fn($value) => [
            'id' => Str::uuid(),
            'name' => $value,
            'key' => str_replace(' ', '_', strtolower($value)),
            'type' => 'village_type',
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();
    
        Option::insert($data);

        $options = Option::where('type', 'village_type')->get();


        foreach ($options as $i => $item) {
            $model = VillageTypeDetail::insert(
                [
                    'id' => Str::uuid(),
                    'type_id' => $item->id,
                    'max_kasi' => $max_kasi[$i], // TODO: perlu disesuaikan 
                    'max_kaur' => $max_kasi[$i], // TODO: perlu disesuaikan 
                    'is_swakarya' => $i == 1 ? true : false
                ]
            );
        }
    }

    


}

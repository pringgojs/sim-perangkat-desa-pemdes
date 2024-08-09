<?php

namespace Database\Seeders;

use App\Models\Option;
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

    }

    public function district()
    {
        $districts = [
            'Ponorogo', 'Jenangan', 'Babadan', 'Siman', 'Kauman', 'Sukorejo', 'Sampung', 'Badegan', 'Jambon', 'Balong', 
            'Slahung', 'Bungkal', 'Ngrayun', 'Sambit', 'Sawoo', 'Mlarak', 'Jetis', 'Pulung', 'Ngebel', 'Sooko', 'Pudak',
        ];
    
        $data = collect($districts)->map(fn($district) => [
            'name' => $district,
            'key' => null,
            'type' => 'district',
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();
    
        Option::insert($data);
    }

    public function statusData()
    {
        $options = [
            'Draft', 'Diajukan', 'Final'];
    
        $data = collect($options)->map(fn($value) => [
            'name' => $value,
            'key' => strtolower($value),
            'type' => 'status_data',
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();
    
        Option::insert($data);
    }

    public function positionType()
    {
        $options = [
            'Kasi', 'Kaur', 'Sekretaris Desa', 'Kepala Desa', 'Kepala Wilayah', 'BPD'];
    
        $data = collect($options)->map(fn($value) => [
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
            'Desa Tradisional', 'Desa Swadaya', 'Desa Swakarya', 'Desa Swasembada'];
    
        $data = collect($options)->map(fn($value) => [
            'name' => $value,
            'key' => str_replace(' ', '_', strtolower($value)),
            'type' => 'village_type',
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();
    
        Option::insert($data);

        $options = Options::where('type', 'village_type')->get();


        foreach ($options as $item) {
            $model = VillageTypeDetail::insert(
                [
                    'type_id' => $item->id,
                    'max_kasi' => 2, // TODO: perlu disesuaikan 
                    'max_kaur' => 2, // TODO: perlu disesuaikan 
                ]
            );
        }
    }
}

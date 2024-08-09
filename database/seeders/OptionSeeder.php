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
        self::village();

    }

    public function district()
    {
        $districts = [
            'Ponorogo', 'Jenangan', 'Babadan', 'Siman', 'Kauman', 'Sukorejo', 'Sampung', 'Badegan', 'Jambon', 'Balong', 
            'Slahung', 'Bungkal', 'Ngrayun', 'Sambit', 'Sawoo', 'Mlarak', 'Jetis', 'Pulung', 'Ngebel', 'Sooko', 'Pudak',
        ];
    
        $data = collect($districts)->map(fn($district) => [
            'id' => Str::uuid(),
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
            'id' => Str::uuid(),
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
            'Desa Tradisional', 'Desa Swadaya', 'Desa Swakarya', 'Desa Swasembada'];
    
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


        foreach ($options as $item) {
            $model = VillageTypeDetail::insert(
                [
                    'id' => Str::uuid(),
                    'type_id' => $item->id,
                    'max_kasi' => 2, // TODO: perlu disesuaikan 
                    'max_kaur' => 2, // TODO: perlu disesuaikan 
                ]
            );
        }
    }

    public function village()
    {
        $string = 'BrotoCalukCrabakDuriGalakGombangGundikJantiJebengKambengMenggareMojopituNailanNgilo-iloNgloningPlancunganSenepoSimoSlahungTrunengTugurejoWates';
        $options = self::splitByCapitalLetters($string);
    
        $district = Option::whereName('Slahung')->first();
        $type = Option::whereName('Desa Swakarya')->first();

        $data = collect($options)->map(fn($value) => [
            'id' => Str::uuid(),
            'name' => $value,
            'district_id' => $district->id,
            'type_id' => $type->id,
            'created_at' => now(),
            'updated_at' => now(),
        ])->toArray();
    
        Village::insert($data);
    }

    function splitByCapitalLetters($string)
    {
        // Menyisipkan spasi sebelum huruf kapital dan karakter non-huruf
        $result = preg_split('/(?=[A-Z])/', $string, -1, PREG_SPLIT_NO_EMPTY);
        
        // Menghilangkan karakter non-huruf dan mengubah array menjadi string
        $result = array_map(function($item) {
            return trim(preg_replace('/[^A-Za-z]/', '', $item));
        }, $result);
        
        return $result;
    }


}

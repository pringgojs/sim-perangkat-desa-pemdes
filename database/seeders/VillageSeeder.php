<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Option;
use App\Models\Village;
use Illuminate\Support\Str;
use App\Models\VillageStaff;
use App\Imports\VillageImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // self::village();
        self::villageImport();
        // self::villageStaff();
    }

    public function villageImport()
    {
        Excel::import(new VillageImport, storage_path('app/resources/data-desa.xlsx'));

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

    public function villageStaff()
    {
        $village = Village::first();
        $positionType = Option::whereName('Sekretaris Desa')->first();
        $dataStatus = Option::whereName('Final')->first();

        /* create user */
        $user = User::create([
            'name' => 'Pringgo Juni Saputro',
            'username' => 'pringgojs',
            'email' => 'pringgojs@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('operator');

        /* create perangkat */
        $villageStaff = VillageStaff::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'village_id' => $village->id,
            'place_of_birth' => 'Ponorogo',
            'date_of_birth' => '1980-01-01',
            'address' => 'Jl. Contoh No. 1',
            'ktp_scan' => 'scan1.jpg',
            'phone_number' => '081234567890',
            'position_type_id' => $positionType->id,
            'is_active' => true,
            'position_name' => $positionType->name,
            'data_status_id' => $dataStatus->id,
            'sk_number' => 'SK123',
            'sk_tmt' => '2024-01-01',
            'sk_date' => '2024-01-01',
        ]);

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

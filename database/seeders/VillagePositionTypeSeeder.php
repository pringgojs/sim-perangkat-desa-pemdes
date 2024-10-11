<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\VillagePositionTypeImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VillagePositionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new VillagePositionTypeImport, storage_path('app/resources/data-jabatan-desa.xlsx'));
    }
}

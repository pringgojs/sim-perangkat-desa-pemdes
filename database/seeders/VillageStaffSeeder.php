<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Imports\VillageStaffImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VillageStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new VillageStaffImport, storage_path('app/resources/data-perangkat.xlsx'));
    }
}

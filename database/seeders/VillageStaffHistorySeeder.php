<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\VillageStaffHistoryImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VillageStaffHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new VillageStaffHistoryImport, storage_path('app/resources/data-histori-jabatan.xlsx'));
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Imports\VillageSiltapImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VillageSiltapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new VillageSiltapImport, storage_path('app/resources/data-siltap.xlsx'));

    }
}

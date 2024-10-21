<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\OptionSeeder;
use Database\Seeders\VillageSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\VillageStaffSeeder;
use Database\Seeders\VillagePositionTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(VillageSeeder::class);
        $this->call(VillageSiltapSeeder::class);
        $this->call(VillagePositionTypeSeeder::class);
        $this->call(VillageStaffSeeder::class);
    }
}

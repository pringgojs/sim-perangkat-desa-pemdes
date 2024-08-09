<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Administrator',
            'username' => 'root',
            'email' => 'admin@dev.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('administrator');

        // $user = User::create([
        //     'name' => 'Pringgo Juni S',
        //     'username' => 'pringgojs',
        //     'email' => 'pringgo.saputro@gmail.com',
        //     'password' => bcrypt('password'),
        // ]);

        // $user->assignRole('administrator');
    }
}

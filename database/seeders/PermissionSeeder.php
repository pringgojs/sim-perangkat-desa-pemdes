<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Services\PermissionService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // self::role();
        self::permission();
        
    }

    public function role()
    {
        $roles = ['administrator', 'operator'];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }

    public function permission()
    {
        $group = 'Desa';
        $permissions = PermissionService::create($group, ['create', 'edit', 'delete', 'export']);

        $group = 'Jenis Desa';
        $permissions = PermissionService::create($group, ['create', 'edit', 'delete', 'export']);
    }
}

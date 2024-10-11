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
        self::permission();
    }

    

    public function permission()
    {
        $group = 'User';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete', 'export']);

        $group = 'Desa';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete', 'export']);

        $group = 'Jenis Desa';
        $permissions = PermissionService::create($group, ['view', 'create', 'edit', 'delete', 'export']);
    }
}

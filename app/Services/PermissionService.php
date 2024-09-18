<?php

namespace App\Services;

use Spatie\Permission\Models\Permission;

class PermissionService
{
    public static function create($group = null,  $permissions = [])
    {
        foreach ($permissions as $item) {
            $groupMask = str_replace(' ', '.', $group);
            $payload = [
                'name' => strtolower($groupMask.'.'.$item),
                'group' => strtolower($group)
            ];

            $permission = Permission::updateOrCreate([
                'name' => $item
            ], $payload);
        }
    }

    public static function getName($input = null)
    {
         // Memecah string berdasarkan titik
        $parts = explode('.', $input);

        // Mengambil bagian terakhir dari array
        $result = end($parts);

        return $result;
    }

}
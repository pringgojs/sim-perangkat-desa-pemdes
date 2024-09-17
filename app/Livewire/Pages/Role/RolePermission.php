<?php

namespace App\Livewire\Pages\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermission extends Component
{
    public $role;
    public $permissions;
    protected $listeners = ['refreshComponent' => '$refresh', 'add'];

    public function mount($id)
    {
        $this->role = Role::findOrFail($id);
        $this->permissions = Permission::orderBy('name')->get();
    }

    public function add($permissionId)
    {
        if ($this->role->hasPermissionTo($permissionId)) {
            $this->role->revokePermissionTo($permissionId);
        }

        $this->role->givePermissionTo($permissionId);
    }

    public function render()
    {
        return view('livewire.pages.role.role-permission');
    }
}

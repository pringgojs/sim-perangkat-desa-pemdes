<?php

namespace App\Rules;

use Closure;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueRole implements ValidationRule
{
    protected $role;
    protected $name;

    public function __construct($name, $role = null)
    {
        $this->name = $name;
        $this->role = $role;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Role::where('name', $this->name);

        if ($this->role) {
            $query->where('id', '!=', $this->role->id);
        }

        if ($query->exists()) {
            $fail('nama ini sudah ada. Silahkan pilih yang lain.');
        }
    }
}
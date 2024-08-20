<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class VillageStaffScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $user = auth()->user();

        if ($user->hasRole('operator')) {
            $builder->where('village_id', $user->staff()->village_id); // Asumsi village_id ada di tabel users
        }

        // Jika user adalah admin, tidak ada filter yang diterapkan, semua data ditampilkan
    }
}

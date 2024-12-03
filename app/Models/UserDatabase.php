<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDatabase extends Model
{
    use AutoUuid, HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'user',
        'password',
        'db_name',
    ];
}

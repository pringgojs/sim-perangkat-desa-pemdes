<?php

namespace App\Models;

use App\Models\AutoUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDatabase extends Model
{
    use HasFactory, HasUuids, AutoUuid;
    protected $fillable = [
        'user_id',
        'user',
        'password',
        'db_name',
    ];

}

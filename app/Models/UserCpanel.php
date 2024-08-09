<?php

namespace App\Models;

use App\Models\AutoUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCpanel extends Model
{
    use HasFactory, HasUuids, AutoUuid;
    protected $fillable = [
        'user_id',
        'username',
        'domain',
        'password',
        'pkgname'
    ];
}

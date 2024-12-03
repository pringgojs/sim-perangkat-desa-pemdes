<?php

namespace App\Models;

use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageTypeDetail extends Model
{
    use GenerateUuid, HasFactory, HasUuids;

    // UUID sebagai primary key
    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'type_id',
        'max_kasi',
        'max_kaur',
    ];
}

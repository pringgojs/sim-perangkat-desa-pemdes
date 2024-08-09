<?php

namespace App\Models;

use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory, HasUuids, GenerateUuid;

    // UUID sebagai primary key
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'type',
        'key'
    ];

    // Relasi ke tabel villages (jika diperlukan)
    public function villages()
    {
        return $this->hasMany(Village::class, 'district_id');
    }

    // Relasi ke tabel village_staff (jika diperlukan)
    public function villageStaff()
    {
        return $this->hasMany(VillageStaff::class, 'position_type_id');
    }
}

<?php

namespace App\Models;

use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends Model
{
    use HasFactory, HasUuids, GenerateUuid;

    // UUID sebagai primary key
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'district_id',
        'address',
        'phone',
        'type',
        'no_sotk',
    ];

    // Relasi ke tabel options
    public function district()
    {
        return $this->belongsTo(Option::class, 'district_id');
    }

    public function type()
    {
        return $this->belongsTo(Option::class, 'type');
    }

    // Relasi ke tabel village_staff
    public function staff()
    {
        return $this->hasMany(VillageStaff::class, 'village_id');
    }
}

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

    public function villageTypeDetail()
    {
        return $this->hasOne(VillageTypeDetail::class, 'type_id');
    }
    
    // Relasi ke tabel village_staff (jika diperlukan)
    public function villageStaff()
    {
        return $this->hasMany(VillageStaff::class, 'position_type_id');
    }

     // Relasi ke tabel village_staff (jika diperlukan)
    public function villageStaffStatusData()
    {
        return $this->hasMany(VillageStaff::class, 'data_status_id');
    }

    public function scopeDistricts($q)
    {
        $q->where('type', 'district')->orderBy('name');
    }

    public function scopeVillageTypes($q)
    {
        $q->where('type', 'village_type')->orderBy('name');
    }

    public function scopeEducationLevels($q)
    {
        $q->where('type', 'education_level')->orderBy('name');
    }

    public function scopePositionTypeStatus($q)
    {
        $q->where('type', 'position_type_status')->orderBy('name');
    }

    public function scopePositionTypes($q)
    {
        $q->where('type', 'position_type')->orderBy('name');
    }

    public function scopeStatusData($q)
    {
        $q->where('type', 'status_data')->orderBy('name');
    }

    public function scopeOrderByDefault($q)
    {
        $q->orderBy('name');
    }
    
    public function scopeSearch($q, $search = null)
    {
        if (!$search) return;

        $q->where('name', 'like', '%'.$search.'%');
    }
}

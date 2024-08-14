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
        'type_id',
        'no_sotk',
    ];

    // Relasi ke tabel options
    public function district()
    {
        return $this->belongsTo(Option::class, 'district_id');
    }

    public function type()
    {
        return $this->belongsTo(Option::class, 'type_id');
    }

    // Relasi ke tabel village_staff
    public function staff()
    {
        return $this->hasMany(VillageStaff::class, 'village_id');
    }
    
    public function scopeSearch($q, $search = null)
    {
        if (!$search) return;

        $q->where('name', 'like', '%'.$search.'%')
            ->orWhere('address', 'like', '%' . $search . '%');
    }

    public function scopeOrderByDefault($q)
    {
        $q->orderBy('name');
    }
}

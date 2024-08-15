<?php

namespace App\Models;

use App\Models\AutoUuid;
use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VillageStaff extends Model
{
    use HasFactory, HasUuids, GenerateUuid;

    // UUID sebagai primary key
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'village_id',
        'place_of_birth',
        'date_of_birth',
        'address',
        'ktp_scan',
        'phone_number',
        'position_type_id',
        'is_active',
        'position_name',
        'data_status_id',
        'sk_number',
        'sk_tmt',
        'sk_date',
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke tabel villages
    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }

    // Relasi ke tabel options
    public function positionType()
    {
        return $this->belongsTo(Option::class, 'position_type_id');
    }

    // Relasi ke tabel options
    public function dataStatus()
    {
        return $this->belongsTo(Option::class, 'data_status_id');
    }

    public function scopeType($q, $type)
    {
        $q->where('position_type_id', $type);
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Untuk UUID

class VillageSiltap extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'village_siltap';

    protected $fillable = [
        'id',
        'village_id',
        'position_type_id',
        'siltap',
        'tunjangan',
    ];

    public $incrementing = false;
    protected $keyType = 'uuid';

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function positionType()
    {
        return $this->belongsTo(Option::class, 'position_type_id');
    }

    public function scopeFilter($q,$params = [])
    {
        if (!isset($params['area'])) return;

        if ($params['search']) {
            $q->search($params['search']);
            
            return;
        }

        /* filter berdasarkan array village_id */
        if ($params['area'] == 'village' && $params['selectedVillage']) {
            $q->whereIn('village_id', $params['selectedVillage']);
        }

        if ($params['area'] == 'district' && $params['selectedDistrict']) {
            $villages = Village::whereIn('district_id', $params['selectedDistrict'])->pluck('id')->toArray();
            $q->whereIn('village_id', $villages);
        }

        if ($params['positionType']) {
            $q->where('position_type_id', $params['positionType']);
        }
    }
}

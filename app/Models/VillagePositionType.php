<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VillagePositionType extends Model
{
    use HasFactory, HasUuids;
    use SoftDeletes;

    protected $table = 'village_position_type';

    protected $fillable = [
        'id',
        'village_id',
        'position_type_id',
        'position_type_status_id',
        'siltap',
        'position_name',
        'tunjangan',
        'thp',
        'code',
        'is_parkir',
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

    public function positionTypeStatus()
    {
        return $this->belongsTo(Option::class, 'position_type_status_id');
    }

    public function staffHistory()
    {
        return $this->hasOne(VillageStaffHistory::class, 'village_position_type_id')->where('is_active', true);
    }

    public function scopeOrderByDefault($q)
    {
        $q->orderBy('code');
    }

    public function scopeCode($q, $code = null)
    {
        $q->where('code', $code);
    }

    public function scopeVillageId($q, $id = null)
    {
        $q->where('village_id', $id);
    }

    public function scopePositionTypeId($q, $id = null)
    {
        $q->where('position_type_id', $id);
    }

    public function scopeSearch($q, $search = null)
    {
        $q->where('code', 'like', '%'.$search.'%');
        // ->orWhere('address', 'like', '%' . $search . '%');
    }

    public function scopeFilter($q, $params = [])
    {
        if (! isset($params['area'])) {
            return;
        }

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

        if ($params['positionStatus']) {
            $q->where('position_type_status_id', $params['positionStatus']);
        }

        if ($params['isParkir']) {
            $q->where('is_parkir', $params['isParkir']);
        }

        if ($params['isNullPerson']) {
            $q->doesntHave('staffHistory');
        }
    }
}

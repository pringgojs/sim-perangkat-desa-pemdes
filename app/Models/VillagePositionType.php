<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class VillagePositionType extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'village_position_type';

    protected $fillable = [
        'id',
        'village_id',
        'position_type_id',
        'position_type_status_id',
        'siltap',
        'tunjangan',
        'thp',
        'code',
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
}

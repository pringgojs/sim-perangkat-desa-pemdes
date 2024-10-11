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
}

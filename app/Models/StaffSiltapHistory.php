<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffSiltapHistory extends Model
{
    use HasFactory;
    protected $table = 'village_staff_siltap_histories';

    public $incrementing = false; // For UUID
    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'village_staff_id',
        'village_staff_history_id',
        'siltap',
        'tunjangan',
        'thp',
        'is_active',
    ];

    protected $casts = [
        'siltap' => 'float',
        'tunjangan' => 'float',
        'thp' => 'float',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid(); // Generate UUID
        });
    }

    // Define relationships
    public function villageStaff()
    {
        return $this->belongsTo(VillageStaff::class);
    }

    public function villageStaffHistory()
    {
        return $this->belongsTo(VillageStaffHistory::class);
    }

}

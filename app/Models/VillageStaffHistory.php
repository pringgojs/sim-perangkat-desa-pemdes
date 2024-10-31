<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VillageStaffHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'village_staff_histories';
    
    public $incrementing = false; // For UUID
    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'village_staff_id',
        'village_position_type_id',
        'village_id',
        'position_code',
        'position_type_id',
        'position_name',
        'position_type_status_id',
        'siltap',
        'tunjangan',
        'thp',
        'no_sk',
        'date_of_sk',
        'date_of_appointment',
        'enddate_of_office',
    ];

    protected $casts = [
        'siltap' => 'float',
        'tunjangan' => 'float',
        'thp' => 'float',
        'date_of_sk' => 'datetime',
        'date_of_appointment' => 'datetime',
        'enddate_of_office' => 'datetime',
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

    public function villagePositionType()
    {
        return $this->belongsTo(VillagePositionType::class);
    }

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

    public function scopeStaffId($q, $id)
    {
        if (!$id) return;

        $q->where('village_staff_id', $id);
    }

    public function getDateOfApp()
    {
        if (!$this->date_of_appointment) return '-';

        return date_format_view($this->date_of_appointment);
    }

    public function getEndDateOfOff()
    {
        if (!$this->enddate_of_office) return '-';

        return date_format_view($this->enddate_of_office);
    }

}

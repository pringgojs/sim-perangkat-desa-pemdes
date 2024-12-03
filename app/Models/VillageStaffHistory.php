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
        'is_active',
        'is_parkir',
        'date_of_appointment',
        'enddate_of_office',
        'non_active_at'
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
        $q->where('village_staff_id', $id);
    }

    public function scopeActive($q)
    {
        $q->where('is_active', true);
    }

    public function scopeNonActive($q, $id)
    {
        $q->where('is_active', false);
    }

    public function scopeFilter($q, $params = [])
    {
        if (!isset($params['area'])) return;

        /* filter berdasarkan array village_id */
        if ($params['area'] == 'village' && $params['selectedVillage']) {
            $q->whereIn('village_id', $params['selectedVillage']);
        }

        if ($params['area'] == 'district' && $params['selectedDistrict']) {
            $villages = Village::whereIn('district_id', $params['selectedDistrict'])->pluck('id')->toArray();
            $q->whereIn('village_id', $villages);
        }

        if ($params['positionStatus']) {
            $q->where('position_type_status_id', $params['positionStatus']);
        } 
        
        if ($params['positionType']) {
            $q->where('position_type_id', $params['positionType']);
        }
    }

    public function scopePensiunToday($q)
    {
        $q->whereDate('enddate_of_office', date('Y-m-d'));
    }

    public function scopePensiunThisMonth($q)
    {
        $q->whereMonth('enddate_of_office', date('m'))
            ->whereYear('enddate_of_office', date('Y'));
    }

    public function scopePensiunOtherMonth($q, $month = null, $year = null)
    {
        if (!$month || !$year) return;

        $q->whereMonth('enddate_of_office', $month);
        $q->whereYear('enddate_of_office', $year);
    }

    public function scopePensiunDateRange($q, $dateStart = null, $dateEnd = null)
    {
        if (!$dateStart || !$dateEnd) return;

        $start = Carbon::parse($dateStart)->format('Y-m-d');
        $end = Carbon::parse($dateEnd)->format('Y-m-d');
        
        $q->whereBetween('enddate_of_office', [$start, $end]);
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

    public function getNonActiveAt()
    {
        if (!$this->non_active_at) return '-';

        return date_format_view($this->non_active_at);
    }

}

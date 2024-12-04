<?php

namespace App\Models;

use App\Constants\Constants;
use App\Scopes\VillageStaffScope;
use App\Traits\GenerateUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VillageStaff extends Model
{
    use GenerateUuid, HasFactory, HasUuids;
    use SoftDeletes;

    protected static function booted()
    {
        static::addGlobalScope(new VillageStaffScope);
    }

    // UUID sebagai primary key
    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'village_id',
        'place_of_birth',
        'date_of_birth',
        'name',
        'address',
        'ktp_scan',
        'phone_number',
        'position_id',
        'position_plt_id',
        'is_active',
        'position_name',
        'position_code',
        'position_plt_name',
        'position_plt_code',
        'position_plt_status_id',
        'data_status_id',
        'education_level_id',
        'sk_number',
        'sk_tmt',
        'gender',
        'sk_date',
        'date_of_pensiun',
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
        return $this->belongsTo(Option::class, 'position_id');
    }

    public function histories()
    {
        return $this->hasMany(VillageStaffHistory::class, 'village_staff_id')->where('is_active', true);
    }

    public function educationLevel()
    {
        return $this->belongsTo(Option::class, 'education_level_id');
    }

    // Relasi ke tabel options
    public function dataStatus()
    {
        return $this->belongsTo(Option::class, 'data_status_id');
    }

    public function scopeType($q, $type)
    {
        $q->where('position_id', $type);
    }

    public function scopeVillage($q, $village = null)
    {
        $q->where('village_id', $village);
    }

    public function scopeDistrict($q, $district = null)
    {
        if ($district) {
            $villages = Village::where('district_id', $district)->pluck('id')->toArray();
            $q->whereIn('village_id', $villages);
        }
    }

    public function scopeFilter($q, $params = [])
    {
        // dd($params);
        info($params);

        if (! isset($params['area'])) {
            return;
        }

        if ($params['search']) {
            $q->search($params['search']);
            // return;
        }

        /* filter berdasarkan array village_id */
        if ($params['area'] == 'village' && $params['selectedVillage']) {
            $q->whereIn('village_id', $params['selectedVillage']);
        }

        if ($params['area'] == 'district' && $params['selectedDistrict']) {
            $villages = Village::whereIn('district_id', $params['selectedDistrict'])->pluck('id')->toArray();
            $q->whereIn('village_id', $villages);
        }

        if ($params['positionStatus'] && $params['positionType']) {
            $is_definitif = option_is_match('definitif', $params['positionStatus']);
            if (! $is_definitif) {
                /* jika bukan definitf, cari berdasarkan kolom position_plt_id */
                $q->where('position_plt_status_id', $params['positionStatus']);
                $q->where('position_plt_id', $params['positionType']);
            } else {
                $q->where('position_id', $params['positionType']);
            }
        } elseif (! $params['positionType'] && $params['positionStatus']) {
            $q->where('position_plt_status_id', $params['positionStatus']);
        } elseif ($params['positionType'] && ! $params['positionStatus']) {
            $q->where(function ($t) use ($params) {
                $t->where('position_id', $params['positionType'])
                    ->orWhere('position_plt_id', $params['positionType']);

            });
        }

        if ($params['isParkir']) {
            $q->isParkir();
        }

        $q->dataStatusId($params['statusData']);
        $q->pensiun($params);
    }

    // public function getDateOfBirthAttribute($value)
    // {
    //     // Set locale ke bahasa Indonesia
    //     Carbon::setLocale('id');

    //     // Buat instance Carbon dari created_at yang diberikan
    //     $carbonDate = Carbon::parse($value);

    //     // Format datetime menjadi 'd F Y H:i' (contoh: 24 Januari 2024 25:56)
    //     return $carbonDate->translatedFormat('d F Y');
    // }

    public function scopePending($q)
    {
        $q->where('data_status_id', key_option('diajukan'));
    }

    public function scopeFinal($q)
    {
        $q->where('data_status_id', key_option('final'));
    }

    public function scopeIsParkir($q)
    {
        $q->where('is_parkir', true);
    }

    public function scopeDataStatusId($q, $id = null)
    {
        if (! $id) {
            return;
        }
        $q->where('data_status_id', $id);
    }

    public function scopeActive($q)
    {
        $q->where('is_active', true);
    }

    public function scopeInActive($q)
    {
        $q->where('is_active', false);
    }

    public function scopeGender($q, $gen)
    {
        $q->where('gender', $gen);
    }

    public function scopeActiveStatus($q, $active = '', $status = null)
    {
        if ($status) {
            $q->where('data_status_id', $status);
        }

        if ($active != '' || $active != null) {
            $q->where('is_active', $active);
        }
    }

    /* menghitung yang 6 bulan lagi pensiun */
    public static function totalStaffRetiringSoon()
    {
        // Tanggal 6 bulan dari sekarang
        $now = Carbon::now()->format('Y-m-d');
        $sixMonthsFromNow = Carbon::now()->addMonths(Constants::COMMING_SOON_PENSIUN)->format('Y-m-d');

        // Query untuk mencari jumlah perangkat desa yang akan pensiun dalam 6 bulan
        return $staffRetiringSoon = VillageStaffHistory::active()->whereBetween(
            'enddate_of_office',
            [$now, $sixMonthsFromNow]
        )->groupBy('village_staff_id')->pluck('village_staff_id')->count();

    }

    /* scope pensiun */
    public function scopePensiun($q, $filter = [])
    {
        if ($filter['dateType'] == '' || $filter['dateType'] == null) {
            return;
        }

        /* mencari ID */
        $staff_ids = VillageStaffHistory::filter($filter)->active()->where(function ($q) use ($filter) {
            if ($filter['dateType'] == 'today') {
                $q->pensiunToday();
            }

            if ($filter['dateType'] == 'this-month') {
                $q->pensiunThisMonth();
            }

            if ($filter['dateType'] == 'other-month') {
                $q->pensiunOtherMonth($filter['month'], $filter['year']);
            }

            if ($filter['dateType'] == 'date-range') {
                $q->pensiunDateRange($filter['dateStart'], $filter['dateEnd']);
            }
        })->groupBy('village_staff_id')->pluck('village_staff_id');

        $q->whereIn('id', $staff_ids);
    }

    public function scopePensiunToday($q)
    {
        return [
            'start' => date('Y-m-d'),
            'end' => date('Y-m-d'),
        ];
    }

    public function scopePensiunThisMonth($q)
    {
        return [
            'start' => date('Y-m-01'),
            'end' => date('Y-m-d'),
        ];
    }

    public function scopeSearch($q, $search = null)
    {
        if (! $search) {
            return;
        }

        $q->where('name', 'like', '%'.$search.'%')
            ->orWhere('address', 'like', '%'.$search.'%');
    }

    public function scopeOrderByDefault($q)
    {
        $q->orderBy('name');
    }

    public static function empty(): array
    {
        return [
            'id' => '',
            'user_id' => 0,
        ];
    }

    public function labelDataStatus()
    {
        $status = $this->dataStatus;
        if ($status->key == 'draft') {
            return '<span class="inline-flex items-center rounded-md bg-red-200 px-2 py-1 text-xs font-medium text-red-700">'.$status->name.'</span>';
        }

        if ($status->key == 'diajukan') {
            return '<span class="inline-flex items-center rounded-md bg-blue-200 px-2 py-1 text-xs font-medium text-blue-700">'.$status->name.'</span>';
        }

        if ($status->key == 'revisi') {
            return '<span class="inline-flex items-center rounded-md bg-yellow-200 px-2 py-1 text-xs font-medium text-yellow-700">'.$status->name.'</span>';
        }

        if ($status->key == 'final') {
            return '<span class="inline-flex items-center rounded-md bg-green-200 px-2 py-1 text-xs font-medium text-green-700">'.$status->name.'</span>';
        }
    }

    public function labelDifinitifStatus()
    {
        if (! $this->position_id) {
            return '';
        }

        if ($this->position_is_active) {
            return '<span class="inline-flex items-center rounded-md bg-green-200 px-2 py-1 text-xs font-medium text-green-700">Aktif</span>';
        }

        return '<span class="inline-flex items-center rounded-md bg-red-200 px-2 py-1 text-xs font-medium text-red-700">Non-aktif</span>';
    }

    public function labelPltStatus()
    {
        if (! $this->position_plt_id) {
            return '';
        }

        if ($this->position_plt_is_active) {
            return '<span class="inline-flex items-center rounded-md bg-green-200 px-2 py-1 text-xs font-medium text-green-700">Aktif</span>';
        }

        return '<span class="inline-flex items-center rounded-md bg-red-200 px-2 py-1 text-xs font-medium text-red-700">Non-aktif</span>';
    }

    public function colorDataStatus()
    {
        $status = $this->dataStatus;
        if ($status->key == 'draft') {
            return ['label' => $status->name, 'color' => 'red'];
        }

        if ($status->key == 'diajukan') {
            return ['label' => $status->name, 'color' => 'blue'];
        }

        if ($status->key == 'revisi') {
            return ['label' => $status->name, 'color' => 'yellow'];
        }

        if ($status->key == 'final') {
            return ['label' => $status->name, 'color' => 'green'];
        }
    }

    public function isPending()
    {
        return $this->data_status_id == key_option('diajukan');
    }

    public function isReadonly()
    {
        return $this->data_status_id == key_option('diajukan') || $this->data_status_id == key_option('final');
    }
}

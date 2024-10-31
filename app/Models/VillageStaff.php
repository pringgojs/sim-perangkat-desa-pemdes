<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\AutoUuid;
use App\Traits\GenerateUuid;
use App\Scopes\VillageStaffScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VillageStaff extends Model
{
    use HasFactory, HasUuids, GenerateUuid;
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
        'sk_number',
        'sk_tmt',
        'gender',
        'sk_date',
        'date_of_pensiun'
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
        if (!$type) return;
        
        $q->where('position_id', $type);
    }

    public function scopeVillage($q, $village = null)
    {
        if ($village) {
            $q->where('village_id', $village);
        }
    }

    public function scopeDistrict($q, $district = null)
    {
        if ($district) {
            $villages = Village::where('district_id', $district)->pluck('id')->toArray();
            $q->whereIn('village_id', $villages);
        }
    }

    public function scopeFilter($q,$params = [])
    {
        if (!isset($params['area'])) return;

        if ($params['search']) {
            $q->search($params['search']);
            
            return;
        }

        info($params);
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
            if (!$is_definitif) {
                /* jika bukan definitf, cari berdasarkan kolom position_plt_id */
                $q->where('position_plt_status_id', $params['positionStatus']);
                $q->where('position_plt_id', $params['positionType']);
            } else {
                $q->where('position_id', $params['positionType']);
            }
        } else if (!$params['positionType'] && $params['positionStatus']) {
            $q->where('position_plt_status_id', $params['positionStatus']);
        }  else if ($params['positionType'] && !$params['positionStatus']) {
            $q->where('position_id', $params['positionType']);
            $q->orWhere('position_plt_id', $params['positionType']);
        }

        if ($params['isParkir']) {
            $q->where('is_parkir', $params['isParkir']);
        }
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
        $q->where('data_status_id', key_option('diajukan') );
    }

    public function scopeFinal($q)
    {
        $q->where('data_status_id', key_option('final') );
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
        $sixMonthsFromNow = Carbon::now()->addMonths(6)->format('Y-m-d');

        // dd($sixMonthsFromNow);
        // Query untuk mencari jumlah perangkat desa yang akan pensiun dalam 6 bulan
        return $staffRetiringSoon = VillageStaff::active()->whereBetween(
            'date_of_pensiun', 
            [$now, $sixMonthsFromNow]
        )->count();

    }

    /* menghitung yang 6 bulan lagi pensiun */
    public static function totalBpdRetiringSoon()
    {
        $now = Carbon::now()->format('Y-m-d');
        $sixMonthsFromNow = Carbon::now()->addMonths(6)->format('Y-m-d');

        $bpd = key_option('bpd');
        // Query untuk mencari jumlah perangkat desa yang akan pensiun dalam 6 bulan
        return $staffRetiringSoon = VillageStaff::active()->whereBetween(
            'date_of_pensiun', 
            [$now, $sixMonthsFromNow]
        )->type($bpd)->count();
    }


    /* scope pensiun */
    public function scopePensiun($q, $isWillRetire = false)
    {
        if (!$isWillRetire) return;
        
        // Tanggal 6 bulan dari sekarang
        $now = Carbon::now()->format('Y-m-d');
        $sixMonthsFromNow = Carbon::now()->addMonths(6)->format('Y-m-d');

        // Query untuk mencari jumlah perangkat desa yang akan pensiun dalam 6 bulan
        $q->whereBetween( 'date_of_pensiun', [$now, $sixMonthsFromNow]);
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

    public static function empty(): array
    {
        return [
            "id" => '',
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

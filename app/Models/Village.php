<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends Model
{
    use HasFactory, HasUuids, GenerateUuid;

    // UUID sebagai primary key
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'district_id',
        'address',
        'phone',
        'type_id',
        'no_sotk',
    ];

    // Relasi ke tabel options
    public function district()
    {
        return $this->belongsTo(Option::class, 'district_id');
    }

    public function type()
    {
        return $this->belongsTo(Option::class, 'type_id');
    }

    // Relasi ke tabel village_staff
    public function staff()
    {
        return $this->hasMany(VillageStaff::class, 'village_id');
    }
    
    public function scopeSearch($q, $search = null)
    {
        if (!$search) return;

        $q->where('name', 'like', '%'.$search.'%')
            ->orWhere('address', 'like', '%' . $search . '%');
    }

    public function scopeDistrict($q, $district = null)
    {
        if (!$district) return;

        $q->where('district_id', $district);
    }

    public function scopeType($q, $type = null)
    {
        if (!$type) return;

        $q->where('type_id', $type);
    }

    public function scopeOrderByDefault($q)
    {
        $q->orderBy('name');
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

    public function labelType()
    {
        $status = $this->type;
        
        if ($status->key == 'desa_swadaya') {
            return '<span class="inline-flex items-center rounded-md bg-green-200 px-2 py-1 text-xs font-medium text-green-700">'.$status->name.'</span>';
        }

        if ($status->key == 'desa_swakarya') {
            return '<span class="inline-flex items-center rounded-md bg-blue-200 px-2 py-1 text-xs font-medium text-blue-700">'.$status->name.'</span>';
        }

        if ($status->key == 'desa_swasembada') {
            return '<span class="inline-flex items-center rounded-md bg-yellow-200 px-2 py-1 text-xs font-medium text-yellow-700">'.$status->name.'</span>';
        }
    }
    /* menghitung yang 6 bulan lagi pensiun */
    public function totalStaffRetiringSoon()
    {
        // Tanggal 6 bulan dari sekarang
        $now = Carbon::now()->format('Y-m-d');
        $sixMonthsFromNow = Carbon::now()->addMonths(6)->format('Y-m-d');

        // Query untuk mencari jumlah perangkat desa yang akan pensiun dalam 6 bulan
        return $staffRetiringSoon = VillageStaff::where('village_id', $this->id)->active()->whereBetween(
            'date_of_pensiun', 
            [$now, $sixMonthsFromNow]
        )->count();

    }

    /* menghitung yang 6 bulan lagi pensiun */
    public function totalBpdRetiringSoon()
    {
        $now = Carbon::now()->format('Y-m-d');
        $sixMonthsFromNow = Carbon::now()->addMonths(6)->format('Y-m-d');

        $bpd = key_option('bpd');
        // Query untuk mencari jumlah perangkat desa yang akan pensiun dalam 6 bulan
        return $staffRetiringSoon = VillageStaff::where('village_id', $this->id)->active()->whereBetween(
            'date_of_pensiun', 
            [$now, $sixMonthsFromNow]
        )->type($bpd)->count();
    }
}

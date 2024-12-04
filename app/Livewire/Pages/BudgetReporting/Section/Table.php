<?php

namespace App\Livewire\Pages\BudgetReporting\Section;

use DateTime;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use App\Models\VillageStaffHistory;

class Table extends Component
{
    use WithPagination;

    public $filter;
    public $counter = 1;
    public $dateStart;
    public $dateEnd;

    public function render()
    {
        return view('livewire.pages.budget-reporting.section.table');
    }

    #[Computed]
    public function items()
    {
        return VillageStaffHistory::select(
            'villages.code as village_code',
            'villages.name as village_name',
            DB::raw('SUM(village_staff_histories.siltap + village_staff_histories.tunjangan) as total_anggaran')
        )
        ->join('villages', 'village_staff_histories.village_id', '=', 'villages.id')
        ->where('village_staff_histories.is_active', true)
        ->filter($this->filter)
        ->with('village')
        ->groupBy('villages.name')
        ->groupBy('villages.code')
        ->paginate(); 
    }

    /* mendengarkan acara daril filter alpine */
    #[On('filter')]
    public function filter($area = null, $search = null, $positionType = null, $selectedDistrict = [], $selectedVillage = [], $positionStatus = null, $isParkir = false, $isNullPerson = false, $statusData = null, $dateType = null, $month = null, $year = null, $dateStart = null, $dateEnd = null)
    {
        $params = [
            'area' => $area,
            'search' => $search,
            'positionType' => $positionType,
            'selectedDistrict' => $selectedDistrict,
            'selectedVillage' => $selectedVillage,
            'isParkir' => $isParkir,
            'positionStatus' => $positionStatus,
            'isNullPerson' => $isNullPerson,
            'statusData' => $statusData,
            'dateType' => $dateType,
            'month' => $month,
            'year' => $year,
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
        ];

        self::calculateMonthsDifference($dateStart, $dateEnd);
        $this->filter = $params;
        $this->resetPage();
    }

    public function calculateMonthsDifference($date1 = null, $date2 = null)
    {
        if (!$date1 || !$date2) return 1;

        $this->dateStart = $date1;
        $this->dateEnd = $date2;
        
        // Konversi string tanggal ke objek DateTime
        $startDate = new DateTime($date1);
        $endDate = new DateTime($date2);
    
        // Pastikan $startDate lebih kecil dari $endDate
        if ($startDate > $endDate) {
            throw new Exception("Tanggal pertama harus lebih kecil atau sama dengan tanggal kedua.");
        }
    
        // Hitung perbedaan bulan dan tahun
        $yearDiff = $endDate->format('Y') - $startDate->format('Y');
        $monthDiff = $endDate->format('m') - $startDate->format('m');
    
        // Total bulan
        $this->counter = ($yearDiff * 12) + $monthDiff + 1; // +1 karena inklusif bulan pertama dan terakhir
    }

}

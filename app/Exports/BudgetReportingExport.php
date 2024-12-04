<?php

namespace App\Exports;

use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\VillageStaffHistory;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BudgetReportingExport implements FromCollection, WithHeadings, WithMapping
{
    public $i = 0;

    public $filter;
    public $counter;

    public function __construct($filter = [])
    {
        $this->filter = $filter;
        self::calculateMonthsDifference();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
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
        ->get();
    }

    public function calculateMonthsDifference()
    {
        if (!$this->filter) return 1;

        if (!$this->filter['dateStart'] || !$this->filter['dateEnd']) return 1;

        // Konversi string tanggal ke objek DateTime
        $startDate = new DateTime($this->filter['dateStart']);
        $endDate = new DateTime($this->filter['dateEnd']);
    
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
    
    public function headings(): array
    {
        return [
            '#',
            'Kode Desa',
            'Nama Desa',
            'Total Anggaran Per Bulan',
            'Total Anggaran '.$this->counter .' Bulan'
        ];
    }

    public function map($item): array
    {
        return [
            ++$this->i,
            $item->village_code,
            $item->village_name,
            $item->total_anggaran,
            $item->total_anggaran * $this->counter,
        ];
    }
}

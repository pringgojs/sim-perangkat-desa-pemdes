<?php

namespace App\Livewire\Pages\Dashboard\Section;

use Livewire\Component;
use App\Models\VillageStaff;

class StatStatus extends Component
{
    public $stats;
    public function mount()
    {
        $total = VillageStaff::active()->count();
        $total_final = VillageStaff::active()->final()->count();
        $total_staff_retiring_soon = VillageStaff::totalStaffRetiringSoon();
        $total_bpd_retiring_soon = VillageStaff::totalBpdRetiringSoon();

        $this->stats = [
            'Jumlah Total Perangkat (Semua Status)' => $total,
            'Jumlah Perangkat dengan Status Final' => $total_final,
            'Jumlah Perangkat 6 Bulan lagi pensiun' => $total_staff_retiring_soon,
            'Jumlah BPD 6 Bulan lagi pensiun' => $total_bpd_retiring_soon,
        ];
    }

    public function render()
    {
        return view('livewire.pages.dashboard.section.stat-status');
    }
}

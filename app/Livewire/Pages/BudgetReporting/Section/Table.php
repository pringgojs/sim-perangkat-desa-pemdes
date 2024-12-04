<?php

namespace App\Livewire\Pages\BudgetReporting\Section;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use App\Models\VillageStaffHistory;

class Table extends Component
{
    public function render()
    {
        return view('livewire.pages.budget-reporting.section.table');
    }

    #[Computed]
    public function items()
    {
        return VillageStaffHistory::select(
            'villages.name as village_name',
            DB::raw('SUM(village_staff_histories.siltap + village_staff_histories.tunjangan) as total_anggaran')
        )
        ->join('villages', 'village_staff_histories.village_id', '=', 'villages.id')
        ->where('village_staff_histories.is_active', true)
        ->groupBy('villages.name')
        ->paginate(); 
    }

}

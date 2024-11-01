<?php

namespace App\Livewire\Pages\VillageStaffHistory\Section;

use Livewire\Component;
use App\Models\VillageStaffHistory;


class Table extends Component
{
    public $staff;
    public $from;
    public $histories;
    public function mount($staff, $from = null)
    {
        $this->staff = $staff;
        $this->from = $from; // isinya 'admin
        $this->histories = VillageStaffHistory::staffId($staff->id)->with(['positionTypeStatus', 'positionType'])->get();
    }

    public function render()
    {
        return view('livewire.pages.village-staff-history.section.table');
    }
}
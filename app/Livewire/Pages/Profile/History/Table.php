<?php

namespace App\Livewire\Pages\Profile\History;

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
        // dd($this->histories);
    }

    public function render()
    {
        return view('livewire.pages.profile.history.table');
    }
}

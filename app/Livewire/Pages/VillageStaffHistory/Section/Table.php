<?php

namespace App\Livewire\Pages\VillageStaffHistory\Section;

use Livewire\Component;
use App\Models\VillageStaffHistory;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class Table extends Component
{
    use LivewireAlert;

    public $staff;
    public $from;
    public $histories;
    public function mount($staff, $from = null)
    {
        $this->staff = $staff;
        $this->from = $from; // isinya 'admin
        $this->histories = VillageStaffHistory::staffId($staff->id)->with(['positionTypeStatus', 'positionType'])->get();
    }

    public function delete($id)
    {
        $model = VillageStaffHistory::findOrFail($id);
        $model->delete();
        
        $this->alert('success', 'Success!');
        $this->redirectRoute('village-staff.edit', ['id' => $this->staff->id], navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.village-staff-history.section.table');
    }
}
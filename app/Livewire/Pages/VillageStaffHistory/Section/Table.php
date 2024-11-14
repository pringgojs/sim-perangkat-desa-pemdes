<?php

namespace App\Livewire\Pages\VillageStaffHistory\Section;

use Livewire\Component;
use App\Models\VillageStaffHistory;
use App\Services\StaffHistoriesService;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class Table extends Component
{
    use LivewireAlert;

    public $staff;
    public $from;
    public $histories;
    public $modalConfirmDelete = false;
    
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

    /**
     * Set active non active history jabatan
     */
    public function setActive($id)
    {
        $history = VillageStaffHistory::findOrFail($id);
        $is_active = $history->is_active;
        $service = new StaffHistoriesService($history->villagePositionType, $history->villageStaff);

        if ($is_active) {
            $service->ifStaffSetNonActive($history);
        } else {
            $service->store(null, $history->id);
        }

        $this->alert('success', 'Success!');
        $this->redirectRoute('village-staff.edit', ['id' => $this->staff->id], navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.village-staff-history.section.table');
    }
}
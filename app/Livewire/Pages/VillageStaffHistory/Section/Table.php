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
        $history = VillageStaffHistory::findOrFail($id);

        $service = new StaffHistoriesService($history->villagePositionType, $history->villageStaff);
        $service->ifStaffSetNonActive($history);

        /* update data history */
        $history->delete();
        
        $this->alert('success', 'Success!');
        $this->redirectRoute('village-staff.edit', ['id' => $this->staff->id], navigate: true);
    }

    /**
     * Set active non active history jabatan
     */
    public function setActive($id)
    {
        $history = VillageStaffHistory::findOrFail($id);
        $service = new StaffHistoriesService();
        if ($history->is_active) {
            /* non aktifkan */
            $service->setNonActive($history);
        } else {
            $service->setActive($history);
        }
        
        $this->alert('success', 'Success!');
        $this->redirectRoute('village-staff.edit', ['id' => $this->staff->id], navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.village-staff-history.section.table');
    }
}
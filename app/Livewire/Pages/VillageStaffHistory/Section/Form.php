<?php

namespace App\Livewire\Pages\VillageStaffHistory\Section;

use App\Models\Option;
use Livewire\Component;
use App\Models\VillageStaff;
use Illuminate\Support\Facades\DB;
use App\Models\VillagePositionType;
use App\Models\VillageStaffHistory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Livewire\Forms\VillageStaffHistoryForm;

class Form extends Component
{
    use LivewireAlert;

    public VillageStaffHistoryForm $form;
    
    public $staffId;
    public $districts;
    public $villages = [];
    public $positionTypes;
    public $positionTypeStatus;
    public $villagePositionTypes;
    
    public function mount($staffId = null, $id = null)
    {
        $this->staffId = $staffId;
        $staff = VillageStaff::findOrFail($staffId);

        if (!$staff) return;

        $this->form->setStaffId($staffId);
        $this->positionTypeStatus = Option::positionTypeStatus()->get();
        $this->villagePositionTypes = VillagePositionType::with(['positionType'])->villageId($staff->village_id)->get();

        if ($id) {
            $model = VillageStaffHistory::findOrFail($id);
            $this->form->setModel($model);
        }

    }

    public function store()
    {
        DB::beginTransaction();

        $model = $this->form->store();
        
        // dd($model);
        DB::commit();
        
        $this->form->reset();
        $this->alert('success', 'Success!');
        $this->redirectRoute('village-staff.edit', ['id' => $this->staffId], navigate: true);

    }
    
    public function render()
    {
        return view('livewire.pages.village-staff-history.section.form');
    }
}

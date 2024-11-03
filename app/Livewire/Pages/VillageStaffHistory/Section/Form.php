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
    
    public $id;
    public $staffId;
    public $districts;
    public $villages = [];
    public $positionTypes;
    public $positionTypeStatus;
    public $villagePositionTypes;
    public $villagePositionType;
    
    public function mount($staffId = null, $id = null)
    {
        $this->id = $id;
        $this->positionTypeStatus = Option::positionTypeStatus()->get();

        /* jika mode edit parameter $id terisi */
        if ($id) {
            $model = VillageStaffHistory::findOrFail($id);
            $staff = $model->villageStaff;
            
            $this->villagePositionType = VillagePositionType::with(['positionType', 'positionTypeStatus'])->whereId($model->village_position_type_id)->first();
            $this->staffId = $staff->id;
            $this->form->setModel($model);
        }

        /* jika mode create, parameter $staffId terisi */
        if ($staffId) {
            $staff = VillageStaff::findOrFail($staffId);
            $this->staffId = $staffId;
            $this->form->setStaffId($staffId);

        }

        $this->villagePositionTypes = VillagePositionType::with(['positionType'])->villageId($staff->village_id)->get();


    }

    public function viewPositionType()
    {
        if (!$this->form->villagePositionType) return;
        $this->villagePositionType = VillagePositionType::with(['positionType', 'positionTypeStatus'])->whereId($this->form->villagePositionType)->first();

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

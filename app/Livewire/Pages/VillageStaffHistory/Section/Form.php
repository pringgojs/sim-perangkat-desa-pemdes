<?php

namespace App\Livewire\Pages\VillageStaffHistory\Section;

use App\Models\Option;
use Livewire\Component;
use App\Models\VillageStaff;
use App\Models\VillageSiltap;
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
    public $staff;
    public $staffId;
    public $districts;
    public $villages = [];
    public $positionTypes;
    public $positionTypeStatus;
    public $villagePositionTypes;
    
    public $errorCheckingPositionByStatus = false;
    public $positionNow;
    public function mount($staffId = null, $id = null)
    {
        $this->id = $id;
        $this->positionTypeStatus = Option::positionTypeStatus()->get();

        /* jika mode edit parameter $id terisi */
        if ($id) {
            $model = VillageStaffHistory::findOrFail($id);
            $this->staff = $model->villageStaff;
            $this->form->setModel($model);
            $this->form->villagePositionType = $model->village_position_type_id;
        }

        /* jika mode create, parameter $staffId terisi */
        if ($staffId) {
            $this->staff = VillageStaff::findOrFail($staffId);
            $this->form->setStaffId($staffId);
        }

        $this->villagePositionTypes = VillagePositionType::doesntHave('staffHistory')->with(['positionType', 'positionTypeStatus'])->villageId($this->staff->village_id)->get();

        if ($id) {
            $this->villagePositionTypes->push(VillagePositionType::find($model->village_position_type_id));
        }
    }

    public function checkSiltap()
    {
        if (!$this->form->villagePositionType) return;

        $positionType = VillagePositionType::find($this->form->villagePositionType);
        $siltap = VillageSiltap::villageId($this->staff->village_id)->positionTypeId($positionType->position_type_id)->first();
        
        $this->form->siltap = $siltap->siltap ?? 0;
        $this->form->tunjangan = $siltap->tunjangan ?? 0;
    }

    public function store()
    {
        DB::beginTransaction();

        $model = $this->form->store();

        DB::commit();
        
        $this->form->reset();
        $this->alert('success', 'Success!');
        $this->redirectRoute('village-staff.edit', [
            'id' => $this->staff->id,
            'tab' => 'history',
        ], navigate: true);

    }

    public function render()
    {
        return view('livewire.pages.village-staff-history.section.form');
    }
}

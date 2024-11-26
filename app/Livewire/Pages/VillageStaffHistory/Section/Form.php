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
    public $staff;
    public $staffId;
    public $districts;
    public $villages = [];
    public $positionTypes;
    public $positionTypeStatus;
    public $villagePositionTypes;
    public $villagePositionType;
    
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
            self::viewPositionType();
        }

        /* jika mode create, parameter $staffId terisi */
        if ($staffId) {
            $this->staff = VillageStaff::findOrFail($staffId);
            $this->form->setStaffId($staffId);

        }

        $this->villagePositionTypes = VillagePositionType::doesntHave('staffHistory')->with(['positionType', 'positionTypeStatus'])->villageId($this->staff->village_id)->get();
    }

    public function viewPositionType()
    {
        if (!$this->form->villagePositionType) return;
        $this->villagePositionType = VillagePositionType::with(['positionType', 'positionTypeStatus'])->whereId($this->form->villagePositionType)->first();

        $this->positionNow = VillageStaffHistory::active()->with(['villageStaff', 'villagePositionType'])->where('village_position_type_id', $this->form->villagePositionType)->first();
    }

    public function checkPositionByStatus()
    {
        if (!$this->form->positionTypeStatus) return;

        $definitif = key_option('definitif');
        $positionStatus = $this->form->positionTypeStatus;

        $history = VillageStaffHistory::active()
            ->where('village_staff_id', $this->staff->id)
            ->where(function ($q) use ($positionStatus, $definitif) {
                if (option_is_match('definitif', $positionStatus)) {
                    $q->where('position_type_status_id', $definitif);
                } else {
                    $q->where('position_type_status_id', '!=', $definitif);
                }
            })
            ->first();

        $this->errorCheckingPositionByStatus = $history ? true : false;
    }

    public function store()
    {
        DB::beginTransaction();

        $model = $this->form->store();

        DB::commit();
        
        $this->form->reset();
        $this->alert('success', 'Success!');
        $this->redirectRoute('village-staff.edit', ['id' => $this->staff->id], navigate: true);

    }

    public function render()
    {
        return view('livewire.pages.village-staff-history.section.form');
    }
}

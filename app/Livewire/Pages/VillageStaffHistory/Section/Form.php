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

        $this->villagePositionTypes = VillagePositionType::with(['positionType', 'positionTypeStatus'])->villageId($this->staff->village_id)->get();
    }

    public function viewPositionType()
    {
        if (!$this->form->villagePositionType) return;
        $this->villagePositionType = VillagePositionType::with(['positionType', 'positionTypeStatus'])->whereId($this->form->villagePositionType)->first();

        $this->positionNow = VillageStaffHistory::active()->with(['villageStaff', 'villagePositionType'])->where('village_position_type_id', $this->form->villagePositionType)->first();
    }

    public function store()
    {
        DB::beginTransaction();

        /* update status aktif perangkat yang masih menjabat */
        self::updateStatusOldStaff();

        /* update perangkat */
        self::updateStaff();

        /* simpan history */
        $model = $this->form->store();

        DB::commit();
        
        $this->form->reset();
        $this->alert('success', 'Success!');
        $this->redirectRoute('village-staff.edit', ['id' => $this->staff->id], navigate: true);

    }

    public function updateStaff()
    {
        /* ubah status staff */
        if (option_is_match('definitif', $this->villagePositionType->position_type_status_id)) {
            $this->staff->position_id = $this->villagePositionType->position_type_id;
            $this->staff->position_name = $this->villagePositionType->position_name;
            $this->staff->position_code = $this->villagePositionType->code;
            $this->staff->position_is_active = true;
            $this->staff->save();

            /* ubah status perangkat definitif menjadi not-active*/
            $update = VillageStaffHistory::active()
                ->where('village_staff_id', $this->staff->id)
                ->where('position_type_status_id', key_option('definitif'))
                ->update(['is_active' => 0]);

            $update = VillageStaff::where('position_code', $this->villagePositionType->code)
                ->where('id', '!=', $this->staff->id)
                ->update(['position_is_active' => 0]);

        } else {
            $this->staff->position_plt_id = $this->villagePositionType->position_type_id;
            $this->staff->position_plt_name = $this->villagePositionType->position_name;
            $this->staff->position_code = $this->villagePositionType->code;
            $this->staff->position_plt_is_active = true;
            $this->staff->save();

            $update = VillageStaffHistory::active()
                ->where('village_staff_id', $this->staff->id)
                ->where('position_type_status_id', '!=', key_option('definitif'))
                ->update(['is_active' => false]);

            $update = VillageStaff::where('position_plt_code', $this->villagePositionType->code)
                ->where('id', '!=', $this->staff->id)
                ->update(['position_plt_is_active' => 0]);
        }


    }

    public function updateStatusOldStaff()
    {
        if ($this->positionNow) {
            $this->positionNow->is_active = false;
            $this->positionNow->save();
        }
    }
    
    public function render()
    {
        return view('livewire.pages.village-staff-history.section.form');
    }
}

<?php

namespace App\Livewire\Modals;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;
use App\Constants\Constants;
use App\Models\VillageStaff;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use App\Models\VillagePositionType;
use App\Models\VillageStaffHistory;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\VillageStaffForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FormVillageStaff extends ModalComponent
{
    use LivewireAlert;

    public VillageStaffForm $form; 
    public $id;
    public $position_type_id;
    public $position_types;
    public $position_type_status;
    public $village_position_types = [];
    public $districts = [];
    public $villages = [];
    public $positionNow;

    public function mount()
    {
        $this->position_types = Option::positionTypes()->get();
        $this->position_type_status = Option::positionTypeStatus()->get();
        $this->districts = Option::districts()->get();

        /* jika yang login adalah operator desa, seting village dan district otomatis terisi */
        self::ifOperator();
    }

    public function render()
    {
        return view('livewire.modals.form-village-staff');
    }

    public function store()
    {
        DB::beginTransaction();

        $model = $this->form->store(Constants::FROM_PAGE_STAFF);
        
        DB::commit();
        
        $this->form->reset();
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent'); // semua yg punya refresh component akan ke trigger

        $this->closeModal();
    }

    /* Modal */
    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    
    #[Computed]
    public function generatePassword($length = 18)
    {
        $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
                  '0123456789-=~!@#$%^&*()_+/<>?;:[]{}\|';
      
        $str = '';
        $max = strlen($chars) - 1;
      
        for ($i=0; $i < $length; $i++)
          $str .= $chars[random_int(0, $max)];
        
        return $str;
    }


    public function getVillages()
    {
        $this->villages = Village::where('district_id', $this->form->district)->get();
    }

    public function getVillagePositionType()
    {
        $this->village_position_types = VillagePositionType::with('positionTypeStatus')->villageId($this->form->village)->get();
    }

    public function getPositionNow()
    {
        $this->positionNow = VillageStaffHistory::active()->with(['villageStaff', 'villagePositionType'])->where('village_position_type_id', $this->form->village_position_type)->first();
    }

    public function ifOperator()
    {
        $user = auth()->user(); 
        if ($user->hasRole('operator')) {
            $village = $user->staff()->village;
            $this->form->village = $village->id;
            $this->form->district = $village->district_id;

            // self::getVillages();
            self::getVillagePositionType();
        }
    }



}

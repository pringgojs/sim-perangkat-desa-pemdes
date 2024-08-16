<?php

namespace App\Livewire\Modals;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;
use App\Models\VillageStaff;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\VillageStaffForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FormVillageStaff extends ModalComponent
{
    use LivewireAlert;

    public VillageStaffForm $form; 
    public $id;
    public $position_types;
    public $districts = [];
    public $villages = [];

    public function mount()
    {
        $this->position_types = Option::positionTypes()->get();
        $this->districts = Option::districts()->get();
        if ($this->id) {
            $model = VillageStaff::find($this->id);
            $this->form->setModel($model);
            self::getVillages(); // memanggil list desa
        }
    }

    public function render()
    {
        return view('livewire.modals.form-village-staff');
    }

    public function store()
    {
        DB::beginTransaction();

        $model = $this->form->store();
        
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
    public function generatePassword($length = 18){
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

}

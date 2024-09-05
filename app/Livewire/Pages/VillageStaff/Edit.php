<?php

namespace App\Livewire\Pages\VillageStaff;

use Livewire\Component;
use App\Models\VillageStaff;
use Livewire\WithFileUploads;
use App\Livewire\Forms\VillageStaffForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    protected $listeners = ['refreshComponent' => '$refresh'];
    
    public VillageStaffForm $form; 
    public $staff;
    public function mount($id)
    {
        /* isi variable user */
        $this->staff = VillageStaff::find($id);
        $this->form->setModel($this->staff);
    }

    public function render()
    {
        return view('livewire.pages.village-staff.edit');
    }
}

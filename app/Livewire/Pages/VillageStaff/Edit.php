<?php

namespace App\Livewire\Pages\VillageStaff;

use App\Livewire\Forms\VillageStaffForm;
use App\Models\VillageStaff;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

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

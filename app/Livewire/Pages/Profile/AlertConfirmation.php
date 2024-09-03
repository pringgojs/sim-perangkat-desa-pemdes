<?php

namespace App\Livewire\Pages\Profile;

use Livewire\Component;
use App\Livewire\Forms\VillageStaffForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AlertConfirmation extends Component
{
    use LivewireAlert;
    
    protected $listeners = ['refreshComponent' => '$refresh'];
    public VillageStaffForm $form; 
    
    public $modalConfirm = false;
    public $staff;
    public function mount($staff)
    {
        $this->staff = $staff;
        $this->form->setModel($staff);
    }

    public function render()
    {
        return view('livewire.pages.profile.alert-confirmation');
    }

    /* proses tombol ajuan data */
    public function processFinal()
    {
        $this->form->sendToVerification();
        $this->isReadonly = true;

        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent');

    }
}

<?php

namespace App\Livewire\Pages\Profile\Section;

use App\Livewire\Forms\VillageStaffForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

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

    /* proses tombol ajuan data */
    public function processFinal()
    {
        $this->form->sendToVerification();
        $this->isReadonly = true;

        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent');
    }

    public function render()
    {
        return view('livewire.pages.profile.section.alert-confirmation');
    }
}

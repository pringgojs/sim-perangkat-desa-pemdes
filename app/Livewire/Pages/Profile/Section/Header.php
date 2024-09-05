<?php

namespace App\Livewire\Pages\Profile\Section;

use Livewire\Component;
use App\Livewire\Forms\VillageStaffForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Header extends Component
{
    use LivewireAlert;

    protected $listeners = ['refreshComponent' => '$refresh'];
    public VillageStaffForm $form; 

    public $staff;
    public $from;
    public $modalConfirm = false;

    public function mount($staff, $form, $from = false)
    {
        $this->staff = $staff;
        $this->form = $form;
        $this->from = $from;
    }

    /* proses tombol ajuan data */
    public function finalisasi()
    {
        $this->form->processToApprve('final');

        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent');
    }
    
    public function render()
    {
        return view('livewire.pages.profile.section.header');
    }
}

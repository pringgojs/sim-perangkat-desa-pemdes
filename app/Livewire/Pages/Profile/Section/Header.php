<?php

namespace App\Livewire\Pages\Profile\Section;

use App\Models\Option;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\VillageStaffForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Header extends Component
{
    use LivewireAlert;

    protected $listeners = ['refreshComponent' => '$refresh'];
    public VillageStaffForm $form; 

    public $staff;
    public $from;
    public $modalConfirmDelete = false;
    public $modalFormRevision = false;

    public $notes;
    public $error = false;

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
        $this->dispatch('modal-close');
    }
    
    public function updateStatus($status)
    {
        $model = Option::findOrFail($status);
        $this->staff->data_status_id = $status;
        $this->staff->save();
        
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent');
    }

    public function revision()
    {
        if (!$this->notes) {
            $this->error = true;
            return;
        }

        $this->staff->data_status_id = key_option('revisi');
        $this->staff->reason_note = $this->notes;
        $this->staff->save();
        
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent');
        $this->dispatch('modal-close');
    }

    #[On('download')]
    public function download($id = null)
    {
        $this->alert('error', 'Fitur ini sedang dikembangkan!');
    }

    public function render()
    {
        return view('livewire.pages.profile.section.header');
    }
}

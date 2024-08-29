<?php

namespace App\Livewire\Pages\Profile;

use App\Models\Option;
use Livewire\Component;
use App\Models\VillageStaff;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Livewire\Forms\VillageStaffForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    protected $listeners = ['refreshComponent' => '$refresh'];
    
    public VillageStaffForm $form; 
    public $modalPreview = false;
    public $modalConfirm = false;
    public $position_type;
    public $isReadonly;

    public function mount()
    {
        /* isi variable user */
        $staff = auth()->user()->staff();
        $this->position_type = Option::find($staff->position_type_id);
        
        $this->form->setModel($staff);
        /* mode readonly diaktifkna ketika status != draft */
        if (option_is_match('draft', $staff->data_status_id) === false) {
            $this->isReadonly = true;
        }
    }

    public function render()
    {
        return view('livewire.pages.profile.index');
    }

    public function store()
    {
        DB::beginTransaction();

        $model = $this->form->store();
        
        DB::commit();
        
        // $this->form->reset();
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent'); 
    }

    public function updatedFormKtp()
    {
        $this->form->validateFilePhoto(); // Memvalidasi hanya field file_photo
    }

    /* proses tombol ajuan data */
    public function processFinal()
    {
        $this->form->sendToVerification();
        $this->isReadonly = true;

        $this->alert('success', 'Success!');
        // $this->dispatch('$refresh'); // semua yg punya refresh component akan ke trigger
        // $this->dispatch('re-init-alpine'); // re init alpine supaya menjadi readonly

    }
}

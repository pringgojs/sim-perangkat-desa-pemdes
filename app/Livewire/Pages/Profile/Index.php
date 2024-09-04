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
    protected $listeners = ['refreshComponent'];
    
    
    public VillageStaffForm $form; 
    public $staff;
    public $modalPreview = false;
    public $position_type;
    public $isReadonly = false;

    public function mount()
    {
        /* isi variable user */
        $staff = auth()->user()->staff();
        $this->staff = $staff;
        $this->position_type = Option::find($staff->position_type_id);
        
        $this->form->setModel($staff);
        /* mode readonly diaktifkna ketika status bukan draft dan revisi */

        if ($staff->isReadonly()) {
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

    public function refreshComponent()
    {
        $this->dispatch('$refresh'); 
        $this->isReadonly = $this->form->village_staff->isReadonly();
    }

}

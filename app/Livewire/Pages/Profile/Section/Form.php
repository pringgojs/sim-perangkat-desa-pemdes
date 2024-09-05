<?php

namespace App\Livewire\Pages\Profile\Section;

use App\Models\Option;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Livewire\Forms\VillageStaffForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Form extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    protected $listeners = ['refreshComponent'];
    
    
    public VillageStaffForm $form; 
    public $staff;
    public $modalPreview = false;
    public $position_type;
    public $isReadonly = false;
    public $from;

    public function mount($form, $staff, $isReadonly = false, $from = null)
    {
        $this->staff = $staff;
        $this->form = $form;
        $this->position_type = Option::find($staff->position_type_id);
        $this->from = $from; // isinya 'admin

        /* jika mode edit dari admin pemdes, maka readonly dibuat false */
        if ($from != 'admin') {
            if ($staff->isReadonly()) {
                $this->isReadonly = true;
            }
        }

        if ($from == 'admin' && $staff->dataStatus->key == 'final') {
            $this->isReadonly = true;
        }

    }

    public function store()
    {
        DB::beginTransaction();

        $model = $this->form->store($this->from);
        
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

    public function render()
    {
        return view('livewire.pages.profile.section.form');
    }
}

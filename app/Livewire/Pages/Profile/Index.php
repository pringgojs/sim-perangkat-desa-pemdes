<?php

namespace App\Livewire\Pages\Profile;

use App\Models\Option;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Livewire\Forms\VillageStaffForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public VillageStaffForm $form; 

    public $position_types;

    public function mount()
    {
        $this->position_types = Option::positionTypes()->get();
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
        
        $this->form->reset();
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent'); 
    }

    public function updatedFormKtp()
    {
        $this->form->validateFilePhoto(); // Memvalidasi hanya field file_photo
    }
}

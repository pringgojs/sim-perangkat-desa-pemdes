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
    public $staff;

    public function mount()
    {
        /* isi variable user */
        $staff = auth()->user()->staff();
        $this->staff = $staff;
        $this->form->setModel($staff);
    }

    public function render()
    {
        return view('livewire.pages.profile.index');
    }
}

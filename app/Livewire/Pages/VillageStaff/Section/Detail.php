<?php

namespace App\Livewire\Pages\VillageStaff\Section;

use App\Models\User;
use Livewire\Component;
use App\Models\VillageStaff;
use App\Scopes\VillageStaffScope;

class Detail extends Component
{
    protected $listeners = ['open'];

    public $loading = false;
    public $staff;
    public $modalPreview = false;
    public $modalConfirm = false;
    public $modalConfirmRevisi = false;

    // public function mount($staff)
    // {
    //     $this->staff = $staff;
    // }
    
    public function render()
    {
        return view('livewire.pages.village-staff.section.detail');
    }

    public function open($id)
    {
        $this->loading = true;
        $this->staff = VillageStaff::whereId($id)->first(); // harus pake whereId karena, model ini memakai global scope
        $this->loading = false;
    }
}

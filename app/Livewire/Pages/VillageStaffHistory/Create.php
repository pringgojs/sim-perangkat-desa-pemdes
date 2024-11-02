<?php

namespace App\Livewire\Pages\VillageStaffHistory;

use App\Models\Option;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    public $id;
    public function mount($id = null)
    {
        $this->id = $id;
    }
    public function render()
    {
        return view('livewire.pages.village-staff-history.create');
    }
}

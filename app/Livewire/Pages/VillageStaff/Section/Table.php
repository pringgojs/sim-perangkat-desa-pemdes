<?php

namespace App\Livewire\Pages\VillageStaff\Section;

use Livewire\Component;

class Table extends Component
{
    public $staffs;

    public function mount($staffs)
    {
        $this->staffs;
    }

    public function render()
    {
        return view('livewire.pages.village-staff.section.table');
    }
}

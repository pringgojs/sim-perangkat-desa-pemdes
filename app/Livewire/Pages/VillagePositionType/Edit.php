<?php

namespace App\Livewire\Pages\VillagePositionType;

use Livewire\Component;

class Edit extends Component
{
    public $id;
    public function mount($id)
    {
        $this->id;
    }

    public function render()
    {
        return view('livewire.pages.village-position-type.edit');
    }
}

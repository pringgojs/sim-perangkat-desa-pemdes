<?php

namespace App\Livewire\Pages\VillagePositionType\Section;

use App\Models\Option;
use Livewire\Component;

class Filter extends Component
{
    public $districts;
    public function mount()
    {
        $this->districts = Option::districts()->get();
    }

    public function render()
    {
        return view('livewire.pages.village-position-type.section.filter');
    }
}

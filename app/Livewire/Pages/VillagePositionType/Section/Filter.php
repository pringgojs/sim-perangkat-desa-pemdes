<?php

namespace App\Livewire\Pages\VillagePositionType\Section;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;

class Filter extends Component
{
    public $districts;
    public $villages;
    public function mount()
    {
        $this->districts = Option::districts()->get();
        $this->villages = Village::orderByDefault()->get();
    }

    public function render()
    {
        return view('livewire.pages.village-position-type.section.filter');
    }
}

<?php

namespace App\Livewire\Pages\VillagePositionType\Section;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;
use App\Livewire\Forms\VillagePositionTypeForm;

class Form extends Component
{
    public VillagePositionTypeForm $form;
    
    public $districts;
    public $villages;
    public $positionTypes;
    public $positionTypeStatus;
    
    public function mount()
    {
        $this->districts = Option::districts()->get();
        $this->positionTypes = Option::positionTypes()->get();
        $this->villages = Village::with(['district'])->orderByDefault()->get();
        $this->positionTypeStatus = Option::positionTypeStatus()->get();
    }

    public function render()
    {
        return view('livewire.pages.village-position-type.section.form');
    }
}

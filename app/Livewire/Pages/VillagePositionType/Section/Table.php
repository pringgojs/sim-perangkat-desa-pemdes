<?php

namespace App\Livewire\Pages\VillagePositionType\Section;

use Livewire\Component;
use App\Models\VillagePositionType;

class Table extends Component
{
    public $search;
    public function render()
    {
        return view('livewire.pages.village-position-type.section.table', [
            'village_position_types' => VillagePositionType::search($this->search)->with(['village.district', 'positionType', 'positionTypeStatus'])->orderByDefault()->paginate(),
        ]);
    }
}

<?php

namespace App\Livewire\Pages\VillagePositionType\Section;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\VillagePositionType;

class Table extends Component
{
    use WithPagination;

    public $search;
    public $filter;
    public function render()
    {
        return view('livewire.pages.village-position-type.section.table', [
            'village_position_types' => VillagePositionType::filter($this->filter)->search($this->search)->with(['village.district', 'positionType', 'positionTypeStatus'])->orderByDefault()->paginate(),
        ]);
    }

    #[On('filter')] 
    public function filter($params = [])
    {
        info($params);
        $this->filter = $params;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingfilter()
    {
        $this->resetPage();
    }
}

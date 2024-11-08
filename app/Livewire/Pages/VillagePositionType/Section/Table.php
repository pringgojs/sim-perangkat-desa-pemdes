<?php

namespace App\Livewire\Pages\VillagePositionType\Section;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\VillagePositionType;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Table extends Component
{
    use LivewireAlert;

    use WithPagination;

    public $search;
    public $filter;
    public $modalConfirmDelete = false;
    public function render()
    {
        return view('livewire.pages.village-position-type.section.table', [
            'village_position_types' => VillagePositionType::filter($this->filter)->search($this->search)->with(['village.district', 'positionType', 'positionTypeStatus', 'staffHistory.villageStaff'])->orderByDefault()->paginate(),
        ]);
    }

    #[On('filter')] 
    public function filter($params = [])
    {
        $this->filter = $params;
        $this->resetPage();
    }
    
    public function delete($id)
    {
        $model = VillagePositionType::findOrFail($id);
        $model->delete();

        $this->alert('success', 'Success!');
        $this->redirectRoute('village-position-type.index', navigate: true);

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

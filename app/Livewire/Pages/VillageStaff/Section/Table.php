<?php

namespace App\Livewire\Pages\VillageStaff\Section;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\VillageStaff;
use Livewire\WithPagination;
use App\Models\VillagePositionType;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Table extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $search;
    public $filter;
    public function render()
    {
        return view('livewire.pages.village-staff.section.table', [
            'staffs' => VillageStaff::filter($this->filter)->search($this->search)->with(['village.district', 'positionType'])->orderByDefault()->paginate(),
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
        $model = VillageStaff::findOrFail($id);
        $userId = $model->user_id;
        $model->delete();
        
        $user = User::findOrFail($userId);
        $user->delete();
        
        $this->alert('success', 'Success!');
        $this->redirectRoute('village-staff.index', navigate: true);
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

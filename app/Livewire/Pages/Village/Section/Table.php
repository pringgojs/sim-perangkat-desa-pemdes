<?php

namespace App\Livewire\Pages\Village\Section;

use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Table extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $district;
    public $type;
    public $search;
    protected $listeners = ['refreshComponent' => '$refresh', 'filter'];
    
    public function render()
    {
        return view('livewire.pages.village.section.table', [
            'villages' => Village::search($this->search)->type($this->type)->district($this->district)->orderByDefault()->paginate()
        ]);
    }

    public function filter($params = [])
    {
        if(isset($params['district'])) {
            $this->district = $params['district'];
        }

        if(isset($params['type'])) {
            $this->type = $params['type'];
        }

        if(isset($params['search'])) {
            $this->search = $params['search'];
        }
    }

    public function delete($id)
    {
        $model = Village::findOrFail($id);
        $model->delete();
        
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent')->self();
    }
}

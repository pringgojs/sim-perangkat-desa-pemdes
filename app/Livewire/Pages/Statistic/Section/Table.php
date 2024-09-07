<?php

namespace App\Livewire\Pages\Statistic\Section;

use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    public $district;
    public $search;

    protected $listeners = ['refreshComponent' => '$refresh', 'filter'];

    public function filter($params = [])
    {
        if(isset($params['district'])) {
            $this->district = $params['district'];
        }

        if(isset($params['search'])) {
            $this->search = $params['search'];
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDistrict()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.pages.statistic.section.table', [
            // 'villages' => Village::with(['district:id,name'])->withCount('staff')->select('id', 'name', 'district_id')->orderByDefault()->paginate(), 
            'villages' => Village::with(['district:id,name'])->withCount('staff')->search($this->search)->district($this->district)->orderByDefault()->paginate(5), 
        ]);
    }
}

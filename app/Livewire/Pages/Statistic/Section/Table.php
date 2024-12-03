<?php

namespace App\Livewire\Pages\Statistic\Section;

use App\Exports\StatisticVillageStaffPensiunExport;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Table extends Component
{
    use WithPagination;

    public $district;

    public $search;

    protected $listeners = ['refreshComponent' => '$refresh', 'filter', 'export'];

    public function filter($params = [])
    {
        if (isset($params['district'])) {
            $this->district = $params['district'];
        }

        if (isset($params['search'])) {
            $this->search = $params['search'];
        }
    }

    public function export()
    {
        $params = [
            'district' => $this->district,
            'search' => $this->search,
        ];

        return Excel::download(new StatisticVillageStaffPensiunExport($params), 'perangakat-daerah-yang-mau-pensiun-'.date('Ymd').'.xlsx');
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

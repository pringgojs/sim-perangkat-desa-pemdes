<?php

namespace App\Livewire\Pages\StatisticStatusData\Section;

use App\Exports\StatisticVillageStaffStatusDataExport;
use App\Models\Option;
use App\Models\Village;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Table extends Component
{
    use WithPagination;

    public $statusData;

    public $district;

    public $search;

    protected $listeners = ['refreshComponent' => '$refresh', 'filter', 'export'];

    public function mount()
    {
        $this->statusData = Option::statusData()->orderByDefault()->get();
    }

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

        return Excel::download(new StatisticVillageStaffStatusDataExport($params), 'perangakat-daerah-berdasarkan-status-data-'.date('Ymd').'.xlsx');
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
        $query = Village::with(['district:id,name', 'type'])->search($this->search)->district($this->district)->orderByDefault()->paginate(5);

        return view('livewire.pages.statistic-status-data.section.table', [
            'villages' => $query,
        ]);
    }
}

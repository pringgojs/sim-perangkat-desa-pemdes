<?php

namespace App\Livewire\Pages\Village\Section;

use App\Exports\VillageExport;
use App\Models\Village;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Table extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $district;

    public $type;

    public $search;

    protected $listeners = ['refreshComponent' => '$refresh', 'filter', 'export'];

    public function render()
    {
        return view('livewire.pages.village.section.table', [
            'villages' => Village::search($this->search)->type($this->type)->district($this->district)->orderByDefault()->paginate(),
        ]);
    }

    public function filter($params = [])
    {
        if (isset($params['district'])) {
            $this->district = $params['district'];
        }

        if (isset($params['type'])) {
            $this->type = $params['type'];
        }

        if (isset($params['search'])) {
            $this->search = $params['search'];
        }
    }

    public function export()
    {
        $params = [
            'district' => $this->district,
            'type' => $this->type,
            'search' => $this->search,
        ];

        return Excel::download(new VillageExport($params), 'desa-'.date('Ymd').'.xlsx');
    }

    public function delete($id)
    {
        $model = Village::findOrFail($id);
        $model->delete();

        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent')->self();
    }
}

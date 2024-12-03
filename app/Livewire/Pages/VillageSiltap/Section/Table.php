<?php

namespace App\Livewire\Pages\VillageSiltap\Section;

use App\Models\VillageSiltap;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search;

    public $filter;

    public $modalConfirmDelete = false;

    public function mount($type = null)
    {
        $this->filter = [
            'area' => '',
            'search' => '',
            'positionType' => '',
            'selectedDistrict' => '',
            'selectedVillage' => '',
            // 'isParkir' => '',
            // 'positionStatus' => '',
            // 'statusData' => '',
            // 'isNullPerson' => '',
        ];
    }

    public function render()
    {
        return view('livewire.pages.village-siltap.section.table', [
            'village_siltaps' => VillageSiltap::filter($this->filter)->with(['village.district', 'positionType'])->paginate(),
        ]);
    }

    #[On('filter')]
    public function filter($area = null, $search = null, $positionType = null, $selectedDistrict = [], $selectedVillage = [], $positionStatus = null, $isParkir = false, $isNullPerson = false, $statusData = null)
    {
        $params = [
            'area' => $area,
            'search' => $search,
            'positionType' => $positionType,
            'selectedDistrict' => $selectedDistrict,
            'selectedVillage' => $selectedVillage,
        ];

        // dd($params);
        $this->filter = $params;
        $this->resetPage();
    }

    #[On('export')]
    public function export()
    {
        // return Excel::download(new VillagePositionTypeExport($this->filter), 'desa-jabatan-'.date('Ymd').'.xlsx');
    }

    public function delete($id)
    {
        $model = VillageSiltap::findOrFail($id);
        $model->delete();

        $this->alert('success', 'Success!');
        $this->redirectRoute('village-siltap.index', navigate: true);

    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }
}

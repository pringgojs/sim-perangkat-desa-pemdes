<?php

namespace App\Livewire\Pages\VillagePositionType\Section;

use App\Exports\VillagePositionTypeExport;
use App\Models\VillagePositionType;
use App\Models\VillageStaffHistory;
use App\Services\StaffHistoriesService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Table extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search;

    public $filter;

    public $modalConfirmDelete = false;

    public $isLoading = false;

    public function mount($type = null)
    {
        $this->filter = [
            'area' => '',
            'search' => '',
            'positionType' => '',
            'selectedDistrict' => '',
            'selectedVillage' => '',
            'isParkir' => '',
            'positionStatus' => '',
            'statusData' => '',
            'isNullPerson' => '',
        ];
    }

    public function render()
    {
        return view('livewire.pages.village-position-type.section.table', [
            'village_position_types' => VillagePositionType::filter($this->filter)->with(['village.district', 'positionType', 'positionTypeStatus', 'staffHistory.villageStaff'])->orderByDefault()->paginate(),
        ]);
    }

    #[On('filter')]
    public function filter($area = null, $search = null, $positionType = null, $selectedDistrict = [], $selectedVillage = [], $positionStatus = null, $isParkir = false, $isNullPerson = false, $statusData = null)
    {
        $this->isLoading = true;
        $params = [
            'area' => $area,
            'search' => $search,
            'positionType' => $positionType,
            'selectedDistrict' => $selectedDistrict,
            'selectedVillage' => $selectedVillage,
            'isParkir' => $isParkir,
            'positionStatus' => $positionStatus,
            'isNullPerson' => $isNullPerson,
            'statusData' => $statusData,
        ];

        $this->filter = $params;
        $this->resetPage();
        $this->isLoading = false;
    }

    #[On('export')]
    public function export()
    {
        return Excel::download(new VillagePositionTypeExport($this->filter), 'desa-jabatan-'.date('Ymd').'.xlsx');
    }

    public function delete($id)
    {
        $model = VillagePositionType::findOrFail($id);

        /* set non-aktif staff saat ini */
        $history = VillageStaffHistory::where('village_position_type_id', $model->id)->active()->first();
        if ($history) {
            $service = new StaffHistoriesService($model, $history->villageStaff);
            $service->ifStaffSetNonActive($history);
        }

        /* hapus */
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

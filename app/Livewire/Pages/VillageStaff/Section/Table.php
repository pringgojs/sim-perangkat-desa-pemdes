<?php

namespace App\Livewire\Pages\VillageStaff\Section;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\VillageStaff;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use App\Exports\VillageStaffExport;
use Maatwebsite\Excel\Facades\Excel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Table extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search;

    public $filter;

    public $type;

    public $modalConfirm;

    public $modalConfirmDelete;

    public $statusData;

    public $isWillRetire; // akan pensiun

    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public function mount($type = null)
    {
        $statusData = request()->input('statusData');
        $this->statusData = $this->statusData ?: $statusData;
        $this->filter = [
            'area' => '',
            'search' => '',
            'positionType' => $type,
            'selectedDistrict' => '',
            'selectedVillage' => '',
            'isParkir' => '',
            'positionStatus' => '',
            'statusData' => $this->statusData,
            'dateType' => '',
            'month' => '',
            'year' => '',
            'dateStart' => '',
            'dateEnd' => '',
        ];
    }

    public function render()
    {
        return view('livewire.pages.village-staff.section.table');
    }

    #[Computed]
    public function staffs()
    {
        return VillageStaff::filter($this->filter)->with(['village.district', 'positionType', 'dataStatus', 'educationLevel'])->orderByDefault()->paginate();
    }

    /* mendengarkan acara daril filter alpine */
    #[On('filter')]
    public function filter($area = null, $search = null, $positionType = null, $selectedDistrict = [], $selectedVillage = [], $positionStatus = null, $isParkir = false, $isNullPerson = false, $statusData = null, $dateType = null, $month = null, $year = null, $dateStart = null, $dateEnd = null)
    {
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
            'dateType' => $dateType,
            'month' => $month,
            'year' => $year,
            'dateStart' => $dateStart,
            'dateEnd' => $dateEnd,
        ];

        $this->filter = $params;
        $this->resetPage();
    }

    #[On('export')]
    public function export()
    {
        return Excel::download(new VillageStaffExport($this->filter, $this->isWillRetire), 'perangakat-daerah-'.date('Ymd').'.xlsx');
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

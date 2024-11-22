<?php

namespace App\Livewire\Pages\VillageStaff\Section;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Constants\Constants;
use App\Models\VillageStaff;
use Livewire\WithPagination;
use App\Exports\VillageStaffExport;
use App\Models\VillagePositionType;
use App\Models\VillageStaffHistory;
use Maatwebsite\Excel\Facades\Excel;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Table extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $search;
    public $filter;
    public $type;
    public $modalConfirm;
    public $modalConfirmDelete;
    public $statusData;
    public $isWillRetire; // akan pensiun

    protected $listeners = [
        'refreshComponent' => '$refresh'
    ];
    
    public function mount($type = null)
    {
        $statusData = request()->input('statusData');
        $this->statusData = $this->statusData ? : $statusData;
        $this->filter = [
            'area' => '',
            'search' => '',
            'positionType' => $type,
            'selectedDistrict' => '',
            'selectedVillage' => '',
            'isParkir' => '',
            'positionStatus' => '',
            'statusData' => $this->statusData,
        ];
    }

    public function render()
    {
        return view('livewire.pages.village-staff.section.table', [
            'staffs' => VillageStaff::filter($this->filter)->pensiun($this->filter, $this->isWillRetire)->with(['village.district', 'positionType', 'dataStatus', 'educationLevel'])->orderByDefault()->paginate(),
        ]);
    }

    /* mendengarkan acara daril filter alpine */
    #[On('filter')] 
    public function filter($area = null, $search = null, $positionType = null, $selectedDistrict = [], $selectedVillage = [], $positionStatus = null, $isParkir = false, $isNullPerson = false, $statusData= null)
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

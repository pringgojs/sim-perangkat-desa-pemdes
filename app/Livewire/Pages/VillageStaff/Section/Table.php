<?php

namespace App\Livewire\Pages\VillageStaff\Section;

use App\Models\User;
use Livewire\Component;
use App\Models\VillageStaff;
use App\Exports\VillageStaffExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Livewire\Forms\VillageStaffForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Livewire\Pages\VillageStaff\Section\Detail;

class Table extends Component
{
    use LivewireAlert;
    public VillageStaffForm $form; 

    public $staff;
    public $search;
    public $type;
    public $status;
    public $isActive;
    public $village;
    public $isWillRetire; // akan pensiun
    public $district;
    public $modalConfirm = false;
    public $modalConfirmRevisi = false;
    public $modalPreview = false;
    protected $listeners = ['refreshComponent' => '$refresh', 'detail', 'processToUpdateStatus', 'filter', 'export'];
    
    public function mount($type = null, $village = null, $district = null, $isActive = true, $status = null, $isWillRetire = false)
    {
        $this->type = $type;
        $this->village = $village;
        $this->district = $district;
        $this->isActive = $isActive;
        $this->status = $status;
        $this->isWillRetire = $isWillRetire;
    }

    public function render()
    {
        return view('livewire.pages.village-staff.section.table', [
            'staffs' => VillageStaff::search($this->search)
                ->district($this->district)
                ->village($this->village)
                ->type($this->type)
                ->pensiun($this->isWillRetire)
                ->activeStatus($this->isActive, $this->status)
                ->with(['village', 'positionType'])
                ->paginate()
        ]);
    }

    public function delete($id)
    {
        $model = VillageStaff::findOrFail($id);
        $userId = $model->user_id;
        $model->delete();

        $user = User::findOrFail($userId);
        $user->delete();
        
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent')->self();
    }

    public function detail($id)
    {
        info('ID:'.$id);
        // $this->dispatch('open', ['id' => $id])->to(Detail::class);
        $this->staff = VillageStaff::find($id);
        $this->form->setModel($this->staff);
    }

    public function filter($params = [])
    {
        if(isset($params['district'])) {
            $this->district = $params['district'];
        }

        if(isset($params['type'])) {
            $this->type = $params['type'];
        }

        if(isset($params['village'])) {
            $this->village = $params['village'];
        }

        if(isset($params['status'])) {
            $this->status = $params['status'];
        }

        if(isset($params['search'])) {
            $this->search = $params['search'];
        }
    }

    public function export()
    {
        $params = [
            'district' => $this->district,
            'type' => $this->type,
            'status' => $this->status,
            'village' => $this->village,
            'search' => $this->search,
            'isWillRetire' => $this->isWillRetire,
        ];
        return Excel::download(new VillageStaffExport($params), 'perangakat-daerah-'.date('Ymd').'.xlsx');
    }

    /* proses tombol finalisasi data */
    public function processToUpdateStatus($key, $reason = null)
    {
        $this->form->processToApprve($key, $reason);
        $this->modalConfirm = false;
        $this->modalConfirmRevisi = false;
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent'); // semua yg punya refresh component akan ke trigger
    }
}

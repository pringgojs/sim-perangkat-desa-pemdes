<?php

namespace App\Livewire\Pages\Dashboard;

use Livewire\Component;
use App\Constants\Constants;
use App\Models\VillageStaff;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Exports\EntitlementExport;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\EcmpCustomerService;
use App\Livewire\Forms\VillageStaffForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request as FacadeRequest;

class Index extends Component
{
    use LivewireAlert;

    public VillageStaffForm $form; 

    public $staff;
    // use WithPagination;
    public $search;
    public $modalPreview = false;
    public $modalConfirm = false;
    
    protected $listeners = ['refreshComponent' => '$refresh', 'detail'];
    
    public function mount()
    {
        
    }

    public function render()
    {
        return view('livewire.pages.dashboard.index',
        [
            'staffs' => VillageStaff::active()->pending()->search($this->search)->with(['village', 'positionType'])->paginate()
        ]);
    }

    public function detail($id)
    {
        $this->staff = VillageStaff::find($id);
        $this->form->setModel($this->staff);
    }

    /* proses tombol finalisasi data */
    public function processFinal()
    {
        $this->form->processToApprve();
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent'); // semua yg punya refresh component akan ke trigger
    }
}

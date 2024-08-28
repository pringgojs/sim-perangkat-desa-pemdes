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
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request as FacadeRequest;

class Index extends Component
{

    // use WithPagination;
    public $search;
    protected $listeners = ['refreshComponent' => '$refresh'];
    
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
}

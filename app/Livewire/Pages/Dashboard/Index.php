<?php

namespace App\Livewire\Pages\Dashboard;

use Livewire\Component;
use App\Constants\Constants;
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
    public $state, $plan, $search;
    public $headers = [];
    public $list_entitlement = [];
    protected $listeners = ['refreshComponent' => '$refresh', 'filter' => 'filter', 'export' => 'export', 'submit' => 'submit'];
    
    public function mount()
    {
        $this->headers = [
            'Name',
            'Username',
            'Subdomain',
            'Email',
        ];
    }

    public function render()
    {
        $params = [
            'state' => $this->state,
            'plan' => $this->plan,
            'search' => $this->search,
        ];

        // $service = new EcmpCustomerService;
        return view('livewire.pages.dashboard.index');
    }

    public function filter($state = null, $plan = null)
    {
        $this->state = $state;
        $this->plan = $plan;
    }

    public function export()
    {
        // return Excel::download(new EntitlementExport($collections), $name.'.xlsx');
    }
}

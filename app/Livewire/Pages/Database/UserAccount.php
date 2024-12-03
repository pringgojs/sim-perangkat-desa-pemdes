<?php

namespace App\Livewire\Pages\Database;

use App\Services\DatabaseService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request as FacadeRequest;
use Livewire\Component;
use Livewire\WithPagination;

class UserAccount extends Component
{
    // use WithPagination;

    public $search = '';

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        $service = new DatabaseService;
        $users = collect($service->getUserAccounts($this->search));
        $users = self::paginator($users);

        return view('livewire.pages.database.user-account', ['users' => $users]);
    }

    public function paginator($items)
    {
        $currentPage = request()->input('page') ?: 1;
        $perPage = 20;
        $offset = ($currentPage - 1) * $perPage;
        $paginatedItems = $items->slice($offset, $perPage)->values();

        $paginator = new LengthAwarePaginator(
            $paginatedItems,
            $items->count(),
            $perPage,
            $currentPage,
            ['path' => '/database/account', 'query' => FacadeRequest::query()]
        );

        return $paginator;

    }
}

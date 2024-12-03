<?php

namespace App\Livewire\Pages\Database;

use App\Services\DatabaseService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request as FacadeRequest;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    // use WithPagination;

    public $search = '';

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        $service = new DatabaseService;
        $databases = collect($service->getDatabase($this->search));
        $databases = self::paginator($databases);

        return view('livewire.pages.database.index', [
            'databases' => $databases,
        ]);
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
            ['path' => '/database', 'query' => FacadeRequest::query()]
        );

        return $paginator;

    }
}

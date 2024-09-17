<?php

namespace App\Livewire\Pages\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public $search;
    public function render()
    {
        return view('livewire.pages.role.index', [
            'roles' => Role::paginate(5)
        ]);
    }
}

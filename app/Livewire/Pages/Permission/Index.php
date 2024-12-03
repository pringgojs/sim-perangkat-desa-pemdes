<?php

namespace App\Livewire\Pages\Permission;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public $search;

    public function render()
    {
        return view('livewire.pages.permission.index', [
            'permissions' => Permission::paginate(5),
        ]);
    }

    public function delete($id)
    {
        $role = Permission::findOrFail($id);
        $role->delete();

        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent')->self();
    }
}

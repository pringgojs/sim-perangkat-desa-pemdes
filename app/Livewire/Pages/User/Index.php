<?php

namespace App\Livewire\Pages\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;

    use WithPagination;

    public $search;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        auth()->user()->hasPermissionTo('user.index');

    }

    public function render()
    {
        return view('livewire.pages.user.index', [
            'users' => User::search($this->search)->orderByDefault()->paginate()
        ]);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        if (auth()->user()->id == $id) {
            $this->alert('error', 'You can\'t delete yourself!');
            return;

        }
        $user->delete();
        
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent')->self();
    }

}

<?php

namespace App\Livewire\Pages\Village;

use App\Models\Village;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $search;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        return view('livewire.pages.village.index', [
            'villages' => Village::search($this->search)->orderByDefault()->paginate(),
        ]);
    }

    public function delete($id)
    {
        $model = Village::findOrFail($id);
        $model->delete();

        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent')->self();
    }
}

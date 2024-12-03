<?php

namespace App\Livewire\Pages\VillageType;

use App\Models\Option;
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
        return view('livewire.pages.village-type.index', [
            'types' => Option::search($this->search)->villageTypes()->paginate(),
        ]);
    }

    public function delete($id)
    {
        $model = Option::findOrFail($id);
        $model->delete();

        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent')->self();
    }
}

<?php

namespace App\Livewire\Pages\VillageStaff;

use App\Models\User;
use App\Models\Option;
use Livewire\Component;
use App\Models\VillageStaff;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $option;
    public $search;
    public $type;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        /* tampilkan data staff berdasarkan jenis. jika kosong maka defaultkan skretaris desa */
        $this->type = request()->type ?? key_option('sekretaris_desa');
        $this->option = Option::find($this->type);
    }

    public function render()
    {
        return view('livewire.pages.village-staff.index', [
            'staffs' => VillageStaff::search($this->search)->type($this->type)->paginate()
        ]);
    }

    public function delete($id)
    {
        $model = VillageStaff::findOrFail($id);
        $userId = $model->user_id;
        $model->delete();
        $user = User::findOrFail($userId);
        $user->delete();
        
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent')->self();
    }
}

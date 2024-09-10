<?php

namespace App\Livewire\Pages\VillageStaff;

use App\Models\User;
use App\Models\Option;
use Livewire\Component;
use App\Models\VillageStaff;
use Livewire\WithPagination;
use App\Livewire\Forms\VillageStaffForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;
    use WithPagination;

    public VillageStaffForm $form; 
    public $option;
    public $search;
    public $type;
    public $staff;
    public $modalPreview = false;
    public $modalConfirm = false;
    public $modalConfirmRevisi = false;

    protected $listeners = ['refreshComponent' => '$refresh', 'detail', 'processToUpdateStatus'];

    public function mount()
    {
        /* tampilkan data staff berdasarkan jenis. jika kosong maka defaultkan skretaris desa */
        $this->type = request()->type ?? key_option('sekretaris_desa');
        $this->option = Option::find($this->type);
    }

    public function render()
    {
        return view('livewire.pages.village-staff.index', [
            'staffs' => VillageStaff::search($this->search)->type($this->type)->with(['village', 'positionType'])->paginate()
        ]);
    }
}

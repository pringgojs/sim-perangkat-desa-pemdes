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

    public function detail($id)
    {
        $this->staff = VillageStaff::find($id);
        $this->form->setModel($this->staff);
    }

    /* proses tombol finalisasi data */
    public function processToUpdateStatus($key, $reason = null)
    {
        info($reason);
        $this->form->processToApprve($key, $reason);
        $this->modalConfirm = false;
        $this->modalConfirmRevisi = false;
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent'); // semua yg punya refresh component akan ke trigger
    }
}

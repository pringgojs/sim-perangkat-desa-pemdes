<?php

namespace App\Livewire\Pages\VillageStaff\Section;

use App\Models\User;
use Livewire\Component;
use App\Models\VillageStaff;
use App\Livewire\Forms\VillageStaffForm;
use App\Livewire\Pages\VillageStaff\Section\Detail;

class Table extends Component
{
    public VillageStaffForm $form; 

    public $staff;
    public $search;
    public $type;
    public $village;
    public $district;
    protected $listeners = ['refreshComponent' => '$refresh', 'detail', 'processToUpdateStatus'];
    
    public function mount($type = null, $village = null, $district = null)
    {
        $this->type = $type;
        $this->village = $village;
        $this->district = $district;
    }

    public function render()
    {
        return view('livewire.pages.village-staff.section.table', [
            'staffs' => VillageStaff::search($this->search)->village($this->district)->village($this->village)->type($this->type)->with(['village', 'positionType'])->paginate()
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
        info('ID:'.$id);
        // $this->dispatch('open', ['id' => $id])->to(Detail::class);
        $this->staff = VillageStaff::find($id);
        // $this->form->setModel($this->staff);
    }

    /* proses tombol finalisasi data */
    public function processToUpdateStatus($key, $reason = null)
    {
        $this->form->processToApprve($key, $reason);
        $this->modalConfirm = false;
        $this->modalConfirmRevisi = false;
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent'); // semua yg punya refresh component akan ke trigger
    }
}

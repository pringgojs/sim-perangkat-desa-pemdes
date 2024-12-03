<?php

namespace App\Livewire\Pages\Profile\Section;

use App\Constants\Constants;
use App\Livewire\Forms\VillageStaffForm;
use App\Models\Option;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    protected $listeners = ['refreshComponent'];

    public VillageStaffForm $form;

    public $staff;

    public $modalPreview = false;

    public $position_type;

    public $positions;

    public $isReadonly = false;

    public $from;

    public function mount($form, $staff, $isReadonly = false, $from = null)
    {
        $this->staff = $staff;
        $this->form = $form;
        $this->position_type = Option::find($staff->position_id);
        $this->positions = Option::positionTypes()->get();
        $this->from = $from; // isinya 'admin

        /* jika mode edit dari admin pemdes, maka readonly dibuat false */
        if ($from != 'admin') {
            if ($staff->isReadonly()) {
                $this->isReadonly = true;
            }
        }

        if ($from == 'admin' && $staff->dataStatus->key == 'final') {
            $this->isReadonly = true;
        }

        self::calculatePensiunDate();
    }

    public function store()
    {
        DB::beginTransaction();

        // dd($this->from);
        $model = $this->form->store(Constants::FROM_PAGE_PROFILE);

        DB::commit();

        // $this->form->reset();
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent');
    }

    public function updatedFormKtp()
    {
        $this->form->validateFilePhoto(); // Memvalidasi hanya field file_photo
    }

    public function calculatePensiunDate()
    {
        $this->form->calculatePensiunDate(); // Memvalidasi hanya field file_photo
    }

    public function refreshComponent()
    {
        $this->dispatch('$refresh');
        $this->isReadonly = $this->form->village_staff->isReadonly();
    }

    public function render()
    {
        return view('livewire.pages.profile.section.form');
    }
}

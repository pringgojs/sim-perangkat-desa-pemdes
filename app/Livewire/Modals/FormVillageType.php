<?php

namespace App\Livewire\Modals;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\VillageTypeForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FormVillageType extends ModalComponent
{
    use LivewireAlert;

    public VillageTypeForm $form; 
    public $id;

    public function mount()
    {
        if ($this->id) {
            $model = Option::find($this->id);
            $this->form->setModel($model);
        }
    }

    public function render()
    {
        return view('livewire.modals.form-village-type');
    }

    public function store()
    {
        DB::beginTransaction();

        $model = $this->form->store();
        
        DB::commit();
        
        $this->form->reset();
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent'); // semua yg punya refresh component akan ke trigger

        $this->closeModal();
    }

    /* Modal */
    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

}

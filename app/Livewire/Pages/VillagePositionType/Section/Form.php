<?php

namespace App\Livewire\Pages\VillagePositionType\Section;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Livewire\Forms\VillagePositionTypeForm;

class Form extends Component
{
    use LivewireAlert;

    public VillagePositionTypeForm $form;
    
    public $districts;
    public $villages = [];
    public $positionTypes;
    public $positionTypeStatus;
    
    public function mount()
    {
        $this->districts = Option::districts()->get();
        $this->positionTypes = Option::positionTypes()->get();
        // $this->villages = Village::with(['district'])->orderByDefault()->get();
        $this->positionTypeStatus = Option::positionTypeStatus()->get();
    }

    public function getVillage($id)
    {
        if (!$id) return;
        $this->villages = Village::where('district_id', $id)->with(['district'])->orderByDefault()->get();
    }

    public function store()
    {
        DB::beginTransaction();

        $model = $this->form->store();
        
        DB::commit();
        
        $this->alert('success', 'Success!');
        $this->redirectRoute('village-position-type.index', navigate: true);
        
    }

    public function render()
    {
        return view('livewire.pages.village-position-type.section.form');
    }
}

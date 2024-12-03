<?php

namespace App\Livewire\Pages\VillagePositionType\Section;

use App\Livewire\Forms\VillagePositionTypeForm;
use App\Models\Option;
use App\Models\Village;
use App\Models\VillagePositionType;
use App\Models\VillageSiltap;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Form extends Component
{
    use LivewireAlert;

    public VillagePositionTypeForm $form;

    public $id;

    public $districts;

    public $villages = [];

    public $positionTypes;

    public $positionTypeStatus;

    public $villagePositionType;

    public function mount($id = null)
    {
        $this->districts = Option::districts()->get();
        $this->positionTypes = Option::positionTypes()->get();
        // $this->villages = Village::with(['district'])->orderByDefault()->get();
        $this->positionTypeStatus = Option::positionTypeStatus()->get();

        if ($id) {
            $model = VillagePositionType::findOrFail($id);
            $this->form->setModel($model);
            self::getVillage($model->village->district_id);
        }

    }

    public function getVillage($id)
    {
        if (! $id) {
            return;
        }
        $this->villages = Village::where('district_id', $id)->with(['district'])->orderByDefault()->get();
    }

    public function getSiltap()
    {
        if (! $this->form->positionType) {
            return;
        }
        if (! $this->form->village) {
            return;
        }

        $villageSiltap = VillageSiltap::where('village_id', $this->form->village)->where('position_type_id', $this->form->positionType)->first();

        $this->form->tunjangan = $villageSiltap->tunjangan;
        $this->form->siltap = $villageSiltap->siltap;
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

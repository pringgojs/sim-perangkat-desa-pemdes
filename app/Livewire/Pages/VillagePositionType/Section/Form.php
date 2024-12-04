<?php

namespace App\Livewire\Pages\VillagePositionType\Section;

use App\Models\Option;
use App\Models\Village;
use Livewire\Component;
use App\Models\VillageSiltap;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use App\Models\VillagePositionType;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Livewire\Forms\VillagePositionTypeForm;

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

    public function store()
    {
        DB::beginTransaction();

        $model = $this->form->store();

        DB::commit();

        $this->alert('success', 'Success!');
        $this->redirectRoute('village-position-type.index', navigate: true);
    }

    public function getCode()
    {
        if ($this->form->id) {
            return $this->form->code;
        }

        /* generator */
        if ($this->form->village) {


            $village = Village::find($this->form->village);

            $positinTypes = VillagePositionType::villageId($this->form->village)->get();
            
            /* kembalikan prefix -1 */
            if (!$positinTypes) {
                $this->form->code = $village->code.'-1';
                return;
            }
            
            $index = [];
            foreach ($positinTypes as $item) {
                $explode = explode('-', $item->code);
                if (isset($explode[1])) {
                    $index[] = $explode[1];
                }
            }

            $newIndex = $index ? max($index) + 1 : 1;

            $this->form->code = $village->code.'-'.$newIndex; 
        }
    }

    public function render()
    {
        return view('livewire.pages.village-position-type.section.form');
    }
}

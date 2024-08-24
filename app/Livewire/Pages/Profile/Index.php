<?php

namespace App\Livewire\Pages\Profile;

use App\Models\Option;
use Livewire\Component;

class Index extends Component
{
    public $position_types;

    public function mount()
    {
        $this->position_types = Option::positionTypes()->get();
    }

    public function render()
    {
        return view('livewire.pages.profile.index');
    }
}

<?php

namespace App\Livewire\Pages\Profile\History;

use App\Models\Option;
use Livewire\Component;

class Form extends Component
{
    public $formModalHistory;
    public $positions;

    public function mount()
    {
        $this->positions = Option::positionTypes()->get();
    }
    
    public function render()
    {
        return view('livewire.pages.profile.history.form');
    }
}

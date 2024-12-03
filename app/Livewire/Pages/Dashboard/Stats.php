<?php

namespace App\Livewire\Pages\Dashboard;

use App\Models\Option;
use Livewire\Component;

class Stats extends Component
{
    public $options;

    public function mount()
    {
        $this->options = Option::positionTypes()->get();
    }

    public function render()
    {
        return view('livewire.pages.dashboard.stats');
    }
}

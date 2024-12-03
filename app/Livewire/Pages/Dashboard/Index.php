<?php

namespace App\Livewire\Pages\Dashboard;

use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        return view('livewire.pages.dashboard.index');
    }
}

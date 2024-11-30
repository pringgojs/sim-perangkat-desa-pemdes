<?php

namespace App\Livewire\Android;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.android.index')->layout('layouts.guest');
    }
}

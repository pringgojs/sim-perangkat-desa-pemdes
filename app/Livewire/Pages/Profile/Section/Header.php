<?php

namespace App\Livewire\Pages\Profile\Section;

use Livewire\Component;

class Header extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];

    public $staff;
    public function mount($staff)
    {
        $this->staff = $staff;
    }
    
    public function render()
    {
        return view('livewire.pages.profile.section.header');
    }
}

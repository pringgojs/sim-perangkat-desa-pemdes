<?php

namespace App\Livewire\Pages\Profile\Section;

use Livewire\Component;

class Tab extends Component
{
    public $staff;
    public $form;
    public $tabActive;
    public function mount($form, $staff, $isReadonly = false, $from = null)
    {
        $this->staff = $staff;
        $this->form = $form;
        $this->tabActive = 'identity';
    }

    public function setActive($v)
    {
        $this->tabActive = $v;
    }

    public function render()
    {
        return view('livewire.pages.profile.section.tab');
    }
}

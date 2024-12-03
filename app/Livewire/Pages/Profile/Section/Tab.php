<?php

namespace App\Livewire\Pages\Profile\Section;

use Livewire\Component;

class Tab extends Component
{
    public $isReadonly;

    public $from;

    public $staff;

    public $form;

    public $tabActive;

    public function mount($form, $staff, $isReadonly = false, $from = null)
    {
        $this->staff = $staff;
        $this->form = $form;
        $this->isReadonly = $isReadonly;
        $this->from = $from;
        $this->tabActive = request()->input('tab') ?: 'identity';
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

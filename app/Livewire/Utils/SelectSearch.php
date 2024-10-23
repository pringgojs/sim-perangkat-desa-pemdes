<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class SelectSearch extends Component
{
    public $options = [];
    public $search = '';
    public $value = ''; // Properti baru untuk binding dari parent

    public function mount()
    {
        // Inisialisasi data options
        $this->options = [
            'Option 1',
            'Option 2',
            'Option 3',
            'Option 4',
            'Option 5'
        ];
        
        // Jika value sudah diisi, set search berdasarkan value
        if ($this->value) {
            $this->search = $this->value;
        }
    }
    
    public function render()
    {
        return view('livewire.utils.select-search', [
            'options' => $this->options
        ]);
    }
}

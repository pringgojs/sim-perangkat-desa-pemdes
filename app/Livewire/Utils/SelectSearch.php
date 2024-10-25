<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class SelectSearch extends Component
{
    public $callback;
    public $options = [];
    public $search = '';
    public $value = ''; // Properti baru untuk binding dari parent

    public function mount($options = [])
    {
        // Inisialisasi data options
        $this->options = $options;
        self::setValue();
    }

    public function setValue()
    {
        if ($this->value) {
            $find = $this->options->find($this->value);
            if ($find) $this->value = $find->name;
        }
    }

    // #[On('updateValue')]
    // public function updateValue($value)
    // {
    //     $this->value = $value;
    // }

    // public function updatedValue($value)
    // {
    //     // Emit perubahan ke parent component
    //     $this->dispatch('inputUpdated', $value);
    // }

    public function render()
    {
        return view('livewire.utils.select-search', [
            'options' => $this->options
        ]);
    }
}
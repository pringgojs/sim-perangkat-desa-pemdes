<?php

namespace App\Livewire\Android;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;

    public $error;
    public $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.android.index')->layout('layouts.guest');
    }

    #[On('update-username')]
    public function updateUsername($value = null)
    {
        if (!$value) {
            $this->error = 'Kolom username tidak boleh kosong';
            return;
        }

        $check = User::where('username', $value)->where('id', '!=', $this->user->id)->first();
        if ($check) {
            $this->error = 'Username ini sudah dipakai, silahkan tulis yang lain!';
            return;
        }

        $this->user->username = $value;
        $this->user->save();

        $this->alert('success', 'Username berhasil diganti!');
    }
}

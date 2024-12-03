<?php

namespace App\Livewire\Pages\Account;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Form extends Component
{
    use LivewireAlert;

    public $from;

    public $staff;

    public $password;

    public $username;

    public function mount()
    {
        $this->username = $this->staff->user->username;
    }

    public function render()
    {
        return view('livewire.pages.account.form');
    }

    public function store()
    {
        if (! $this->password) {
            $this->alert('error', 'Lengkapi kolom password!');

            return;
        }

        $user = $this->staff->user;
        $user->password = $this->password;
        $user->save();

        $this->password = null;
        $this->alert('success', 'Success!');
    }

    #[Computed]
    public function generatePassword($length = 18)
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
                  '0123456789-=~!@#$%^&*()_+/<>?;:[]{}\|';

        $str = '';
        $max = strlen($chars) - 1;

        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[random_int(0, $max)];
        }

        return $str;
    }
}

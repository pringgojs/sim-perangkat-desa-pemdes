<?php

namespace App\Livewire\Pages\Account;

use Livewire\Component;
use Livewire\Attributes\Computed;

class Form extends Component
{
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
    
    #[Computed]
    public function generatePassword($length = 18)
    {
        $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
                  '0123456789-=~!@#$%^&*()_+/<>?;:[]{}\|';
      
        $str = '';
        $max = strlen($chars) - 1;
      
        for ($i=0; $i < $length; $i++)
          $str .= $chars[random_int(0, $max)];
        
        return $str;
    }
}

<?php

namespace App\Livewire\Modals;

use App\Models\User;
use Livewire\Component;
use App\Services\CpanelService;
use App\Livewire\Forms\UserForm;
use App\Services\DatabaseService;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use LivewireUI\Modal\ModalComponent;
use App\Http\Requests\StoreUserRequest;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Computed;

class FormUser extends ModalComponent
{
    use LivewireAlert;

    public UserForm $form; 

    public $roles;

    public $user_id;
    // public $password;
    public $is_create_db_account;
    public $is_create_cpanel_account;

    public function mount()
    {
        $this->roles = Role::all();
        if ($this->user_id) {
            $user = User::find($this->user_id);
            $this->form->setModel($user);
        }
    }

    public function render()
    {
        return view('livewire.modals.form-user');
    }

    public function store()
    {
        DB::beginTransaction();

        $user = $this->form->store();

        if ($this->form->is_create_cpanel_account) {
            /* create cpanel account */
            $cpanel_service = new CpanelService;
            $user_cpanel = $cpanel_service->createAccount(
                $user,
                $this->form->username,
                $this->form->domain,
                $this->form->email,
                $this->form->password,
                'all website'
            );
        }

        if ($this->form->is_create_db_account) {
            /* create database account */
            $database_service = new DatabaseService;
            $user_database = $database_service->createAccount($user, $this->form->database_username, $this->form->database_password, $this->form->database);
        }

        
        DB::commit();
        
        $this->form->reset();
        $this->alert('success', 'Success!');
        $this->dispatch('refreshComponent'); // semua yg punya refresh component akan ke trigger

        $this->closeModal();
    }

    /* Modal */
    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    #[Computed]
    public function generatePassword($length = 18){
        $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
                  '0123456789-=~!@#$%^&*()_+/<>?;:[]{}\|';
      
        $str = '';
        $max = strlen($chars) - 1;
      
        for ($i=0; $i < $length; $i++)
          $str .= $chars[random_int(0, $max)];
        
        return $str;
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckRoleController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('operator')) {
            if ($user->staff()->position_type_id == key_option('sekretaris_desa')) {
                return $this->redirect('/profile', navigate: true);

            }
        }

        return $this->redirect('/dashboard', navigate: true);
    }
}

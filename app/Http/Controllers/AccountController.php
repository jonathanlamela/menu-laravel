<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class AccountController extends Controller
{


    public function dashboard()
    {
        return Inertia::render('ProfiloPage');
    }

    public function updatePasswordView()
    {
        return view('account/password-change');
    }
}

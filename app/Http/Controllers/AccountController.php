<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class AccountController extends Controller
{

    public function cambiaPassword()
    {
        return Inertia::render('PasswordChangePage');
    }

    public function informazioniPersonaliView()
    {
        return Inertia::render('ProfiloUpdateInfoPage');
    }

    public function dashboard()
    {
        return Inertia::render('ProfiloPage');
    }

    public function updatePasswordView()
    {
        return view('account/password-change');
    }
}

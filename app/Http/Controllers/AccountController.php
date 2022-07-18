<?php

namespace App\Http\Controllers;


class AccountController extends Controller
{

    public function cambiaPassword()
    {
        return view('account.password-change');
    }

    public function informazioniPersonaliView()
    {
        return view('account.profile-update');
    }

    public function dashboard()
    {
        return view('account.index');
    }
}

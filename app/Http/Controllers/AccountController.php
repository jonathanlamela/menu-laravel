<?php

namespace App\Http\Controllers;

use Inertia\Inertia;


class AccountController extends Controller
{

    public function cambiaPassword()
    {
        return Inertia::render("Account/ChangePasswordPage", []);
    }

    public function informazioniPersonaliView()
    {
        return Inertia::render("Account/InformazioniPersonaliPage", []);
    }

    public function dashboard()
    {
        return Inertia::render("Account/AccountPage", []);
    }
}

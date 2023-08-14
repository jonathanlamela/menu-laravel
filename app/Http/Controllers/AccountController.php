<?php

namespace App\Http\Controllers;

use Inertia\Inertia;


class AccountController extends Controller
{

    public function cambiaPassword()
    {
        return Inertia::render("account/ChangePasswordPage", []);
    }

    public function informazioniPersonaliView()
    {
        return Inertia::render("account/InformazioniPersonaliPage", []);
    }

    public function dashboard()
    {
        return Inertia::render("account/AccountPage", []);
    }
}

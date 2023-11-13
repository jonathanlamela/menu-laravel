<?php

namespace App\Http\Controllers;



class AccountController extends Controller
{

    public function changePassword()
    {
        return view("account.change_password", []);
    }

    public function myAccount()
    {
        return view("account.my_account", []);
    }

    public function index()
    {
        return view("account.index", []);
    }
}

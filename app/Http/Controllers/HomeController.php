<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;



class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function changeLanguage()
    {

        $lang = request()->get('lang', 'it');
        if (in_array($lang, ['it', 'en'])) {
            session(["language" => $lang]);
        }
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    //
    public function index()
    {
        return view('admin/settings/index', [
            "object" => Setting::all()->first()
        ]);
    }
}

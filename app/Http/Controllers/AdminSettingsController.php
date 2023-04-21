<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminSettingsController extends Controller
{
    public function index()
    {
        return view('admin/impostazioni/index', [
            "object" => Setting::all()
        ]);
    }
}

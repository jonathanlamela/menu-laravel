<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminSettingsController extends Controller
{
    public function index()
    {
        return Inertia::render('admin/settings/ImpostazioniGeneraliPage', [
            "object" => Setting::all()
        ]);
    }
}

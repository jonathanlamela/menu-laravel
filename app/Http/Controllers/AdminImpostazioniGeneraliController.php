<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AdminImpostazioniGeneraliController extends Controller
{
    public function index()
    {
        return view('admin/impostazioni/generali', [
            "item" => GeneralSetting::first() ?? new GeneralSetting()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_title' => 'required',
            'site_subtitle' => ''
        ], [
            'site_title.required' => "Il campo nome del sito è obbligatorio",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.impostazioni.generali'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        if (GeneralSetting::first()) {
            GeneralSetting::first()->update($attributes);
        } else {
            GeneralSetting::create($attributes);
        }

        session()->flash("success_message", "Impostazioni aggiornate");

        return redirect(route('admin.impostazioni.generali'));
    }
}

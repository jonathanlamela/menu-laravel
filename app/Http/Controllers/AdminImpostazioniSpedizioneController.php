<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Setting;
use App\Models\ShippingSetting;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AdminImpostazioniSpedizioneController extends Controller
{
    public function index()
    {
        return view('admin/impostazioni/spedizione', [
            "item" => ShippingSetting::first() ?? new ShippingSetting(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shipping_costs' => 'required|numeric',
        ], [
            'shipping_costs.required' => "Il campo spese di spedizione è obbligatorio",
            'shipping_costs.numeric' => "Inserisci un costo valido ",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.impostazioni.spedizione'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        if (ShippingSetting::first()) {
            ShippingSetting::first()->update($attributes);
        } else {
            ShippingSetting::create($attributes);
        }

        session()->flash("success_message", "Impostazioni aggiornate");

        return redirect(route('admin.impostazioni.spedizione'));
    }
}

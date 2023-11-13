<?php

namespace App\Http\Controllers;

use App\Models\OrderState;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;

class AdminImpostazioniGeneraliController extends Controller
{
    public function index()
    {
        return view('admin.settings.generals', [
            "item" => Settings::first() ?? new Settings(),
            "order_states" => OrderState::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_title' => 'required',
            'site_subtitle' => '',
            'order_created_state_id' => 'required|numeric',
            'order_paid_state_id' => 'required|numeric',
            'order_deleted_state_id' => 'required|numeric',
            'shipping_costs' => 'required|numeric',
        ], [
            'site_title.required' => "Il campo nome del sito è obbligatorio",
            'order_created_state_id.required' => "Campo obbligatorio",
            'order_paid_state_id.required' => "Campo obbligatorio",
            'order_deleted_state_id.required' => "Campo obbligatorio",
            'shipping_costs.required' => "Il campo spese di spedizione è obbligatorio",
            'shipping_costs.numeric' => "Inserisci un costo valido ",
        ]);


        if ($validator->fails()) {
            return redirect(route('admin.settings.generals'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        if (Settings::first()) {
            Settings::first()->update($attributes);
        } else {
            Settings::create($attributes);
        }

        session()->flash("success_message", "Impostazioni aggiornate");

        return redirect(route('admin.settings.generals'));
    }
}

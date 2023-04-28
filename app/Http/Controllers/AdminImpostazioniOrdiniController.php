<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Setting;
use App\Models\OrdiniSetting;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\OrderState;

class AdminImpostazioniOrdiniController extends Controller
{
    public function index()
    {
        return view('admin/impostazioni/ordini', [
            "item" => OrdiniSetting::first() ?? new OrdiniSetting(),
            "orderStates" => OrderState::all()

        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_created_state_id' => 'required|numeric',
            'order_paid_state_id' => 'required|numeric',
        ], [
            'order_created_state_id.required' => "Campo obbligatorio",
            'order_paid_state_id.required' => "Campo obbligatorio",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.impostazioni.ordini'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        if (OrdiniSetting::first()) {
            OrdiniSetting::first()->update($attributes);
        } else {
            OrdiniSetting::create($attributes);
        }

        session()->flash("success_message", "Impostazioni aggiornate");

        return redirect(route('admin.impostazioni.ordini'));
    }
}

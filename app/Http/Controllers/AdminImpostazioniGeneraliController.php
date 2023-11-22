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
        ], [
            'site_title.required' => __('settings.site_title_required'),
            'order_created_state_id.required' => __('settings.order_created_state_required'),
            'order_paid_state_id.required' => __('settings.order_paid_state_required'),
            'order_deleted_state_id.required' =>  __('settings.order_deleted_state_required'),
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

        session()->flash("success_message", __('settings.update_success'));

        return redirect(route('admin.settings.generals'));
    }
}

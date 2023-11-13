<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderState;
use Illuminate\Support\Facades\Validator;

class AdminOrderStateController extends Controller
{

    public $badge_options = [
        "badge-primary" => "Primary",
        "badge-secondary" => "Secondary",
        "badge-info" => "Info",
        "badge-success" => "Success",
        "badge-danger" => "Danger"
    ];

    public function list()
    {
        $orderBy = request("orderBy") ?? "id";

        $ascending_value = request("ascending", 'true') === 'true' ? 'asc' : 'desc';

        return view('admin.order_state.list', [
            "data" => OrderState::filter(request(['search']))->orderBy($orderBy, $ascending_value)->paginate(request('perPage') ?? 5),
            "search" => request('search', null),
            "orderBy" => $orderBy,
            "ascending" => request("ascending", 'true') == 'true',
        ]);
    }

    public function create()
    {
        return view('admin.order_state.create', [
            "badge_options" => $this->badge_options
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'css_badge_class' => ''
        ], [
            'name.required' => "Il campo nome è obbligatorio",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order_state.create'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        OrderState::create($attributes);



        session()->flash("success_message", "Stato ordine creato");

        return redirect(route('admin.order_state.list'));
    }

    public function edit(OrderState $orderState)
    {
        return view('admin.order_state.edit', [
            "orderState" => $orderState,
            "badge_options" => $this->badge_options
        ]);
    }

    public function update(OrderState $orderState, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ], [
            'name.required' => "Il campo nome è obbligatorio",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order_state.edit', ["orderState" => $orderState->id]))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();



        $orderState->update($attributes);


        session()->flash("success_message", "Stato ordine aggiornato");

        return redirect(route('admin.order_state.edit', ["orderState" => $orderState->id]));
    }

    public function delete(OrderState $orderState)
    {
        return view('admin.order_state.delete', [
            "orderState" => $orderState
        ]);
    }

    public function destroy(OrderState $orderState)
    {
        session()->flash("success_message", "Stato ordine " . $orderState->name . " eliminato");

        OrderState::destroy($orderState->id);
        return redirect(route('admin.order_state.list'));
    }
}

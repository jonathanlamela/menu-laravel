<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderState;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AdminOrderStateController extends Controller
{
    public function list()
    {
        $orderBy = request("orderBy") ?? "id";
        $ascending_value = request("ascending", 'true');
        $ascending = $ascending_value === 'true' ? 'asc' : 'desc';

        return Inertia::render('admin/order_state/AdminOrderStateListPage', [
            "data" => OrderState::filter(request(['search']))->orderBy($orderBy, $ascending)->paginate(request('perPage') ?? 5),
            "search" => request('search', null),
            "orderBy" => $orderBy,
            "ascending" => $ascending_value === "true",
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/order_state/AdminOrderStateCreatePage', []);
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
            return redirect(route('admin.order-state.create'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        OrderState::create($attributes);



        session()->flash("success_message", "Stato ordine creato");

        return redirect(route('admin.order-state.list'));
    }

    public function edit(OrderState $orderState)
    {
        return Inertia::render('admin/order_state/AdminOrderStateEditPage', [
            "item" => $orderState
        ]);
    }

    public function update(OrderState $orderState, Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'css_badge_class' => ''
        ], [
            'name.required' => "Il campo nome è obbligatorio",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.order-state.edit', ["orderState" => $orderState->id]))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();



        $orderState->update($attributes);


        session()->flash("success_message", "Stato ordine aggiornato");

        return redirect(route('admin.order-state.edit', ["orderState" => $orderState->id]));
    }

    public function delete(OrderState $orderState)
    {
        return Inertia::render('admin/order_state/AdminOrderStateDeletePage', [
            "item" => $orderState
        ]);
    }

    public function destroy(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ], [
            'name.required' => "Il campo nome è obbligatorio",
            'name.unique' => "Il nome della categoria deve essere univoco"
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.category.list'))
                ->withErrors($validator)
                ->withInput();
        }

        $id = $validator->validated()['id'];

        $orderState = OrderState::find($id);

        session()->flash("success_message", "Stato ordine " . $orderState->name . " eliminato");

        OrderState::destroy($id);
        return redirect(route('admin.order-state.list'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderState;
use Illuminate\Support\Facades\Validator;

class AdminOrderStateController extends Controller
{
    public function list()
    {
        return view('admin/order-state/list', [
            "items" => OrderState::filter(request(['search']))->paginate(request('elementsPerPage') ?? 5),
            "elementsPerPage" => request('elementsPerPage') ?? 5
        ]);
    }

    public function create()
    {
        return view('admin/order-state/create', []);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'css_badge_class' => ''
        ], [
            'description.required' => "Il campo nome è obbligatorio",
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
        return view('admin/order-state/edit', [
            "item" => $orderState
        ]);
    }

    public function update(OrderState $orderState, Request $request)
    {


        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'css_badge_class' => ''
        ], [
            'description.required' => "Il campo nome è obbligatorio",
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
        return view('admin/order-state/delete', [
            "item" => $orderState
        ]);
    }

    public function destroy(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ], [
            'description.required' => "Il campo nome è obbligatorio",
            'description.unique' => "Il nome della categoria deve essere univoco"
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.category.list'))
                ->withErrors($validator)
                ->withInput();
        }

        $id = $validator->validated()['id'];

        $orderState = OrderState::find($id);

        session()->flash("success_message", "Stato ordine " . $orderState->description . " eliminato");

        OrderState::destroy($id);
        return redirect(route('admin.order-state.list'));
    }
}

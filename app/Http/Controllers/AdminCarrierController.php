<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Carrier;
use Illuminate\Support\Facades\Validator;

class AdminCarrierController extends Controller
{
    public function list()
    {
        $orderBy = request("orderBy") ?? "id";
        $ascending_value = request("ascending", 'true') === 'true' ? 'asc' : 'desc';

        return view("admin.carrier.list", [
            "data" => Carrier::filter(request(['search']))->orderBy($orderBy, $ascending_value)->paginate(request('perPage') ?? 5),
            "search" => request('search', null),
            "orderBy" => $orderBy,
            "ascending" => request("ascending", 'true') === 'true',
        ]);
    }

    public function create()
    {
        return view("admin.carrier.create");
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'cost' => 'required'
        ], [
            'name.required' => __("carrier.name_required"),
            'cost.required' => __("carrier.cost_required"),
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.carrier.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $attributes = $validator->validated();

        Carrier::create($attributes);

        session()->flash("success_message", __("carrier.create_success"));

        return redirect(route('admin.carrier.list'));
    }

    public function edit(Carrier $carrier)
    {
        return view("admin.carrier.edit", [
            "carrier" => $carrier
        ]);
    }

    public function update(Carrier $carrier, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'costs' => 'required'
        ], [
            'name.required' => __("carrier.name_required"),
            'cost.required' => __("carrier.cost_required"),
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.carrier.edit', ["carrier" => $carrier->id]))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        $carrier->update($attributes);

        session()->flash("success_message", __("carrier.update_success"));

        return redirect(route('admin.carrier.edit', ["carrier" => $carrier->id]));
    }

    public function delete(Carrier $carrier)
    {
        return view("admin.carrier.delete", [
            "carrier" => $carrier
        ]);
    }

    public function destroy(Carrier $carrier)
    {

        session()->flash("success_message", __("carrier.delete_success", [
            "name" => $carrier->name
        ]));


        $carrier->update([
            "deleted" => true
        ]);

        return redirect(route('admin.carrier.list'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Food;
use Inertia\Inertia;

class AdminFoodController extends Controller
{

    public function list()
    {
        $orderBy = request("orderBy") ?? "id";
        $ascending_value = request("ascending", 'true');
        $ascending = $ascending_value === 'true' ? 'asc' : 'desc';

        return view("admin.food.list", [
            "data" => Food::filter(request(['search']))->with('category')->orderBy($orderBy, $ascending)->paginate(request('perPage') ?? 5),
            "search" => request('search', null),
            "orderBy" => $orderBy,
            "ascending" => $ascending_value === "true",
        ]);
    }

    public function create()
    {
        return view("admin.food.create", [
            "categories" => Category::all(["id", "name"])
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'ingredients' => ''
        ], [
            'name.required' => "Il campo nome è obbligatorio",
            'price.required' => "Il prezzo del prodotto è obbligatorio",
            'price.numeric' => "Inserisci un valore numerico",
            'category_id.required' => "Seleziona una categoria",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.food.create'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        Food::create($attributes);

        session()->flash("success_message", "Cibo creato");

        return redirect(route('admin.food.list'));
    }

    public function edit(Food $food)
    {
        return view("admin.food.edit", [
            "food" => $food,
            "categories" => Category::all(["id", "name"])
        ]);
    }

    public function update(Food $food, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'ingredients' => ''
        ], [
            'name.required' => "Il campo nome è obbligatorio",
            'price.required' => "Il prezzo del prodotto è obbligatorio",
            'price.numeric' => "Inserisci un valore numerico",
            'category_id.required' => "Seleziona una categoria",
        ]);

        if ($validator->fails()) {

            return redirect(route('admin.food.edit', ["food" => $food->id]))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        $food->update($attributes);


        session()->flash("success_message", "Cibo aggiornato");

        return redirect(route('admin.food.edit', ["food" => $food->id]));
    }

    public function delete(Food $food)
    {
        return view("admin.food.delete", [
            "food" => $food
        ]);
    }

    public function destroy(Food $food)
    {
        $food = Food::find($food->id);

        session()->flash("success_message", "Cibo " . $food->name . " eliminato");

        Food::destroy($food->id);
        return redirect(route('admin.food.list'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Food;
use Inertia\Inertia;

class AdminFoodController extends Controller
{

    public function list()
    {
        return view('admin/food/list', [
            "items" => Food::filter(request(['search']))->paginate(request('elementsPerPage') ?? 5),
            "elementsPerPage" => request('elementsPerPage') ?? 5
        ]);
    }

    public function create()
    {
        return view('admin.food.create', [
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

        $food = Food::create($attributes);


        session()->flash("success_message", "Cibo creato");

        return redirect(route('admin.food.list'));
    }

    public function edit(Food $food)
    {
        return view("admin/food/edit", [
            "item" => $food,
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
        return view("admin/food/delete", [
            "item" => $food
        ]);
    }

    public function destroy(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ], [
            'name.required' => "Il campo nome è obbligatorio",
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.food.list'))
                ->withErrors($validator)
                ->withInput();
        }

        $id = $validator->validated()['id'];

        $food = Food::find($id);

        session()->flash("success_message", "Cibo " . $food->name . " eliminato");

        Food::destroy($id);
        return redirect(route('admin.food.list'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Food;

class AdminFoodController extends Controller
{

    public function list()
    {
        $orderBy = request("orderBy") ?? "id";
        $ascending_value = request("ascending", 'true') === 'true' ? 'asc' : 'desc';

        return view("admin.food.list", [
            "data" => Food::filter(request(['search']))->with('category')->orderBy($orderBy, $ascending_value)->paginate(request('perPage') ?? 5),
            "search" => request('search', null),
            "orderBy" => $orderBy,
            "ascending" => request("ascending", 'true') === 'true',
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
            'name.required' => __('food.name_required'),
            'price.required' => __('food.price_required'),
            'price.numeric' => __('food.price_required'),
            'category_id.required' => __('food.category_required'),
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.food.create'))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        Food::create($attributes);

        session()->flash("success_message", __('food.create_success'));

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
            'name.required' => __('food.name_required'),
            'price.required' => __('food.price_required'),
            'price.numeric' => __('food.price_required'),
            'category_id.required' => __('food.category_required'),
        ]);

        if ($validator->fails()) {

            return redirect(route('admin.food.edit', ["food" => $food->id]))
                ->withErrors($validator)
                ->withInput();
        }


        $attributes = $validator->validated();

        $food->update($attributes);


        session()->flash("success_message", __('food.update_success'));

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

        session()->flash("success_message", __('food.delete_success', [
            "name" => $food->name
        ]));

        $food->update([
            "deleted" => true
        ]);

        return redirect(route('admin.food.list'));
    }
}

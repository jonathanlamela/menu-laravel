<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{

    public function show(Category $category)
    {

        $foods = $category->foods()->get();

        return view("category.show", [
            "category" => $category,
            "foods" => $foods
        ]);
    }
}

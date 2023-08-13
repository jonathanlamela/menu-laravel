<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{

    public function show(Category $category)
    {

        $foods = $category->foods()->filter(request(['search']))->get();

        return Inertia::render("CategoriaPage", [
            "category" => $category,
            "foods" => $foods,
            "elementsPerPage" => request('elementsPerPage') ?? 5
        ]);
    }
}

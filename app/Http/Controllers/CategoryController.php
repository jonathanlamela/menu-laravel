<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{

    public function show(Category $category)
    {
        return Inertia::render("CategoryPage", [
            "category" => $category,
            "foods" => $category->foods()->filter(request(['search']))->paginate(request('elementsPerPage') ?? 5),
            "elementsPerPage" => request('elementsPerPage') ?? 5
        ]);
    }
}

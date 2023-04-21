<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{

    public function show(Category $category)
    {
        return view("category/show", [
            "category" => $category,
            "foods" => $category->foods()->filter(request(['search']))->paginate(request('elementsPerPage') ?? 5),
            "elementsPerPage" => request('elementsPerPage') ?? 5
        ]);
    }
}

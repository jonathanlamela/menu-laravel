<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public function doSearch()
    {
        $attributes = request()->validate([
            "search" => "required|min:1"
        ]);

        if ($attributes["search"]) {
            return view("search/results", [
                "foods" => Food::filter(request(['search']))->paginate(request('elementsPerPage') ?? 10),
                "elementsPerPage" => request('elementsPerPage') ?? 10
            ]);
        }

        return back();
    }
}

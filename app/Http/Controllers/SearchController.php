<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function doSearch()
    {
        $attributes = request();

        if ($attributes["search"]) {
            return view("search.show", [
                "foods" => Food::filter(request(['search']))->with('category')->get(),
                "search" => request("search")
            ]);
        }

        return redirect('/');
    }
}

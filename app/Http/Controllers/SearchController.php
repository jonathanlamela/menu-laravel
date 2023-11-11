<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function doSearch()
    {
        $attributes = request();

        if ($attributes["key"]) {
            return view("search.show", [
                "foods" => Food::filter(request(['key']))->with('category')->get(),
                "key" => request("key")
            ]);
        }

        return redirect('/');
    }
}

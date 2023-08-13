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

        if ($attributes["chiave"]) {
            return Inertia::render("CercaPage", [
                "foods" => Food::filter(request(['chiave']))->with('category')->get(),
                "chiave" => request("chiave")
            ]);
        }

        return redirect('/');
    }
}

<?php

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get("/categories", function () {
    return  Category::all(["id", "name", "image"]);
});

Route::get("/categories/{id}", function ($id) {
    return Category::where("id", '=', $id)->first(["id", "name", "image"]);
});

Route::get("/foods", function () {
    return Food::all(["id", "name", "image", "ingredients", "price", "category_id"]);
});

Route::get("/categories/{category_id}/foods", function ($category_id) {
    return Food::where("category_id", '=', $category_id)->get(["id", "name", "image", "ingredients", "price", "category_id"]);
});

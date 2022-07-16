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
    return Food::all(["id", "name", "image", "ingredients", "price", "categoryId"]);
});

Route::get("/categories/{categoryId}/foods", function ($categoryId) {
    return Food::where("categoryId", '=', $categoryId)->get(["id", "name", "image", "ingredients", "price", "categoryId"]);
});

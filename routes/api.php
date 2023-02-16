<?php

use App\Models\Category;
use App\Models\Food;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


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

Route::post('/login/getToken', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});


Route::middleware('auth:sanctum')->get('/login/verifyStatus', function (Request $request) {
    return response()->json([
        "verified" => $request->user()->email_verified_at != null
    ]);
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


Route::get("/emailExists", function (Request $request) {
    return response()->json([
        "result" => User::where("email", $request->input('email'))->count() > 0
    ]);
});

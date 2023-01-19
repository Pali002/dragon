<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DragonController;
use App\Http\Controllers\ColorController;

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

Route::post("/register", [AuthController::class, "signUp"]);
Route::post("/login", [AuthController::class, "signIn"]);
Route::post("/logout", [AuthController::class, "logOut"]);
Route::post("/color", [AuthController::class, "color"]);
Route::post("/getColor", [AuthController::class, "getColor"]);

Route::post("/store", [DragonController::class, "store"]);
Route::post("/index", [DragonController::class, "index"]);
Route::put("/color/{id}", [ColorController::class, "update"]);
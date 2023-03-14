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

Route::group([ "middleware" => [ "auth:sanctum" ]], function() {
    Route::post("/store", [DragonController::class, "store"]);
    Route::put("/dragon/{id}", [DragonController::class, "update"]);
    Route::delete("/destroy/{id}", [DragonController::class, "destroy"]);
});

Route::post("/register", [AuthController::class, "signUp"]);
Route::post("/login", [AuthController::class, "signIn"]);
Route::post("/logout", [AuthController::class, "logOut"]);
Route::post("/color", [AuthController::class, "color"]);
Route::post("/getColor", [AuthController::class, "getColor"]);


Route::post("/index", [DragonController::class, "index"]);
Route::get("/show/{id}", [DragonController::class, "show"]);


Route::put("/color/{id}", [ColorController::class, "update"]);
Route::post("/colors", [ColorController::class, "storeColor"]);
Route::post("/indexColor", [ColorController::class, "indexColor"]);
Route::delete("/destroyColor/{id}", [ColorController::class, "destroyColor"]);
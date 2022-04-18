<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EquipmentTypeController;
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

Route::group(["middleware" => "auth:sanctum"], function() {
    Route::get("equipment", [EquipmentController::class, "find"]);
    Route::get("equipment/{id}", [EquipmentController::class, "read"]);
    Route::post("equipment", [EquipmentController::class, "create"]);
    Route::put("equipment/{id}", [EquipmentController::class, "update"]);
    Route::delete("equipment/{id}", [EquipmentController::class, "delete"]);

    Route::get("equipment-type", [EquipmentTypeController::class, "find"]);
});

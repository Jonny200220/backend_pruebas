<?php

use App\Http\Controllers\InventoryCrud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("v1/healthcheck", function(){
    return response()->json(['message' => 'El servidor funciona bien...']);
});

Route::controller(InventoryCrud::class) ->group(function(){
    Route::get("v1/Inventory", "Stack");
});
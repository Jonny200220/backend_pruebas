<?php

use App\Http\Controllers\InventoryCrud;
use App\Http\Controllers\PruebaController;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("v1/healthcheck", function(){
    return response()->json(['message' => 'El servidor funciona bien...']);
});

// Obtener inventario completo
Route::controller(InventoryCrud::class) ->group(function(){
    Route::get("v1/Inventory", "Stack");
});

// Obtener 50 registros de la base de datos
Route::get('v1/data_100', function () {
    $datos = Inventory::limit(50)->get();
    return response()->json($datos);
});

Route::post('v1/import-table', [PruebaController::class, 'import']);

// Route::get('v1/carga', [PruebasController::class, 'Carga']);

// Route::post('/store', [InventoryCrud::class, 'store'])->name('store');


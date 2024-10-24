<?php

use App\Http\Controllers\MarcasController;
use App\Http\Controllers\PruebaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});
// ->middleware('auth:sanctum');

Route::get("v1/healthcheck", function(){
    return response()->json(['message' => 'El servidor funciona bien...']);
});

Route::post('v1/import-table', [PruebaController::class, 'import']);

Route::post('v1/insert', [PruebaController::class, 'readAndInsert']);

Route::get('v1/progreso', [PruebaController::class, 'getProgreso']);

// Route::resource('v1/marcas', MarcasController::class);

Route::get('v1/marcas', [MarcasController::class, 'index']);
// Route::post('v1/marcas', [MarcasController::class, 'store']); 
// Route::get('v1/marcas/{id}', [MarcasController::class, 'show']); 
// Route::put('v1/marcas/{id}', [MarcasController::class, 'update']); 
// Route::delete('v1/marcas/{id}', [MarcasController::class, 'destroy']);
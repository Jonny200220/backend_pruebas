<?php

use App\Http\Controllers\DescripcionesController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ModelosController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\TiposController;
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

Route::resource('v1/marcas', MarcasController::class);

Route::resource('v1/modelos', ModelosController::class);

Route::resource('v1/descripciones', DescripcionesController::class);

Route::resource('v1.tipos', TiposController::class);
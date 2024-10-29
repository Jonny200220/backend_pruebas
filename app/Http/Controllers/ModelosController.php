<?php

namespace App\Http\Controllers;

use App\Models\Modelos;
use Illuminate\Http\Request;

class ModelosController extends Controller
{
    
    public function index()
    {
        $consulta = Modelos::all();
        return response()->json(['data' => $consulta,'message' => 'success'], 200);
    }

    public function store(Request $request)
    {
        $modelo = new Modelos();
        $modelo->descripcion_modelo = $request->input('modelo');
        $modelo->REGISTRO_fecha_creacion = now();
        $modelo->REGISTRO_fecha_ultimo_cambio = now();
        $modelo->REGISTRO_en_uso = $request->input('idModelo');
        $modelo->save();

        return response()->json([
            'status' => true,
            'message' => 'Modelo creada exitosamente'
        ], 201); // 201 para creación exitosa
    }

    public function update(Request $request, Modelos $modelo){

        $modelo->update([
            'descripcion_modelo' => $request->input('modelo', $modelo->descripcion_modelo),
            'REGISTRO_fecha_ultimo_cambio' => now(),
            'REGISTRO_en_uso' => $request->input('idModelo', $modelo->REGISTRO_en_uso),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Modelo actualizado exitosamente',
            'data' => $modelo
        ], 200);
    }

    public function destroy(Modelos $modelo){
        $modelo->delete();

        return response()->json([
            'status' => true,
            'message' => 'Modelo eliminada exitosamente'
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tipos;
use Illuminate\Http\Request;

class TiposController extends Controller
{
    public function index()
    {
        $consulta = Tipos::all();
        return response()->json(['data' => $consulta,'message' => 'success'], 200);
    }

    public function store(Request $request)
    {
        $marca = new Tipos();
        $marca->descripcion_tipo = $request->input('tipo');
        $marca->REGISTRO_fecha_creacion = now();
        $marca->REGISTRO_fecha_ultimo_cambio = now();
        $marca->REGISTRO_en_uso = $request->input('idTipo');
        $marca->save();

        return response()->json([
            'status' => true,
            'message' => 'Tipo creado exitosamente'
        ], 201); // 201 para creación exitosa
    }

    public function update(Request $request, Tipos $tipo){

        $tipo->update([
            'descripcion_tipo' => $request->input('tipo'),
            'REGISTRO_fecha_ultimo_cambio' => now(),
            'REGISTRO_en_uso' => $request->input('idTipo')
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Tipo actualizado exitosamente'
        ], 200);
    }

    public function destroy(Tipos $tipo){
        $tipo->delete();

        return response()->json([
            'status' => true,
            'message' => 'Tipo eliminado exitosamente'
        ], 200);
    }
}

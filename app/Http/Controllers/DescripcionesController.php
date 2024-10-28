<?php

namespace App\Http\Controllers;

use App\Models\Descripcion;
use Illuminate\Http\Request;


class DescripcionesController extends Controller
{
    public function index()
    {
        $consulta = Descripcion::all();
        return response()->json(['data' => $consulta,'message' => 'success'], 200);
    }

    public function store(Request $request)
    {
        $marca = new Descripcion();
        $marca->descripcion = $request->input('descripcion');
        $marca->REGISTRO_fecha_creacion = now();
        $marca->REGISTRO_fecha_ultimo_cambio = now();
        $marca->REGISTRO_en_uso = $request->input('REGISTRO_en_uso');
        $marca->save();

        return response()->json([
            'status' => true,
            'message' => 'descripcion creada exitosamente'
        ], 201); // 201 para creación exitosa
    }

    public function update(Request $request, Descripcion $descripcion){

        $descripcion->update([
            'descripcion' => $request->input('descripcion'),
            'REGISTRO_fecha_ultimo_cambio' => now(),
            'REGISTRO_en_uso' => $request->input('REGISTRO_en_uso')
        ]);
        return response()->json([
            'status' => true,
            'message' => 'descripcion actualizada exitosamente'
        ], 200);
    }

    public function destroy(Descripcion $descripcion){
        $descripcion->delete();

        return response()->json([
            'status' => true,
            'message' => 'descripcion eliminada exitosamente'
        ], 200);
    }
}

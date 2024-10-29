<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    public function index()
    {
        $consulta = Marcas::all();
        return response()->json(['data' => $consulta,'message' => 'success'], 200);
    }

    public function store(Request $request)
    {
        $marca = new Marcas();
        $marca->descripcion_marca = $request->input('marca');
        $marca->REGISTRO_fecha_creacion = now();
        $marca->REGISTRO_fecha_ultimo_cambio = now();
        $marca->REGISTRO_en_uso = $request->input('idMarca');
        $marca->save();

        return response()->json([
            'status' => true,
            'message' => 'Marca creada exitosamente'
        ], 201);
    }

    public function update(Request $request, Marcas $marca){

        $marca->update([
            'descripcion_marca' => $request->input('marca'),
            'REGISTRO_fecha_ultimo_cambio' => now(),
            'REGISTRO_en_uso' => $request->input('idMarca')
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Marca actualizada exitosamente'
        ], 200);
    }

    public function destroy(Marcas $marca){
        $marca->delete();

        return response()->json([
            'status' => true,
            'message' => 'Marca eliminada exitosamente'
        ], 200);
    }
   }

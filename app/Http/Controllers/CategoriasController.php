<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $consulta = Categoria::all();
        return response()->json(['data' => $consulta,'message' => 'success'], 200);
    }

    public function store(Request $request)
    {
        $categoria = new Categoria();
        $categoria->descripcion_categoria = $request->input('categoria');
        $categoria->REGISTRO_fecha_creacion = now();
        $categoria->REGISTRO_fecha_ultimo_cambio = now();
        $categoria->REGISTRO_en_uso = $request->input('idCategoria');
        $categoria->save();

        return response()->json([
            'status' => true,
            'message' => 'Tipo creado exitosamente'
        ], 201); // 201 para creación exitosa
    }

    public function update(Request $request, Categoria $categoria){

        $categoria->update([
            'descripcion_categoria' => $request->input('categoria'),
            'REGISTRO_fecha_ultimo_cambio' => now(),
            'REGISTRO_en_uso' => $request->input('idCategoria')
        ]);
        return response()->json([
            'status' => true,
            'message' => 'categoria actualizado exitosamente'
        ], 200);
    }

    public function destroy(Categoria $categoria){
        $categoria->delete();

        return response()->json([
            'status' => true,
            'message' => 'categoria eliminada exitosamente'
        ], 200);
    }
}

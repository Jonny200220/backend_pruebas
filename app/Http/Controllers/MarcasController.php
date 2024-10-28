<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    public function index()
    {
        $consulta = Marcas::all();
        return response()->json(['data' => $consulta,'message' => 'Marcas obtenidas correctamente'], 200);
    }

    // Crear una nueva marca
    // public function store(Request $request)
    // {
      
    //     $rules = ['descripcion_marca' => 'required|string|min:1|max: 255'];
        
    //     $validator = \Validator::make($request->input(), $rules);
    //     if($validator->fails()){
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $validator ->errors()->all()
    //         ], 400);
    //     }
    //     $department = new Marcas($request->input());
    //     $department->save();
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Marca created succesfully'
    //     ], 200);
    // }

}

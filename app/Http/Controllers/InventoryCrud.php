<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryCrud extends Controller
{
    public function Stack(){
        $consulta = Inventory::all();
        return response()->json([ "message"=> 'Inventarioooo', $consulta ], 200);
    }

    public function store(Request $request)
{
    // Se esta instanciando la tabla user
    $item = new Inventory();
    // nos da acceso al atributo de la tabla name que es igual al rqst o post que se llama name
    $item ->id_activos = $request -> id_activos;
    // solo se guarda
    $item->save();
    //Se redirecciona al index
    return to_route('index');
}
}


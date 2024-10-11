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
}
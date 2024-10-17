<?php

namespace App\Http\Controllers;

use App\Imports\PruebaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PruebaController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'archive' => 'required'
        ]);
        
        $base64File = $request->input('archive');
        $decodedFile = base64_decode($base64File);

        // Guardar el archivo decodificado temporalmente
        $filePath = storage_path('app/temp_file.xlsx');
        file_put_contents($filePath, $decodedFile);

        // Importar el archivo XLSX
        Excel::import(new PruebaImport, $filePath);

        // Eliminar el archivo temporal
        unlink($filePath);

        // Retornar un mensaje de éxito
        return response()->json(['message' => 'Productos importados con éxito'], 200);
    }
}

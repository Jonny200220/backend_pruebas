<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PruebaController extends Controller
{
    public function import(Request $request)
    {
        // Validar que se envía el archivo
        $request->validate([
            'archive' => 'required'
        ]);

        // Decodificar el archivo base64
        $base64File = $request->input('archive');
        $decodedFile = base64_decode($base64File);

        // Guardar el archivo decodificado temporalmente
        $filePath = storage_path('app/temp_file.xlsx');
        file_put_contents($filePath, $decodedFile);

        // Cargar el archivo Excel utilizando PhpSpreadsheet
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        
        // Iterar sobre las filas y columnas del archivo
        $data = [];
        foreach ($worksheet->getRowIterator() as $row) {
            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            foreach ($cellIterator as $cell) {
                $rowData[] = $cell->getValue(); 
            }

            $data[] = $rowData; 
        }

        // Retornar los datos procesados
        return response()->json(['data' => $data, 'message' => 'Archivo procesado con éxito'], 200);

        // Eliminar el archivo temporal
        unlink($filePath);
    }
}
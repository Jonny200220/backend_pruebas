<?php

namespace App\Http\Controllers;

use App\Models\Progreso;
use App\Models\Prueba;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\CellIterator;

class PruebaController extends Controller
{
    public function import(Request $request)
    {
        

        // Se lee el archivo y se toma la hoja activa (1ra hoja)
        // $spreadsheet = IOFactory::load($_FILES[ "archive" ]["tmp_name"]);
        $spreadsheet = IOFactory::load("C:\imam_enero.xls");
        $worksheet = $spreadsheet->getActiveSheet();
        $countFile = 0;
        
        // Iterar sobre las filas y columnas del archivo
        
        
        // Accedemos al campo 
        // $avance = Progreso::find(1);
        
        
        // Total de filas
        $progreso = Progreso::find(1);
        $progreso-> Total = $worksheet->getHighestRow();
        $progreso-> Avance = 0;
        $progreso-> save();
        
        $data = [];
        foreach ($worksheet->getRowIterator() as $row) {
            


            $progreso = Progreso::find(1);
            $progreso -> Avance ++;
            $progreso -> save();

            if ($row->isEmpty()) {
                continue; // Saltar a la siguiente fila si está vacía
            }
            $count = 0;

            $rowData = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            foreach ($cellIterator as $cell) {
                $rowData[] = $cell->getValue();
                if($count == 35){
                    break;
                }
                $count ++;
            }

            $data[] = $rowData;
            $countFile++;
            if($countFile == 35){
                break;
            }
        }

        // $this->readAndInsert($worksheet);

        // Retornar los datos procesados
        return response()->json(['data' => $data, 'message' => 'Archivo procesado con éxito'], 200);

        // Eliminar el archivo temporal
        unlink($filePath);
    }

    public function getProgreso()
    {
        $progreso = Progreso::find(1);
        // Verificar si se encontró el registro
        if (!$progreso) {
            return response()->json(['message' => 'No se encontró el progreso'], 404);
        }
            
        return response()->json([
            'total' => $progreso->Total,
            'avance' => $progreso->Avance
        ], 200);
    }

//     public function readAndInsert($worksheet)
// {
//     $rowIterator = $worksheet->getRowIterator();
//     $startRow = null;

//     // Buscar la fila donde aparece "Unidad negocio"
//     foreach ($rowIterator as $row) {
//         if ($row->isEmpty(
//             CellIterator::TREAT_EMPTY_STRING_AS_EMPTY_CELL | 
//             CellIterator::TREAT_NULL_VALUE_AS_EMPTY_CELL
//         )) {
//             continue; // Ignorar filas vacías
//         }

//         $cellIterator = $row->getCellIterator();
//         $cellIterator->setIterateOnlyExistingCells(false);

//         foreach ($cellIterator as $cell) {
//             if ($cell->getValue() === 'Unidad Negocio') {
//                 $startRow = $row->getRowIndex(); // Obtener el índice de la fila
//                 break 2; // Salir de ambos bucles si se encuentra "Unidad negocio"
//             }
//         }
//     }

//     // Verificar si encontramos la fila "Unidad negocio"
//     if ($startRow === null) {
//         dd('No se encontró la fila "Unidad Negocio"');
//     }

//     // Si encontramos la fila "Unidad negocio"
//     for ($i = $startRow + 1; $i <= $startRow + 10; $i++) {
//         $row = $worksheet->getRowIterator($i)->current();
//         $cellIterator = $row->getCellIterator();
//         $cellIterator->setIterateOnlyExistingCells(false);

//         $prueba = new Prueba();
//         $count = 0;
//         foreach ($cellIterator as $cell) {
//             // Mapear los campos correspondientes de las celdas a los atributos del modelo Prueba
//             switch ($count) {
//                 case 0: $prueba->unidad_Negocios = $cell->getValue(); break;
//                 case 1: $prueba->id_activos = $cell->getValue(); break;
//                 // Mapear los demás campos según corresponda
//             }
//             $count++;
//         }

//         // Depuración: Mostrar lo que se va a guardar
//         dd($prueba);  // Puedes comentar esto después de verificar que los datos son correctos

//         // Guardar en la base de datos
//         $prueba->save();
//     }
// }

}
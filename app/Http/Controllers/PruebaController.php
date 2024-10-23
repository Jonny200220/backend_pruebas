<?php

namespace App\Http\Controllers;

use App\Models\Progreso;
use App\Models\Prueba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date as FacadesDate;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PruebaController extends Controller
{
    public function import(Request $request)
    {

        // Se lee el archivo y se toma la hoja activa (1ra hoja)
        // $spreadsheet = IOFactory::load($_FILES[ "archive" ]["tmp_name"]);
        $spreadsheet = IOFactory::load("C:\IMAM_SEPTIEMBRE2024.xls");
        $worksheet = $spreadsheet->getActiveSheet();
        $countFile = 0;
    
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
        // Retornar los datos procesados
        return response()->json(['data' => $data, 'message' => 'Archivo procesado con éxito'], 200);

        // Eliminar el archivo temporal
        unlink($filePath);
    }

    public function readAndInsert(){
        // Cargando Hoja de excel
        $spreadsheet = IOFactory::load("C:\IMAM_FEBRERO2024.xls");
        $worksheet = $spreadsheet->getActiveSheet();

        $textoBuscado = 'Unidad Negocio';
        $datosFila = null;

        $encontrado = false;
        $fila = 1;
        for ($i=1; $i <= 10; $i++) { 
            if($worksheet->getCell("A{$i}")->getValue()=='Unidad Negocio'){
                $encontrado = true;
                $fila = $i;
                break;
            }
        }

        $progreso = Progreso::find(1);
        $progreso-> Total = $worksheet->getHighestRow();
        $progreso-> Avance = 0;
        $progreso-> save();

        if ($encontrado) {
            for ($i=1; $i <= $worksheet->getHighestRow(); $i++) {
                $progreso = Progreso::find(1);
                $progreso -> Avance ++;
                $progreso -> save();
                if($i <= $fila){
                    continue;
                }
 
                $prueba = new Prueba;
                $prueba-> unidad_negocios = $worksheet->getCell("A{$i}")->getValue();
                $prueba-> id_activos = $worksheet->getCell("B{$i}")->getValue();
                $prueba-> clases = $worksheet->getCell("C{$i}")->getValue();
                $prueba-> descripciones =  $worksheet->getCell("D{$i}")->getValue();
                $prueba-> comple_desc = $worksheet->getCell("E{$i}")->getValue();
                $prueba-> id_articulos = intval($worksheet->getCell("F{$i}")->getValue());
                $prueba-> descripciones_articulos = $worksheet->getCell("G{$i}")->getValue();
                $prueba-> nombres_fabricantes = $worksheet->getCell("H{$i}")->getValue();
                $prueba-> id_series = $worksheet->getCell("I{$i}")->getValue();
                $prueba-> modelos = $worksheet->getCell("J{$i}")->getValue();
                $prueba-> categorias = $worksheet->getCell("K{$i}")->getValue();
                $prueba-> comentarios_nni = $worksheet->getCell("L{$i}")->getValue();
                $prueba-> unidades_operaciones = $worksheet->getCell("M{$i}")->getValue();
                $prueba-> unidades_informacion = $worksheet->getCell("N{$i}")->getValue();
                $prueba-> descripciones_unidad_info = $worksheet->getCell("O{$i}")->getValue();
                $prueba-> ui_estados = $worksheet->getCell("P{$i}")->getValue();
                $prueba-> centros_costo = $worksheet->getCell("Q{$i}")->getValue();
                $prueba-> descripciones_centros_costo = $worksheet->getCell("R{$i}")->getValue();
                $prueba-> cc_estados = $worksheet->getCell("S{$i}")->getValue();
                $prueba-> combinaciones = $worksheet->getCell("T{$i}")->getValue();
                $prueba-> divisiones = $worksheet->getCell("U{$i}")->getValue();
                $prueba-> subdivisiones = $worksheet->getCell("V{$i}")->getValue();
                $prueba-> ubicaciones = $worksheet->getCell("W{$i}")->getValue();
                $prueba-> sr = $worksheet->getCell("X{$i}")->getValue();
                $prueba-> numero_actas = $worksheet->getCell("Y{$i}")->getValue();
                $prueba-> nombres_rcba = $worksheet->getCell("Z{$i}")->getValue();
                $prueba-> costos = floatval($worksheet->getCell("AA{$i}")->getValue());
                if($worksheet->getCell("AB{$i}")->getFormattedValue() != null){
                    $fecha_adq = FacadesDate::createFromFormat('m/d/Y',$worksheet->getCell("AB{$i}")->getFormattedValue());
                    $formato_adq = $fecha_adq-> format('Y-m-d');
                    $prueba-> fechas_adquisicion = $formato_adq;
                }
                $prueba-> numeros_alta = $worksheet->getCell("AC{$i}")->getValue();
                $prueba-> contratos = $worksheet->getCell("AD{$i}")->getValue();
                if($worksheet->getCell("AE{$i}")->getFormattedValue() != null){
                    $fecha_ult = FacadesDate::createFromFormat('m/d/Y',$worksheet->getCell("AE{$i}")->getFormattedValue());
                    $formato_ult = $fecha_ult-> format('Y-m-d');
                    $prueba-> fechas_ultimo_movimiento = $formato_ult;
                }
                $prueba-> numeros_movimiento = $worksheet->getCell("AF{$i}")->getValue();
                $prueba-> matriculas = $worksheet->getCell("AG{$i}")->getValue();
                $prueba-> nombres_usuarios = $worksheet->getCell("AH{$i}")->getValue();
                $prueba-> tipos_resguardo = $worksheet->getCell("AI{$i}")->getValue();
                $prueba-> numero_usuarios = intval($worksheet->getCell("AJ{$i}")->getValue());
                $prueba->save();
            }
            return response()->json(['status' => 'success', 'message' => "Insercion terminada"], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Texto no encontrado en el archivo'], 401);
        }
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
}
<?php

namespace App\Imports;

use App\Models\Prueba;
use Maatwebsite\Excel\Concerns\ToModel;

class PruebaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Prueba([
            'unidad_negocios'               => $row[0],
            'id_activos'                    => $row[1],
            'clases'                        => $row[2],
            'descripciones'                 => $row[3],
            'comple_desc'                   => $row[4],
            'id_articulos'                  => $row[5],
            'descripciones_articulos'       => $row[6],
            'nombres_fabricantes'           => $row[7],
            'id_series'                     => $row[8],
            'modelos'                       => $row[9],
            'categorias'                    => $row[10],
            'comentarios_nni'               => $row[11],
            'unidades_operaciones'          => $row[12],
            'unidades_informacion'          => $row[13],
            'descripciones_unidad_info'     => $row[14],
            'ui_estados'                    => $row[15],
            'centros_costo'                 => $row[16],
            'descripciones_centros_costo'   => $row[17],
            'cc_estados'                    => $row[18],
            'combinaciones'                 => $row[19],
            'divisiones'                    => $row[20],
            'subdivisiones'                 => $row[21],
            'ubicaciones'                   => $row[22],
            'sr'                            => $row[23],
            'numero_actas'                  => $row[24],
            'nombres_rcba'                  => $row[25],
            'costos'                        => $row[26],
            'fechas_adquisicion'            => $row[27],
            'numeros_alta'                  => $row[28],
            'contratos'                     => $row[29],
            'fechas_ultimo_movimiento'      => $row[30],
            'numeros_movimiento'            => $row[31],
            'matriculas'                    => $row[32],
            'nombres_usuarios'              => $row[33],
            'tipos_resguardo'               => $row[34],
            'numero_usuarios'               => $row[35],
        ]);
    }
}

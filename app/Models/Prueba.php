<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    // Especifica el nombre de la tabla en la base de datos
    protected $table = 'pruebas_imam';

    // Si tu tabla no tiene las columnas created_at y updated_at
    public $timestamps = false;

    // Especifica la clave primaria si no es 'id'
    // protected $primaryKey = 'id_articulos'; // Cambia si el nombre es otro

    // Define las columnas que pueden ser asignadas masivamente
    protected $fillable = [
        'unidad_negocios',
        'id_activos',
        'clases',
        'descripciones',
        'comple_desc',
        'id_articulos',
        'descripciones_articulos',
        'nombres_fabricantes',
        'id_series',
        'modelos',
        'categorias',
        'comentarios_nni',
        'unidades_operaciones',
        'unidades_informacion',
        'descripciones_unidad_info',
        'ui_estados',
        'centros_costo',
        'descripciones_centros_costo',
        'cc_estados',
        'combinaciones',
        'divisiones',
        'subdivisiones',
        'ubicaciones',
        'sr',
        'numero_actas',
        'nombres_rcba',
        'costos',
        'fechas_adquisicion',
        'numeros_alta',
        'contratos',
        'fechas_ultimo_movimiento',
        'numeros_movimiento',
        'matriculas',
        'nombres_usuarios',
        'tipos_resguardo',
        'numero_usuarios',
    ];

    // Puedes definir relaciones aquí, si es necesario
}

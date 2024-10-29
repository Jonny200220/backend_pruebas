<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $primaryKey = 'REGISTRO_id';
    public $timestamps = true;
    const CREATED_AT = 'REGISTRO_fecha_creacion';
    const UPDATED_AT = 'REGISTRO_fecha_ultimo_cambio';

    protected $fillable = [
        'descripcion_categoria',
        'REGISTRO_fecha_ultimo_cambio',
        'REGISTRO_en_uso'
    ];
}

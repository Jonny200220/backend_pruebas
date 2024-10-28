<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipos extends Model
{
    use HasFactory;
    protected $table = 'tipos';
    protected $primaryKey = 'REGISTRO_id';
    public $timestamps = true;
    const CREATED_AT = 'REGISTRO_fecha_creacion';
    const UPDATED_AT = 'REGISTRO_fecha_ultimo_cambio';

    protected $fillable = [
        'descripcion_tipo',
        'REGISTRO_fecha_ultimo_cambio',
        'REGISTRO_en_uso'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelos extends Model
{
    use HasFactory;
    protected $table = 'modelos';
    protected $primaryKey = 'REGISTRO_id';
    public $timestamps = true;
    const CREATED_AT = 'REGISTRO_fecha_creacion';
    const UPDATED_AT = 'REGISTRO_fecha_ultimo_cambio';

    protected $fillable = [
        'descripcion_modelo',
        'REGISTRO_fecha_ultimo_cambio',
        'REGISTRO_en_uso'
    ];
}

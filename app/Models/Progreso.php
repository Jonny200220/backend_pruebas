<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progreso extends Model
{
    use HasFactory;
    protected $table = 'progreso';
    public $timestamps = false;
    protected $primaryKey = "id";
}

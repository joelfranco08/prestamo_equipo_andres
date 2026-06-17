<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Si estás usando borrado lógico

class Equipo extends Model
{
    use HasFactory, SoftDeletes;

    // Los campos que permites que Laravel guarde masivamente desde el formulario
    protected $fillable = [
        'codigo',
        'nombre',
        'categoria',
        'marca',
        'estado', // 👈 ¡ESTE ES EL QUE TE FALTA AGREGAR!
    ];
}

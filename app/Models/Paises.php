<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Paises extends Model
{
    protected $table = 'paises';

    protected $fillable = ['cod_pais', 'nombre_pais'];

    // Aquí puedes agregar relaciones con otros modelos si es necesario
}

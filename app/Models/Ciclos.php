<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclos extends Model
{
    use HasFactory;

    protected $table = 'ciclos';

    protected $fillable = ['codigo_proceso', 'desc_proceso', 'codigo_tarea', 'desc_tarea', 'status', 'secuencia'];
}

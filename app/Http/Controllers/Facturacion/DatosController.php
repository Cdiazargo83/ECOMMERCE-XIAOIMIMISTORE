<?php

namespace App\Http\Controllers\facturacion;

use App\Http\Controllers\Controller;
use App\Models\Datos;
use Illuminate\Http\Request;

class DatosController extends Controller
{
    public function formulario()
    {
        return view('admin.facturacion.formulario');
    }

    public function mostrarDatos()
    {
        $datos = Datos::all(); // Suponiendo que tienes un modelo llamado Datos
        return view('admin.facturacion.guardar-datos', ['datos' => $datos]);
    }

}

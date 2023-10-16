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
        $datos = Datos::all();
        return view('admin.facturacion.mostrar-datos', ['datos' => $datos]);
    }

    public function guardarDatos(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:datos,email',
            // Asegúrate de ajustar las reglas de validación según tus requisitos
        ], [
            'email.unique' => 'El email ya ha sido registrado.',
        ]);

        $datos = new Datos();
        $datos->nombre = $request->input('nombre');
        $datos->email = $request->input('email');
        // Asigna otros campos según sea necesario

        try {
            $datos->save();
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al guardar los datos.');
        }

        return redirect()->route('admin.facturacion.guardar-datos')->with('success', 'Datos guardados exitosamente.');
    }
}

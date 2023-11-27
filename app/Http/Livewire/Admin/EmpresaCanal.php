<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads; // Add this line for the WithFileUploads trait
use App\Models\EmpresaCanal as ModelsEmpresaCanal;
use App\Models\PaisMoneda;
use Illuminate\Support\Facades\Storage;

class EmpresaCanal extends Component
{
    use WithFileUploads; // Include the WithFileUploads trait

    public $empresa;
    public $desc_empresa;
    public $ruc;
    public $nombre_comercial;
    public $direccion;
    public $telefono01;
    public $telefono02;
    public $correo_finanzas;
    public $correo_comercial;
    public $correo_operaciones;
    public $logo_path;
    public $pais_id;
    public $moneda_id;

    public function guardar()
    {
        $this->validate([
            'empresa' => 'required',
            'desc_empresa' => 'required',
            'ruc' => 'required',
            'direccion' => 'required',
            'telefono01' => 'required',
            'telefono02' => 'required',
            'correo_finanzas' => 'required',
            'correo_comercial' => 'required',
            'correo_operaciones' => 'required',
            'logo_path' => 'required|image|mimes:png|max:2048',
            'pais_id' => 'required',
            'moneda_id' => 'required',
        ]);

        // Store the image and get its path
        $logoPath = $this->logo_path->store('logo_path');

        ModelsEmpresaCanal::create([
            'empresa' => $this->empresa,
            'desc_empresa' => $this->desc_empresa,
            'ruc' => $this->ruc,
            'nombre_comercial' => $this->nombre_comercial,
            'direccion' => $this->direccion,
            'telefono01' => $this->telefono01,
            'telefono02' => $this->telefono02,
            'correo_finanzas' => $this->correo_finanzas,
            'correo_comercial' => $this->correo_comercial,
            'correo_operaciones' => $this->correo_operaciones,
            'logo_path' => $logoPath,
            'pais_id' => $this->pais_id,
            'moneda_id' => $this->moneda_id,
        ]);

        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->empresa = '';
        $this->desc_empresa = '';
        $this->ruc = '';
        $this->nombre_comercial = '';
        $this->direccion = '';
        $this->telefono01 = '';
        $this->telefono02 = '';
        $this->correo_finanzas = '';
        $this->correo_comercial = '';
        $this->correo_operaciones = '';
        $this->logo_path = null;
        $this->pais_id = null;
        $this->moneda_id = null;
    }

    public function render()
    {
        $empresasCanales = ModelsEmpresaCanal::with(['pais', 'moneda'])->get();
        $paises = PaisMoneda::all();

        return view('livewire.admin.empresa-canal', compact('empresasCanales', 'paises'))->layout('layouts.admin');
    }
}

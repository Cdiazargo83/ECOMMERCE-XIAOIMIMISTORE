<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Parametrizado as ModelsParametrizado;
use App\Models\EmpresaCanal;
use App\Models\CanalSubcanal;

class Parametrizacion extends Component
{
    public $canal;
    public $desc_canal;
    public $subcanal;
    public $desc_subcanal;
    public $modelo_negocio;
    public $bodega;
    public $tipo_distribucion;
    public $lp_visual;
    public $desc_lp_visual;
    public $lp_neto;
    public $desc_lp_neto;
    public $empresa_id;
    public $desc_empresa_id;
    public $canal_id;
    public $desc_canal_id;
    public $subcanal_id;
    public $desc_subcanal_id;
    public $modelo_negocio_id;
    public $bodega_id;

    public function guardar()
    {
        $this->validate([
            'canal' => 'required',
            'desc_canal' => 'required',
            'subcanal' => 'required',
            'desc_subcanal' => 'required',
            'modelo_negocio' => 'required',
            'bodega' => 'required',
            'tipo_distribucion' => 'required',
            'lp_visual' => 'required',
            'desc_lp_visual' => 'required',
            'lp_neto' => 'required',
            'desc_lp_neto' => 'required',
            'empresa_id' => 'required',
            'desc_empresa_id' => 'required',
            'canal_id' => 'required',
            'desc_canal_id' => 'required',
            'subcanal_id' => 'required',
            'desc_subcanal_id' => 'required',
            'modelo_negocio_id' => 'required',
            'bodega_id' => 'required',
        ]);

        ModelsParametrizado::create([
            'canal' => $this->canal,
            'desc_canal' => $this->desc_canal,
            'subcanal' => $this->subcanal,
            'desc_subcanal' => $this->desc_subcanal,
            'modelo_negocio' => $this->modelo_negocio,
            'bodega' => $this->bodega,
            'tipo_distribucion' => $this->tipo_distribucion,
            'lp_visual' => $this->lp_visual,
            'desc_lp_visual' => $this->desc_lp_visual,
            'lp_neto' => $this->lp_neto,
            'desc_lp_neto' => $this->desc_lp_neto,
            'empresa_id' => $this->empresa_id,
            'desc_empresa_id' => $this->desc_empresa_id,
            'canal_id' => $this->canal_id,
            'desc_canal_id' => $this->desc_canal_id,
            'subcanal_id' => $this->subcanal_id,
            'desc_subcanal_id' => $this->desc_subcanal_id,
            'modelo_negocio_id' => $this->modelo_negocio_id,
            'bodega_id' => $this->bodega_id,
        ]);

        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        // Restablecer todos los campos a sus valores iniciales
        $this->canal = '';
        $this->desc_canal = '';
        $this->subcanal = '';
        $this->desc_subcanal = '';
        $this->modelo_negocio = '';
        $this->bodega = '';
        $this->tipo_distribucion = '';
        $this->lp_visual = '';
        $this->desc_lp_visual = '';
        $this->lp_neto = '';
        $this->desc_lp_neto = '';
        $this->empresa_id = '';
        $this->desc_empresa_id = '';
        $this->canal_id = '';
        $this->desc_canal_id = '';
        $this->subcanal_id = '';
        $this->desc_subcanal_id = '';
        $this->modelo_negocio_id = '';
        $this->bodega_id = '';
    }

    public function render()
    {
        $parametrizados = ModelsParametrizado::with([
            'empresa', 'desc_empresa', 'canal', 'desc_canal', 'subcanal', 'desc_subcanal',
            'modelo_negocio', 'bodega'
        ])->get();

        $empresas = EmpresaCanal::all();
        $canales = CanalSubcanal::all();

        return view('livewire.admin.parametrizacion', compact('parametrizados', 'empresas', 'canales'))->layout('layouts.admin');
    }
}

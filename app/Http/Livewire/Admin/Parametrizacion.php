<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Parametrizado;
use App\Models\EmpresaCanal;
use App\Models\CanalSubcanal;
use App\Models\PaisMoneda;
use App\Console\Commands\MakeViewCommand;
use Illuminate\Support\Facades\Artisan;

class Parametrizacion extends Component
{
    public $empresa_id = '';
    public $desc_empresa_id = '';
    public $canal_id = '';
    public $desc_canal_id = '';
    public $subcanal_id = '';
    public $desc_subcanal_id = '';
    public $modelo_negocio_id = '';
    public $bodega_id = '';
    public $tipo_distribucion_id = '';
    public $lp_visual_id = '';
    public $desc_lp_visual_id = '';
    public $lp_neto_id = '';
    public $desc_lp_neto_id = '';
    public $idflexline_visual_id = '';
    public $idflexline_neto_id = '';
    public $simbolo_moneda_id = '';
    public $name_modelo;

    public function guardar()
    {
        $this->validate([
            'empresa_id' => 'required',
            'desc_empresa_id' => 'required',
            'simbolo_moneda_id' => 'required',
            'canal_id' => 'required',
            'desc_canal_id' => 'required',
            'subcanal_id' => 'required',
            'desc_subcanal_id' => 'required',
            'modelo_negocio_id' => 'required',
            'bodega_id' => 'required',
            'tipo_distribucion_id' => 'required',
            'lp_visual_id' => 'required',
            'desc_lp_visual_id' => 'required',
            'lp_neto_id' => 'required',
            'desc_lp_neto_id' => 'required',
            'idflexline_visual_id' => 'required',
            'idflexline_neto_id' => 'required',
            'name_modelo' => 'required'
        ]);

        $parametrizado = Parametrizado::create([
            'empresa_id' => $this->empresa_id,
            'desc_empresa_id' => $this->desc_empresa_id,
            'canal_id' => $this->canal_id,
            'desc_canal_id' => $this->desc_canal_id,
            'subcanal_id' => $this->subcanal_id,
            'desc_subcanal_id' => $this->desc_subcanal_id,
            'modelo_negocio_id' => $this->modelo_negocio_id,
            'bodega_id' => $this->bodega_id,
            'tipo_distribucion_id' => $this->tipo_distribucion_id,
            'lp_visual_id' => $this->lp_visual_id,
            'desc_lp_visual_id' => $this->desc_lp_visual_id,
            'lp_neto_id' => $this->lp_neto_id,
            'desc_lp_neto_id' => $this->desc_lp_neto_id,
            'simbolo_moneda_id' => $this->simbolo_moneda_id,
            'idflexline_visual_id' => $this->idflexline_visual_id,
            'idflexline_neto_id' => $this->idflexline_neto_id,
            'name_modelo' => $this->name_modelo
        ]);

        // Guardar el nombre del modelo en la propiedad
        $this->name_modelo = $parametrizado->name_modelo;

        // Crear la vista dinámicamente
        $nombreVista = 'livewire.admin.' . $this->name_modelo;
        Artisan::call(MakeViewCommand::class, ['name' => $nombreVista]);

        // Redirigir a la nueva vista con el nombre del modelo
        return redirect()->route('nueva_vista', ['name_modelo' => $this->name_modelo]);
    }

    private function resetInputFields()
    {
        $this->empresa_id = null;
        $this->desc_empresa_id = null;
        $this->canal_id = null;
        $this->desc_canal_id = null;
        $this->subcanal_id = null;
        $this->desc_subcanal_id = null;
        $this->modelo_negocio_id = null;
        $this->bodega_id = null;
        $this->tipo_distribucion_id = null;
        $this->lp_visual_id = null;
        $this->desc_lp_visual_id = null;
        $this->lp_neto_id = null;
        $this->desc_lp_neto_id = null;
        $this->simbolo_moneda_id = null;
        $this->idflexline_visual_id = null;
        $this->idflexline_neto_id = null;
        $this->name_modelo = null;
    }

    public function submit()
    {
        $this->guardar();
    }

    public function render()
    {
        // Recupera las relaciones necesarias para la vista
        $parametrizados = Parametrizado::with(['empresa', 'canal', 'simbolo_moneda'])->get();
        $empresas = EmpresaCanal::all();
        $canales = CanalSubcanal::all();
        $simbolo_monedas = PaisMoneda::all();

        return view('livewire.admin.parametrizacion', compact('parametrizados', 'empresas', 'canales', 'simbolo_monedas'))->layout('layouts.admin');
    }
}

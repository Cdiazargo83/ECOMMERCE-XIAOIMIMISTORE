<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\CanalSubcanal as ModelsCanalSubcanal;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CanalSubcanal extends Component
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
    public $idflexline_visual;
    public $idflexline_neto;

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
            'idflexline_visual' => 'required',
            'idflexline_neto' => 'required',
        ]);

        // Guardar en la tabla principal
        $newRecord = ModelsCanalSubcanal::create([
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
            'idflexline_visual' => $this->idflexline_visual,
            'idflexline_neto' => $this->idflexline_neto,
        ]);

        // Add a new column to the 'products' table
        $this->addNewColumnToProductsTable($this->bodega);

        $this->resetInputFields();
    }

    private function addNewColumnToProductsTable($columnName)
    {
        // Clean the column name (remove numbers and signs)
        $cleanColumnName = preg_replace('/[^a-zA-Z]/', '', $columnName);

        // Convert to lowercase
        $cleanColumnName = strtolower($cleanColumnName);

        // Assuming you have a 'products' table, update it to add a new column
        Schema::table('products_saco', function (Blueprint $table) use ($cleanColumnName) {
            $table->string($cleanColumnName)->nullable();
        });

        // You might want to update existing records in the 'products' table based on your logic
    }

    private function resetInputFields()
    {
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
        $this->idflexline_visual = '';
        $this->idflexline_neto = '';
    }

    public function render()
    {
        $canalSubcanales = ModelsCanalSubcanal::all();

        return view('livewire.admin.canal-subcanal', compact('canalSubcanales'))->layout('layouts.admin');
    }
}

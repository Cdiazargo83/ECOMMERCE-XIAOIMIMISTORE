<?php

namespace App\Http\Livewire\Admin;

use App\Models\PaisMoneda as ModelsPaisMoneda;
use Livewire\Component;

class PaisMoneda extends Component
{
    public $pais;
    public $desc_pais;
    public $moneda;
    public $desc_moneda;
    public $simbolo_moneda;

    public function guardar()
    {
        $this->validate([
            'pais' => 'required|in:PE,EC,US',
            'desc_pais' => 'required|in:Perú,Ecuador,United State',
            'moneda' => 'required|in:PEN,USD',
            'simbolo_moneda' => 'required|in:$,S/',
            'desc_moneda' => 'required',

        ]);

        ModelsPaisMoneda::create([
            'pais' => $this->pais,
            'desc_pais' => $this->desc_pais,
            'moneda' => $this->moneda,
            'desc_moneda' => $this->desc_moneda,
            'simbolo_moneda' => $this->simbolo_moneda,
        ]);

        $this->resetInputFields();
    }

    public function submit()
    {
        $this->guardar();

    }

    private function resetInputFields()
    {
        $this->pais = '';
        $this->desc_pais = '';
        $this->moneda = '';
        $this->desc_moneda = '';
        $this->simbolo_moneda = '';
    }

    public function render()
    {
        $paisesMonedas = ModelsPaisMoneda::all();
        return view('livewire.admin.pais-moneda', compact('paisesMonedas'))->layout('layouts.admin');
    }
}

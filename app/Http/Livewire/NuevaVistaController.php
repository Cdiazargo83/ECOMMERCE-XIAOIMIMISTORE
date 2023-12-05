<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class NuevaVistaController extends Component
{
    public $name_modelo;

    public function mount($name_modelo)
    {
        $this->name_modelo = $name_modelo;
    }

    public function render()
    {
        return view('livewire.admin.' . $this->name_modelo);
    }
}

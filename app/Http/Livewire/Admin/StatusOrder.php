<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Image;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class StatusOrder extends Component
{
    use WithFileUploads;

    public $order, $status, $courrier,
    $tracking_number, $guia_remision,
    $alto_paquete, $ancho_paquete,$largo_paquete,
    $peso_paquete,$observacion, $rand;

    public $editImage;

    public $createForm =[
        'status' => null,
        'image' => null,
    ];

    public $editForm =[
        'status' => null,
        'image' => null,
    ];

    public $rules = [
        'courrier' => 'required',
        'tracking_number' => 'required',
        'guia_remision' => 'required',
    ];

    public function files(Order $order, Request $request){

        $request->validate([
            'file' => 'required|image|max:4048'
        ]);

        $url = Storage::put('orders', $request->file('file'));

        $order->images()->create([

            'url' => $url
        ]);

    }

    public function mount(){


        $this->status = $this->order->status;
        $this->courrier = $this->order->courrier;
        $this->tracking_number = $this->order->tracking_number;
        $this->guia_remision = $this->order->guia_remision;

        $this->alto_paquete = $this->order->alto_paquete;
        $this->ancho_paquete = $this->order->ancho_paquete;
        $this->largo_paquete = $this->order->largo_paquete;
        $this->peso_paquete = $this->order->peso_paquete;
        $this->observacion = $this->order->observacion;

    }

    public function save(){
        $this->emit('saved');
    }

    public function update(){

       $this->order->status = $this->status;
       $this->order->courrier = $this->courrier;
       $this->order->tracking_number = $this->tracking_number;
       $this->order->guia_remision = $this->guia_remision;

       $this->order->alto_paquete = $this->alto_paquete;
       $this->order->ancho_paquete = $this->ancho_paquete;
       $this->order->largo_paquete = $this->largo_paquete;
       $this->order->peso_paquete = $this->peso_paquete;
       $this->order->observacion = $this->observacion;

        $this->order->save();
    }

    public function render(){
        $items = json_decode($this->order->content);

        return view('livewire.admin.status-order', compact('items'));
    }
}

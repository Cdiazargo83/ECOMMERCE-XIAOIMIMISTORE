<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;
use App\Models\Department;
use App\Models\District;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;

class CreateOrder extends Component
{

    public $envio_type = 1;
    public $tipo_doc = 3;
    public $contact, $phone, $address, $references, $shipping_cost = 0, $dni, $ruc, $razon_social, $direccion_fiscal;
    public $departments, $cities = [], $districts = [];
    public $department_id = "", $city_id = "", $district_id = "";
    public  $atocong, $jockeypz, $megaplz, $huaylas, $puruchu;
    public $selectedStore = '';

    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'envio_type' => 'required',
        'dni' => 'required'
    ];

    public function mount()
    {
        $this->departments = Department::all();
    }

    public function updatedEnvioType($value)
    {
        if ($value == 1) {
            $this->resetValidation([
                'department_id',
                'city_id',
                'district_id',
                'address',
                'references',
            ]);
        }
    }
    public function updatedDepartmentId($value)
    {
        $this->cities = City::where('department_id', $value)->get();
    }

    public function updatedCityId($value)
    {

        $city = City::find($value);

        $this->shipping_cost = $city->cost;
        $this->districts = District::where('city_id', $value)->get();
    }

    public function create_order()
    {
        $rules = $this->rules;

        if ($this->envio_type == 2) {
            $rules['department_id'] = 'required';
            $rules['city_id'] = 'required';
            $rules['district_id'] = 'required';
            $rules['address'] = 'required';
            $rules['references'] = 'required';
        }

        $this->validate($rules);

        $order = new Order();

 	    $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->dni = $this->dni;
        $order->tipo_doc =  $this->tipo_doc;
        $order->ruc = $this->ruc;
        $order->razon_social = $this->razon_social;

        $order->envio_type = $this->envio_type;
        $order->shipping_cost = 0;
        $order->total = $this->shipping_cost + Cart::subtotal(2, '.', '');

        $order->content = Cart::content();

        if ($this->envio_type == 2) {
            // Código existente para envío_type igual a 2

            $order->shipping_cost = $this->shipping_cost;
            $order->department_id = $this->department_id;
            $order->city_id = $this->city_id;
            $order->district_id = $this->district_id;
            $order->address = $this->address;
            $order->references = $this->references;
        } elseif ($this->envio_type == 1) {
            // Código específico para envío_type igual a 1

            // Agrega tu lógica específica para envío_type igual a 1 aquí
            $order->atocong = $this->atocong;
            $order->jockeypz = $this->jockeypz;
            $order->megaplz = $this->megaplz;
            $order->huaylas = $this->huaylas;
            $order->puruchu = $this->puruchu;
        }

        $order->save();

        foreach (Cart::content() as $item) {
            discount($item);
        }

        Cart::destroy();

        //dd($order);

        return redirect()->route('orders.payment', $order);
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}

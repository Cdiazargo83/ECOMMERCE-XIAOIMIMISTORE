<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;
use App\Models\Department;
use App\Models\District;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;


class CreateOrder extends Component
{
    public $envio_type = 1;
    public $tipo_doc = 2;
    public $contact, $phone, $address, $references, $shipping_cost = 0, $dni, $ruc, $razon_social, $direccion_fiscal;
    public $departments, $cities = [], $districts = [];
    public $department_id = "", $city_id = "", $district_id = "";
    public  $atocong, $jockeypz, $megaplz, $huaylas, $puruchu;

    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'envio_type' => 'required',
        'dni' => 'required',
        'tipo_doc' => 'required',
        'ruc' => 'required',
        'razon_social' => 'required',
        'direccion_fiscal' => 'required'

    ];

    public $itemQty;
    public $stores;

    public $selectedStore = '';
    public $filteredStores = [];


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
        $this->reset('district_id');
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
        $order->direccion_fiscal = $this->direccion_fiscal;
        $order->envio_type = $this->envio_type;
        $order->shipping_cost = 0;
        $order->total = $this->shipping_cost + Cart::subtotal(2, '.', '');

        $order->content = Cart::content();

        if ($this->envio_type == 2) {
            $order->shipping_cost = $this->shipping_cost;
            $order->department_id = $this->department_id;
            $order->city_id = $this->city_id;
            $order->district_id = $this->district_id;
            $order->address = $this->address;
            $order->references = $this->references;

        } elseif ($this->envio_type == 1) {
            // Si envio_type es igual a 1, almacenar la selección en el array
            $selection = [
                'atocong' => 1,
                'jockeypz' => 2,
                'megaplz' => 3,
                'huaylas' => 4,
                'puruchu' => 5,
            ];
            // Asegúrate de establecer valores para cada campo en el objeto $order
            $order->atocong = $selection['atocong'];
            $order->jockeypz = $selection['jockeypz'];
            $order->megaplz = $selection['megaplz'];
            $order->huaylas = $selection['huaylas'];
            $order->puruchu = $selection['puruchu'];
        }

        $order->content = json_encode($selection);

        $order->save();

        foreach (Cart::content() as $item) {
            discount($item);
        }

        Cart::destroy();


        return redirect()->route('order.payment', $order);
    }

    public function render()
    {
        $this->filteredStores = [];

        $products = Product::all();


        $index = 0;

        foreach (['atocong', 'jockeypz', 'megaplz', 'huaylas', 'puruchu'] as $storeColumn) {
            $storeName = 'Tienda ' . ($index + 1); // Nombre de tienda
            $showOption = true; // Inicialmente, mostrar la opción

            foreach (Cart::content() as $item) {
                // Verificar si el producto del carrito tiene un valor mayor que $item->qty en la columna de tienda actual
                if ($item->options->has($storeColumn) && $item->options->$storeColumn > $item->qty) {
                    $showOption = false; // No mostrar la opción si el valor es mayor
                    break; // Salir del bucle si no se cumple la condición
                }
            }

            if ($showOption) {
                $this->filteredStores[$storeColumn] = $storeName;
            }

            $index++; // Incrementamos el contador
        }

        // Renderiza la vista con las tiendas filtradas

        return view('livewire.create-order', compact('products', 'item'));
    }
}

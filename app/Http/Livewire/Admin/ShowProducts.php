<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

use Livewire\WithPagination;

class ShowProducts extends Component
{

    use WithPagination;

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {

       // $bodega = Http::get('https://jsonplaceholder.typicode.com/');
       // $bodegaArray = $bodega->json();

        $products = Product::where('name', 'like','%'. $this->search.'%')->paginate(10);

        return view('livewire.admin.show-products', compact('products'))->layout('layouts.admin');
    }

}

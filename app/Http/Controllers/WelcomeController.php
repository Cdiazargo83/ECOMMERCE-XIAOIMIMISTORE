<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Promocion;

class WelcomeController extends Controller
{
    //
    public function __invoke()
    {

        if (auth()->user()) {
            $reservado =   Order::where('status', 1)->where('user_id',auth()->user()->id)->count();

            if ($reservado) {

                $mensaje = "Usted tiene $reservado ordenes reservadas. <a class='font-bold href='" . route('orders.index') ."?status=1'>Ir a pagar</a>";

                session()->flash('flash.banner', $mensaje);
            }
        }

       // session()->flash('flash.bannerStyle','danger');

        $categories = Category::all();
        $banners = Banner::OrderBy('id','asc')->get();
        $promocions = Promocion::OrderBy('id','asc')->get();


        return view('welcome', compact('categories','banners','promocions'));
    }
}

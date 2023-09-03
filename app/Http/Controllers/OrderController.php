<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Return_;


class OrderController extends Controller
{

    public function index(){

        $orders = Order::query()->where('user_id',auth()->user()->id);

        if (request('status')) {
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        $reservado =       Order::where('status', 1)->where('user_id',auth()->user()->id)->count();
        $pagado        =   Order::where('status', 2)->where('user_id',auth()->user()->id)->count();
        $despachado   =    Order::where('status', 3)->where('user_id',auth()->user()->id)->count();
        $entregado   =     Order::where('status', 4)->where('user_id',auth()->user()->id)->count();
        $anulado   =       Order::where('status', 5)->where('user_id',auth()->user()->id)->count();

            return view('orders.index',compact('orders','reservado','pagado','despachado','entregado','anulado'));

    }
    public function show(Order $order){

        $this->authorize('author', $order);
        $items = json_decode($order->content);
       // $order = Order::all('id');
      // dd($order);
           return view('orders.show', compact('order','items'));
    }
    public function payment(Order $order){

        $this->authorize('author', $order);

        $authorization = base64_encode(config('services.izipay.client_id') . ':' . config('services.izipay.client_secret')) ;

        $formToken = Http::withHeaders([
            'Authorization' => 'Basic' . $authorization,
            'Accept' => 'application/json',

        ])->post(config('services.izipay.url'), [

            'amount' => $order->total * 100 ,
            'currency' => 'USD',
            'orderId' => $order->id,
            'customer' => [
                'reference' => auth()->id(),
                'email' => auth()->user()->email,
                'billingDetails' => [
                    'firstName' => auth()->user()->name,
                ]
            ]
        ])->object()->answer->formToken;

         $items = json_decode($order->content);

        return view('orders.payment', compact('order','items','formToken'));
    }

}

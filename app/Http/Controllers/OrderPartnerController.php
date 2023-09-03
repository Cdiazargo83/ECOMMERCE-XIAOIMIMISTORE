<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderPartner;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Return_;

class OrderPartnerController extends Controller
{

    public function index(){

        $order_partners = OrderPartner::query()->where('user_id',auth()->user()->id);

        if (request('status')) {
            $order_partners->where('status', request('status'));
        }

        $orders = $order_partners->get();

        $reservado =       OrderPartner::where('status', 1)->where('user_id',auth()->user()->id)->count();
        $pagado        =   OrderPartner::where('status', 2)->where('user_id',auth()->user()->id)->count();
        $despachado   =    OrderPartner::where('status', 3)->where('user_id',auth()->user()->id)->count();
        $entregado   =     OrderPartner::where('status', 4)->where('user_id',auth()->user()->id)->count();
        $anulado   =       OrderPartner::where('status', 5)->where('user_id',auth()->user()->id)->count();

            return view('orderpartners.index',compact('order_partners','reservado','pagado','despachado','entregado','anulado'));

    }


    public function show(OrderPartner $order_partner){

        $this->authorize('authorpartner', $order_partner);
        $items = json_decode($order_partner->content);
       // $order = Order::all('id');
      //   dd($order);
           return view('orderpartners.show', compact('order_partner','items'));
    }
    public function payment(OrderPartner $order_partner){

        $this->authorize('authorpartner', $order_partner);

        $authorization = base64_encode(config('services.izipay.client_id') . ':' . config('services.izipay.client_secret')) ;

        $formToken = Http::withHeaders([
            'Authorization' => 'Basic' . $authorization,
            'Accept' => 'application/json',

        ])->post(config('services.izipay.url'), [

            'amount' => $order_partner->total * 100 ,
            'currency' => 'USD',
            'orderId' => $order_partner->id,
            'customer' => [
                'reference' => auth()->id(),
                'email' => auth()->user()->email,
                'billingDetails' => [
                    'firstName' => auth()->user()->name,
                ]
            ]
        ])->object()->answer->formToken;

         $items = json_decode($order_partner->content);

         return view('orderpartners.payment', compact('order_partner','items','formToken'));
    }

}

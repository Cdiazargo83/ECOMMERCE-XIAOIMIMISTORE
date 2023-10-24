<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;

        $orders = Order::where('user_id', $userId);

        if (request()->has('status')) {
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        $reservado = Order::where('status', 1)->where('user_id', $userId)->count();
        $pagado = Order::where('status', 2)->where('user_id', $userId)->count();
        $despachado = Order::where('status', 3)->where('user_id', $userId)->count();
        $entregado = Order::where('status', 4)->where('user_id', $userId)->count();
        $anulado = Order::where('status', 5)->where('user_id', $userId)->count();

        return view('orders.index', compact('orders', 'reservado', 'pagado', 'despachado', 'entregado', 'anulado'));
    }

    public function show(Order $order)
    {
        $this->authorize('author', $order);
        $items = json_decode($order->content);

        //dd($order);

        return view('orders.show', compact('order', 'items'));
    }

    public function payment(Order $order)
    {
        $this->authorize('author', $order);

        try {
            $authorization = base64_encode(config('services.izipay.client_id') . ':' . config('services.izipay.client_secret'));
            //dd($authorization);

            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $authorization,
                'Accept' => 'application/json',
            ])->post(config('services.izipay.url'), [
                'amount' => $order->total * 100,
                'currency' => 'USD',
                'orderId' => $order->id,
                'customer' => [
                    'reference' => auth()->id(),
                    'email' => auth()->user()->email,
                    'billingDetails' => [
                        'firstName' => auth()->user()->name,
                    ],
                ],
            ])->json();

            // Verificar si 'formToken' está presente en la respuesta
            if (isset($response['answer']['formToken'])) {
                $formToken = $response['answer']['formToken'];
            } else {
                // Manejo de errores si 'formToken' no está presente
                return redirect()->back()->with('error', 'Error al obtener el formToken');
            }
        } catch (\Exception $e) {
            // Manejo de excepciones: Registro de errores, redirección o respuesta de error al usuario.
            // Puedes agregar código para manejar la excepción aquí.
            return redirect()->back()->with('error', 'Error en la solicitud HTTP');
        }

        $items = json_decode($order->content);

        return view('orders.payment', compact('order', 'items', 'formToken'));
    }
}

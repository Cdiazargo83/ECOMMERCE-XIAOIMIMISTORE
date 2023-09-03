<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Queue\Listener;

class PaidController extends Controller
    {

        public function izipay(Order $order,Request $request){


        $answer = json_decode($request->get("kr-answer"));
        $orderDetails = $answer->orderDetails;

        $orderId = $orderDetails->orderId;
        $order= Order::findOrFail($orderId);
            $uptadestatus = $answer->orderStatus;

        if($uptadestatus == 'PAID'){

        $order->status = 2;

            $order->save();
        }

        return redirect()->route('orders.show', $order);
        }
    }

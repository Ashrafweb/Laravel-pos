<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order ;

class DashboardController extends Controller
{
    public function index()
    { 
        $orders = Order::all();
        $total_paid = 0 ;
        $due = 0;
        $pending_orders = 0 ;
        $success_orders = 0 ;
        foreach($orders as $order)
        {
            $total_paid = $total_paid + $order->paid ;
            $due= $due + $order->due;
            if($order->order_status=="pending"){
                $pending_orders = $pending_orders + 1 ;
            }elseif($order->order_status=="success"){
                $success_orders = $success_orders + 1 ;
            };
            
        }
        //dd($pending_orders);
        return view('dashboard')->with(compact('total_paid','success_orders','pending_orders'));
    }
}

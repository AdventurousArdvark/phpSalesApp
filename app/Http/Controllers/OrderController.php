<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller{
    public function index(){
        $orders = Order::with('customer')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order){
        $order->load('customer', 'orderLines.item');

        return view('orders.show', compact('order'));
    }
}
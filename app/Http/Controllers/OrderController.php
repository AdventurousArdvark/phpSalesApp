<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller{
    public function index(){
        $query = Order::with('customer');

        if (request('status')) {
            $query->status(request('status'));
        }

        if (request('search')) {
            $search = request('search');
            $query->where('order_number', 'like', "%{$search}%")
                ->orWhereHas('customer', function ($q) use ($search) {
                    $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);
    
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order){
        $order->load('customer', 'orderLines.item');

        return view('orders.show', compact('order'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderLine;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller{
    protected $cartService;

    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
    }

    public function index(){
        $cart = $this->cartService->getCartWithItems();

        if ($cart->cartLines->isEmpty()){
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $customers = Customer::orderBy('last_name')->get();

        return view('checkout.index', compact('cart', 'customers'));
    }

    public function store(Request $request){
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
        ]);

        $cart = $this->cartService->getCartWithItems();

        if ($cart->cartLines->isEmpty()){
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        try {
            $order = DB::transaction(function () use ($request, $cart) {
                $subtotal = 0;

                $order = Order::create([
                    'customer_id' => $request->customer_id,
                    'order_number' => Order::generateOrderNumber(),
                    'status' => 'pending',
                    'subtotal' => 0,
                    'tax' => 0,
                    'total' => 0,
                    'order_date' => now(),
                ]);

                foreach ($cart->cartLines as $line) {
                    $unitPrice = $line->item->price;
                    $lineTotal = $unitPrice * $line->quantity;
                    $subtotal += $lineTotal;

                    OrderLine::create([
                        'order_id' => $order->id,
                        'item_id' => $line->item->id,
                        'quantity' => $line->quantity,
                        'unit_price' => $unitPrice,
                        'line_total' => $lineTotal,
                    ]);

                    $line->item->decrement('quantity', $line->quantity);
                }

                $tax = round($subtotal * 0.08, 2);
                $order->update([
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $subtotal + $tax,
                ]);

                $this->cartService->clear();

                return $order;
            });

            return redirect()->route('orders.show', $order)
                ->with('success', "Order {$order->order_number} created successfully.");
        } catch (\Exception $e) {
            return redirect()->route('checkout.index')
                ->with('error', 'Something went wrong during checkout. Please try again.');
        }
    }
}
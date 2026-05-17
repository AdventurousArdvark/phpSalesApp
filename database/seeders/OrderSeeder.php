<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder{
    public function run(): void{
        $customers = Customer::all();
        $items = Item::all();

        foreach ($customers->random(5) as $customer) {
            $order = Order::create([
                'customer_id' => $customer->id,
                'order_number' => Order::generateOrderNumber(),
                'status' => fake()->randomElement(['pending', 'processing', 'completed', 'cancelled']),
                'subtotal' => 0,
                'tax' => 0,
                'total' => 0,
                'order_date' => fake()->dateTimeBetween('-30 days', 'now'),
            ]);

            $subtotal = 0;
            $orderItems = $items->random(rand(1, 5));

            foreach ($orderItems as $item) {
                $quantity = rand(1, 3);
                $unitPrice = $item->price;
                $lineTotal = $unitPrice * $quantity;
                $subtotal += $lineTotal;

                OrderLine::create([
                    'order_id' => $order->id,
                    'item_id' => $item->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $lineTotal,
                ]);
            }

            $tax = round($subtotal * 0.08, 2);
            $order->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $subtotal + $tax,
            ]);
        }
    }
}
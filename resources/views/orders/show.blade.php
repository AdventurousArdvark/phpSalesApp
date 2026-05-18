<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Order {{ $order->order_number }}</h2>

    </x-slot>

 

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @include('partials.flash')

 

                <div class="grid grid-cols-2 gap-6 mb-6">

                    <div>

                        <h3 class="font-semibold mb-2">Order Details</h3>

                        <p><span class="text-gray-500">Order #:</span> {{ $order->order_number }}</p>

                        <p><span class="text-gray-500">Date:</span> {{ $order->order_date->format('M d, Y') }}</p>

                        <p><span class="text-gray-500">Status:</span>

                            <span class="px-2 py-1 text-xs rounded-full

                                @if($order->status === 'completed') bg-green-100 text-green-800

                                @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800

                                @elseif($order->status === 'processing') bg-blue-100 text-blue-800

                                @else bg-red-100 text-red-800

                                @endif">

                                {{ ucfirst($order->status) }}

                            </span>

                        </p>

                    </div>

                    <div>

                        <h3 class="font-semibold mb-2">Customer</h3>

                        <p>{{ $order->customer->full_name }}</p>

                        <p class="text-gray-500">{{ $order->customer->email }}</p>

                        <p class="text-gray-500">{{ $order->customer->phone }}</p>

                    </div>

                </div>

 

                <h3 class="font-semibold mb-2">Order Lines</h3>

                <table class="min-w-full divide-y divide-gray-200 mb-6">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item</th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit Price</th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Line Total</th>

                        </tr>

                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($order->orderLines as $line)

                            <tr>

                                <td class="px-6 py-4">{{ $line->item->name }}</td>

                                <td class="px-6 py-4">{{ $line->item->sku }}</td>

                                <td class="px-6 py-4">{{ $line->formatted_unit_price }}</td>

                                <td class="px-6 py-4">{{ $line->quantity }}</td>

                                <td class="px-6 py-4">{{ $line->formatted_line_total }}</td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

 

                <div class="text-right border-t pt-4">

                    <p class="text-gray-600">Subtotal: ${{ number_format($order->subtotal, 2) }}</p>

                    <p class="text-gray-600">Tax: ${{ number_format($order->tax, 2) }}</p>

                    <p class="text-lg font-semibold">Total: {{ $order->formatted_total }}</p>

                </div>

 

                <div class="mt-6">

                    <a href="{{ route('orders.index') }}"

                       class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">

                        Back to Orders

                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
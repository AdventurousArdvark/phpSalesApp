<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Customer Details</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-bold">{{ $customer->full_name }}</h3>
                    <p class="text-gray-500">{{ $customer->email }}</p>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <span class="text-sm text-gray-500">Phone</span>
                        <p>{{ $customer->phone ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">Address</span>
                        <p>{{ $customer->address ?? 'N/A' }}</p>
                        <p>{{ $customer->city }}, {{ $customer->state }} {{ $customer->zip }}</p>
                    </div>
                </div>
                @if ($customer->orders->count())
                    <div class="mb-6">
                        <h4 class="font-semibold mb-2">Order History</h4>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order #</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($customer->orders as $order)
                                    <tr>
                                        <td class="px-6 py-4">{{ $order->order_number }}</td>
                                        <td class="px-6 py-4">{{ $order->order_date->format('M d, Y') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 text-xs rounded-full
                                                @if($order->status === 'completed') bg-green-100 text-green-800
                                                @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">{{ $order->formatted_total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                <div class="flex gap-2">
                    <a href="{{ route('customers.edit', $customer) }}"
                       class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Edit</a>
                    <a href="{{ route('customers.index') }}"
                       class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
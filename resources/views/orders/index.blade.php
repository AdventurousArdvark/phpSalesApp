<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sales Orders</h2>

    </x-slot>

 

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @include('partials.flash')

 

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order #</th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>

                        </tr>

                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse ($orders as $order)

                            <tr>

                                <td class="px-6 py-4">{{ $order->order_number }}</td>

                                <td class="px-6 py-4">{{ $order->customer->full_name }}</td>

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

                                <td class="px-6 py-4">

                                    <a href="{{ route('orders.show', $order) }}" class="text-blue-600 hover:underline">View</a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No orders found.</td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

 

                <div class="mt-4">

                    {{ $orders->links() }}

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
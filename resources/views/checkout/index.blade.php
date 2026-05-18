<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Checkout</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @include('partials.flash')
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-4">Order Summary</h3>
                    <table class="min-w-full divide-y divide-gray-200 mb-4">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Line Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($cart->cartLines as $line)
                                <tr>
                                    <td class="px-6 py-4">{{ $line->item->name }}</td>
                                    <td class="px-6 py-4">{{ $line->item->formatted_price }}</td>
                                    <td class="px-6 py-4">{{ $line->quantity }}</td>
                                    <td class="px-6 py-4">{{ $line->formatted_line_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-right">
                        <p class="text-gray-600">Subtotal: {{ $cart->formatted_subtotal }}</p>
                        <p class="text-gray-600">Tax (8%): ${{ number_format($cart->subtotal * 0.08, 2) }}</p>
                        <p class="text-lg font-semibold">Total: ${{ number_format($cart->subtotal * 1.08, 2) }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('checkout.store') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Select Customer
                        </label>
                        <select name="customer_id" id="customer_id"
                                class="block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">-- Select a Customer --</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->full_name }} ({{ $customer->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                                class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600"
                                onclick="return confirm('Place this order?')">
                            Place Order
                        </button>
                        <a href="{{ route('cart.index') }}"
                           class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                            Back to Cart
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
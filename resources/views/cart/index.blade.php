<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Shopping Cart</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @include('partials.flash')
                @if ($cart->cartLines->count())
                    <table class="min-w-full divide-y divide-gray-200 mb-6">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Line Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($cart->cartLines as $line)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div>{{ $line->item->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $line->item->sku }}</div>
                                    </td>
                                    <td class="px-6 py-4">{{ $line->item->formatted_price }}</td>
                                    <td class="px-6 py-4">
                                        <form method="POST" action="{{ route('cart.update', $line) }}" class="flex gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $line->quantity }}"
                                                   min="0" max="{{ $line->item->quantity }}"
                                                   class="w-20 rounded-md border-gray-300 shadow-sm">
                                            <button type="submit"
                                                    class="text-blue-600 hover:underline text-sm">
                                                Update
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4">{{ $line->formatted_line_total }}</td>
                                    <td class="px-6 py-4">
                                        <form method="POST" action="{{ route('cart.remove', $line) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex justify-between items-center border-t pt-4">
                        <div>
                            <span class="text-lg font-semibold">Subtotal: {{ $cart->formatted_subtotal }}</span>
                        </div>
                        <div class="flex gap-2">
                            <form method="POST" action="{{ route('cart.clear') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600"
                                        onclick="return confirm('Clear entire cart?')">
                                    Clear Cart
                                </button>
                            </form>
                            <a href="{{ route('checkout.index') }}"
                            class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                Checkout
                            </a>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-gray-500 mb-4">Your cart is empty.</p>
                        <a href="{{ route('items.index') }}"
                           class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Browse Items
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Item Details</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-bold">{{ $item->name }}</h3>
                    <p class="text-gray-500">{{ $item->sku }}</p>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <span class="text-sm text-gray-500">Price</span>
                        <p class="text-lg">{{ $item->formatted_price }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-500">Quantity in Stock</span>
                        <p class="text-lg">{{ $item->quantity }}</p>
                    </div>
                </div>
                @if ($item->description)
                    <div class="mb-6">
                        <span class="text-sm text-gray-500">Description</span>
                        <p>{{ $item->description }}</p>
                    </div>
                @endif
                <div class="flex gap-2">
                    <a href="{{ route('items.edit', $item) }}"
                       class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Edit</a>
                    <a href="{{ route('items.index') }}"
                       class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
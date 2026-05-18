<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Customers</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @include('partials.flash')
                <div class="flex justify-between mb-6">
                    <form method="GET" action="{{ route('customers.index') }}" class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Search customers..."
                               class="rounded-md border-gray-300 shadow-sm">
                        <button type="submit"
                                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                            Search
                        </button>
                    </form>
                    <a href="{{ route('customers.create') }}"
                       class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Add Customer
                    </a>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">City</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($customers as $customer)
                            <tr>
                                <td class="px-6 py-4">{{ $customer->full_name }}</td>
                                <td class="px-6 py-4">{{ $customer->email }}</td>
                                <td class="px-6 py-4">{{ $customer->phone }}</td>
                                <td class="px-6 py-4">{{ $customer->city }}, {{ $customer->state }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('customers.show', $customer) }}" class="text-blue-600 hover:underline">View</a>
                                    <a href="{{ route('customers.edit', $customer) }}" class="text-yellow-600 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('customers.destroy', $customer) }}"
                                          onsubmit="return confirm('Delete this customer?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No customers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
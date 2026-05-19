<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Page Not Found</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <h3 class="text-4xl font-bold text-gray-300 mb-4">404</h3>
                <p class="text-gray-500 mb-6">The page you're looking for doesn't exist.</p>
                <a href="{{ route('dashboard') }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
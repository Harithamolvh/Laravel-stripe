<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <section class="container mx-auto px-4 max-w-7xl">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">All Products</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($products as $product)
            <div class="product-card bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=300&h=200&fit=crop" 
                         alt="{{ $product->name }}" 
                         class="product-image w-full h-48 object-cover">
                    <div class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                        Sale
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ $product->description }}</p>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-2xl font-bold text-gray-900">${{ $product->price }}</span>
                        </div>
                    </div>
                    <a href="{{ route('product.show', $product->id) }}" class="add-to-cart-btn w-full bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-lg font-medium shadow-md transition">
                        Buy Now
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    </div>
   
</x-app-layout>

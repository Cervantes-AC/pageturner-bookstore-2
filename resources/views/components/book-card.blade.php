@props(['book'])
<div class="card-hover group animate-fade-in">
    <div class="relative h-56 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center overflow-hidden">
        @if($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}"
                 alt="{{ $book->title }}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="text-7xl group-hover:scale-110 transition-transform duration-300">📖</div>
        @endif
        @if($book->is_featured ?? false)
            <div class="absolute top-3 right-3">
                <span class="badge bg-gradient-to-r from-accent-500 to-accent-600 text-white shadow-lg">Featured</span>
            </div>
        @endif
    </div>
    <div class="p-5">
        <h3 class="font-semibold text-lg text-gray-900 truncate group-hover:text-primary-600 transition-colors">{{ $book->title }}</h3>
        <p class="text-gray-600 text-sm mt-1">by {{ $book->author }}</p>
        <p class="text-primary-600 font-bold text-xl mt-3">₱{{ number_format($book->price, 2) }}</p>
        <div class="flex items-center mt-2">
            @for($i = 1; $i <= 5; $i++)
                <svg class="w-4 h-4 {{ $i <= round($book->average_rating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
            @endfor
            <span class="ml-2 text-sm text-gray-500">({{ $book->reviews->count() }})</span>
        </div>
        <a href="{{ route('books.show', $book) }}"
           class="mt-4 block text-center btn-primary w-full">
            View Details
        </a>
        @auth
            @if($book->stock_quantity > 0)
                <form action="{{ route('cart.add', $book) }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="w-full btn-outline text-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Add to Cart
                    </button>
                </form>
            @else
                <div class="mt-2 text-center badge-danger w-full py-2">Out of Stock</div>
            @endif
        @endauth
    </div>
</div>
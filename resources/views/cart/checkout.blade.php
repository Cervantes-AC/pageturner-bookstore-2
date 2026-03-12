@extends('layouts.app')
@section('title', 'Checkout - PageTurner')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Checkout</h1>
        <p class="text-gray-600 mt-2">Complete your order</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="card p-8 animate-slide-up">
                <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Shipping Information
                </h2>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    @foreach($items as $index => $item)
                        <input type="hidden" name="items[{{ $index }}][book_id]" value="{{ $item['book_id'] }}">
                        <input type="hidden" name="items[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
                    @endforeach

                    <div class="space-y-5 mb-8">
                        <div>
                            <label for="shipping_name" class="block text-gray-700 font-medium mb-2">Full Name *</label>
                            <input type="text" id="shipping_name" name="shipping_name" 
                                   value="{{ old('shipping_name', auth()->user()->name) }}" 
                                   required
                                   class="input-field">
                            @error('shipping_name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="shipping_phone" class="block text-gray-700 font-medium mb-2">Phone Number *</label>
                            <input type="tel" id="shipping_phone" name="shipping_phone" 
                                   value="{{ old('shipping_phone') }}" 
                                   required
                                   placeholder="+1234567890"
                                   class="input-field">
                            @error('shipping_phone')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="shipping_address" class="block text-gray-700 font-medium mb-2">Shipping Address *</label>
                            <textarea id="shipping_address" name="shipping_address" 
                                      rows="4" 
                                      required
                                      placeholder="Street address, City, State, ZIP Code, Country"
                                      class="input-field">{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('cart.index') }}" class="btn-secondary flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Cart
                        </a>
                        <button type="submit" class="btn-primary flex-1 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Place Order
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="card p-6 sticky top-24 animate-fade-in">
                <h3 class="text-xl font-bold mb-6 text-gray-900">Order Summary</h3>
                <div class="space-y-4 mb-6 pb-6 border-b border-gray-200">
                    @foreach($cartItems as $item)
                        <div class="flex justify-between items-start gap-3">
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-gray-900 text-sm truncate">{{ $item['book']->title }}</p>
                                <p class="text-xs text-gray-600 mt-0.5">Qty: {{ $item['quantity'] }} × ₱{{ number_format($item['book']->price, 2) }}</p>
                            </div>
                            <p class="font-semibold text-gray-900 text-sm">₱{{ number_format($item['subtotal'], 2) }}</p>
                        </div>
                    @endforeach
                </div>
                
                <div class="space-y-2 mb-6 pb-6 border-b border-gray-200">
                    <div class="flex justify-between text-gray-600 text-sm">
                        <span>Subtotal</span>
                        <span class="font-medium text-gray-900">₱{{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600 text-sm">
                        <span>Shipping</span>
                        <span class="font-medium text-green-600">Free</span>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="font-bold text-lg text-gray-900">Total</span>
                    <span class="font-bold text-2xl text-primary-600">₱{{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

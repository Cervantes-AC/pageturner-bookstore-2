@extends('layouts.app')
@section('title', 'My Orders - PageTurner')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8 animate-fade-in">
        <h1 class="text-4xl font-bold text-gray-900">
            {{ auth()->user()->isAdmin() ? 'All Orders' : 'My Orders' }}
        </h1>
        <p class="text-gray-600 mt-2">View and manage your order history</p>
    </div>

    @forelse($orders as $order)
        <div class="card p-6 mb-4 hover:shadow-lg transition-all animate-slide-up group">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <p class="font-bold text-xl text-gray-900">Order #{{ $order->id }}</p>
                        @php
                            $statusColors = [
                                'completed' => 'badge bg-green-100 text-green-800',
                                'cancelled' => 'badge bg-red-100 text-red-800',
                                'processing' => 'badge bg-blue-100 text-blue-800',
                                'pending' => 'badge bg-yellow-100 text-yellow-800'
                            ];
                        @endphp
                        <span class="{{ $statusColors[$order->status] ?? 'badge-primary' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    @if(auth()->user()->isAdmin())
                        <p class="text-gray-600 text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Customer: {{ $order->user->name }}
                        </p>
                    @endif
                    <p class="text-gray-500 text-sm flex items-center gap-2 mt-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $order->created_at->format('M d, Y') }}
                    </p>
                </div>
                <div class="flex items-center gap-6">
                    <div class="text-right">
                        <p class="text-sm text-gray-600 mb-1">Total Amount</p>
                        <p class="font-bold text-primary-600 text-2xl">₱{{ number_format($order->total_amount, 2) }}</p>
                    </div>
                    <a href="{{ route('orders.show', $order) }}"
                       class="btn-primary flex items-center gap-2 group-hover:scale-105 transition-transform">
                       View Details
                       <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                       </svg>
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="card p-12 text-center animate-fade-in">
            <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <p class="text-gray-900 text-xl font-semibold mb-2">No orders found</p>
            <p class="text-gray-600 mb-6">Start shopping to see your orders here</p>
            <a href="{{ route('books.index') }}" class="btn-primary inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Browse Books
            </a>
        </div>
    @endforelse
    
    @if($orders->count() > 0)
        <div class="mt-8">{{ $orders->links() }}</div>
    @endif
</div>
@endsection

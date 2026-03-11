@extends('layouts.app')
@section('title', 'My Orders - PageTurner')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">
            {{ auth()->user()->isAdmin() ? 'All Orders' : 'My Orders' }}
        </h1>
        <p class="text-gray-400 mt-2">View and manage your order history</p>
    </div>

    @forelse($orders as $order)
        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl shadow-lg p-6 mb-4 hover:shadow-xl transition-all">
            <div class="flex justify-between items-center">
                <div>
                    <p class="font-semibold text-lg text-white">Order #{{ $order->id }}</p>
                    @if(auth()->user()->isAdmin())
                        <p class="text-gray-400 text-sm">Customer: {{ $order->user->name }}</p>
                    @endif
                    <p class="text-gray-500 text-sm">{{ $order->created_at->format('M d, Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-white text-lg">₱{{ number_format($order->total_amount, 2) }}</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                        {{ $order->status === 'completed' ? 'bg-emerald-500/20 text-emerald-400' :
                           ($order->status === 'cancelled' ? 'bg-red-500/20 text-red-400' :
                           ($order->status === 'processing' ? 'bg-teal-500/20 text-teal-400' :
                           'bg-amber-500/20 text-amber-400')) }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('orders.show', $order) }}"
                   class="text-teal-400 hover:text-teal-300 font-semibold inline-flex items-center">
                   View Details 
                   <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                   </svg>
                </a>
            </div>
        </div>
    @empty
        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl p-8 text-center">
            <svg class="w-16 h-16 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <p class="text-gray-300 text-lg font-medium">No orders found</p>
            <p class="text-gray-500 text-sm mt-2">Start shopping to see your orders here</p>
            <a href="{{ route('books.index') }}" class="mt-4 inline-block bg-gradient-to-r from-teal-600 to-cyan-600 text-white px-6 py-2 rounded-lg font-medium hover:from-teal-700 hover:to-cyan-700 transition-all shadow-lg">
                Browse Books
            </a>
        </div>
    @endforelse
    
    @if($orders->count() > 0)
        <div class="mt-6">{{ $orders->links() }}</div>
    @endif
</div>
@endsection

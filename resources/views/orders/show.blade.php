@extends('layouts.app')
@section('title', 'Order #' . $order->id . ' - PageTurner')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-white">Order #{{ $order->id }}</h1>
        <p class="text-gray-400 mt-2">Order placed on {{ $order->created_at->format('M d, Y') }}</p>
    </div>

    <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl shadow-lg p-6 mb-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div>
                <p class="text-gray-400 text-sm">Date</p>
                <p class="font-semibold text-white">{{ $order->created_at->format('M d, Y') }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Status</p>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                    {{ $order->status === 'completed' ? 'bg-emerald-500/20 text-emerald-400' :
                       ($order->status === 'cancelled' ? 'bg-red-500/20 text-red-400' :
                       ($order->status === 'processing' ? 'bg-teal-500/20 text-teal-400' :
                       'bg-amber-500/20 text-amber-400')) }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Total</p>
                <p class="font-bold text-teal-400 text-lg">₱{{ number_format($order->total_amount, 2) }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm">Items</p>
                <p class="font-semibold text-white">{{ $order->orderItems->count() }}</p>
            </div>
        </div>

        {{-- Admin Status Update --}}
        @if(auth()->user()->isAdmin())
            <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="mb-6 flex gap-4 items-center">
                @csrf
                @method('PATCH')
                <select name="status" class="bg-slate-700 border-slate-600 text-white rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    @foreach(['pending', 'processing', 'completed', 'cancelled'] as $status)
                        <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-gradient-to-r from-teal-600 to-cyan-600 text-white px-4 py-2 rounded-lg font-medium hover:from-teal-700 hover:to-cyan-700 transition-all shadow-lg">
                    Update Status
                </button>
            </form>
        @endif

        {{-- Shipping Information --}}
        @if($order->shipping_name || $order->shipping_phone || $order->shipping_address)
            <div class="mb-6 p-4 bg-slate-700/50 rounded-lg border border-slate-600/50">
                <h3 class="font-semibold text-lg mb-3 text-white">Shipping Information</h3>
                <div class="space-y-2">
                    @if($order->shipping_name)
                        <p><span class="text-gray-400">Name:</span> <span class="font-medium text-white">{{ $order->shipping_name }}</span></p>
                    @endif
                    @if($order->shipping_phone)
                        <p><span class="text-gray-400">Phone:</span> <span class="font-medium text-white">{{ $order->shipping_phone }}</span></p>
                    @endif
                    @if($order->shipping_address)
                        <p><span class="text-gray-400">Address:</span> <span class="font-medium text-white">{{ $order->shipping_address }}</span></p>
                    @endif
                </div>
            </div>
        @endif

        {{-- Order Items --}}
        <h3 class="font-semibold text-lg mb-4 text-white">Items Ordered</h3>
        <div class="border border-slate-700/50 rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-slate-700/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-300">Book</th>
                        <th class="px-4 py-3 text-center text-sm font-medium text-gray-300">Qty</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-gray-300">Unit Price</th>
                        <th class="px-4 py-3 text-right text-sm font-medium text-gray-300">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @foreach($order->orderItems as $item)
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="px-4 py-3">
                                <a href="{{ route('books.show', $item->book) }}"
                                   class="text-teal-400 hover:text-teal-300 font-medium">
                                    {{ $item->book->title }}
                                </a>
                                <p class="text-gray-400 text-sm">by {{ $item->book->author }}</p>
                            </td>
                            <td class="px-4 py-3 text-center text-white">{{ $item->quantity }}</td>
                            <td class="px-4 py-3 text-right text-white">₱{{ number_format($item->unit_price, 2) }}</td>
                            <td class="px-4 py-3 text-right font-semibold text-white">₱{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-slate-700/50">
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-right font-bold text-white">Total:</td>
                        <td class="px-4 py-3 text-right font-bold text-teal-400 text-lg">
                            ₱{{ number_format($order->total_amount, 2) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ route('orders.index') }}" class="text-teal-400 hover:text-teal-300 inline-flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Orders
            </a>
        </div>
    </div>
</div>
@endsection
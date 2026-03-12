@extends('layouts.app')
@section('title', 'Order #' . $order->id . ' - PageTurner')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8 animate-fade-in">
        <a href="{{ route('orders.index') }}" class="text-primary-600 hover:text-primary-700 inline-flex items-center gap-1 mb-4 group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Orders
        </a>
        <h1 class="text-4xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
        <p class="text-gray-600 mt-2">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            {{-- Order Status Card --}}
            <div class="card p-6 animate-slide-up">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Order Status</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-gradient-to-br from-primary-50 to-primary-100 rounded-xl">
                        <svg class="w-8 h-8 text-primary-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-xs text-gray-600 mb-1">Date</p>
                        <p class="font-semibold text-gray-900 text-sm">{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="text-center p-4 bg-gradient-to-br from-accent-50 to-accent-100 rounded-xl">
                        <svg class="w-8 h-8 text-accent-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-xs text-gray-600 mb-1">Status</p>
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
                    <div class="text-center p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl">
                        <svg class="w-8 h-8 text-green-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-xs text-gray-600 mb-1">Total</p>
                        <p class="font-bold text-primary-600 text-lg">₱{{ number_format($order->total_amount, 2) }}</p>
                    </div>
                    <div class="text-center p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl">
                        <svg class="w-8 h-8 text-gray-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <p class="text-xs text-gray-600 mb-1">Items</p>
                        <p class="font-semibold text-gray-900 text-sm">{{ $order->orderItems->count() }}</p>
                    </div>
                </div>

                {{-- Admin Status Update --}}
                @if(auth()->user()->isAdmin())
                    <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="mt-6 p-4 bg-primary-50 rounded-xl border border-primary-200">
                        @csrf
                        @method('PATCH')
                        <label class="block text-sm font-medium text-gray-700 mb-2">Update Order Status</label>
                        <div class="flex gap-3">
                            <select name="status" class="input-field flex-1">
                                @foreach(['pending', 'processing', 'completed', 'cancelled'] as $status)
                                    <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn-primary">
                                Update Status
                            </button>
                        </div>
                    </form>
                @endif
            </div>

            {{-- Order Items --}}
            <div class="card overflow-hidden animate-slide-up">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Items Ordered</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Book</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Qty</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">Unit Price</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-gray-700">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($order->orderItems as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <a href="{{ route('books.show', $item->book) }}"
                                           class="text-primary-600 hover:text-primary-700 font-medium">
                                            {{ $item->book->title }}
                                        </a>
                                        <p class="text-gray-600 text-sm mt-0.5">by {{ $item->book->author }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="badge-primary">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-gray-900">₱{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="px-6 py-4 text-right font-semibold text-gray-900">₱{{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gradient-to-r from-primary-50 to-accent-50">
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-900">Total:</td>
                                <td class="px-6 py-4 text-right font-bold text-primary-600 text-xl">
                                    ₱{{ number_format($order->total_amount, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- Shipping Information Sidebar --}}
        <div class="lg:col-span-1">
            @if($order->shipping_name || $order->shipping_phone || $order->shipping_address)
                <div class="card p-6 sticky top-24 animate-fade-in">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Shipping Details
                    </h3>
                    <div class="space-y-4">
                        @if($order->shipping_name)
                            <div>
                                <p class="text-xs text-gray-600 uppercase tracking-wider mb-1">Name</p>
                                <p class="font-medium text-gray-900">{{ $order->shipping_name }}</p>
                            </div>
                        @endif
                        @if($order->shipping_phone)
                            <div>
                                <p class="text-xs text-gray-600 uppercase tracking-wider mb-1">Phone</p>
                                <p class="font-medium text-gray-900">{{ $order->shipping_phone }}</p>
                            </div>
                        @endif
                        @if($order->shipping_address)
                            <div>
                                <p class="text-xs text-gray-600 uppercase tracking-wider mb-1">Address</p>
                                <p class="font-medium text-gray-900 leading-relaxed">{{ $order->shipping_address }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
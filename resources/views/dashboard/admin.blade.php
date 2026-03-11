@extends('layouts.app')

@section('title', 'Admin Dashboard - PageTurner')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Admin Dashboard</h1>
        <p class="text-gray-400 mt-2">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl shadow-lg p-6 hover:shadow-xl transition-all">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-gradient-to-br from-teal-500 to-cyan-600 text-white shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Total Users</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($stats['total_users']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl shadow-lg p-6 hover:shadow-xl transition-all">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-gradient-to-br from-emerald-500 to-green-600 text-white shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Total Books</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($stats['total_books']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl shadow-lg p-6 hover:shadow-xl transition-all">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Categories</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($stats['total_categories']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl shadow-lg p-6 hover:shadow-xl transition-all">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-gradient-to-br from-amber-500 to-orange-600 text-white shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-400">Total Orders</p>
                    <p class="text-2xl font-bold text-white">{{ number_format($stats['total_orders']) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Recent Orders --}}
        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-slate-700/30 border-b border-slate-700/50">
                <h2 class="text-lg font-semibold text-white">Recent Orders</h2>
            </div>
            <div class="p-6">
                @forelse($recentOrders as $order)
                    <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-slate-700/50' : '' }}">
                        <div>
                            <p class="font-semibold text-white">Order #{{ $order->id }}</p>
                            <p class="text-sm text-gray-400">{{ $order->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $order->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-white">${{ number_format($order->total_amount, 2) }}</p>
                            <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full
                                @if($order->status === 'completed') bg-emerald-500/20 text-emerald-400
                                @elseif($order->status === 'processing') bg-teal-500/20 text-teal-400
                                @elseif($order->status === 'pending') bg-amber-500/20 text-amber-400
                                @else bg-red-500/20 text-red-400 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-8">No orders yet.</p>
                @endforelse
                
                @if($recentOrders->count() > 0)
                    <div class="mt-4 text-center">
                        <a href="{{ route('orders.index') }}" class="text-teal-400 hover:text-teal-300 text-sm font-semibold">
                            View All Orders →
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Order Status Summary --}}
        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-slate-700/30 border-b border-slate-700/50">
                <h2 class="text-lg font-semibold text-white">Order Status Summary</h2>
            </div>
            <div class="p-6">
                @if(!empty($orderStatusSummary))
                    @foreach($orderStatusSummary as $status => $count)
                        <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-slate-700/50' : '' }}">
                            <span class="text-gray-300 capitalize font-medium">{{ $status }}</span>
                            <span class="font-bold text-white text-lg">{{ $count }}</span>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 text-center py-8">No order data available.</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Recent Reviews --}}
    <div class="mt-8 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-slate-700/30 border-b border-slate-700/50">
            <h2 class="text-lg font-semibold text-white">Recent Reviews</h2>
        </div>
        <div class="p-6">
            @forelse($recentReviews as $review)
                <div class="py-4 {{ !$loop->last ? 'border-b border-slate-700/50' : '' }}">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <p class="font-semibold text-white">{{ $review->user->name }}</p>
                                <div class="ml-2 flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-sm text-gray-400 mt-1">{{ $review->book->title }}</p>
                            @if($review->comment)
                                <p class="text-gray-300 mt-2">{{ Str::limit($review->comment, 100) }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">No reviews yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="mt-8 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-xl shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-slate-700/30 border-b border-slate-700/50">
            <h2 class="text-lg font-semibold text-white">Quick Actions</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.books.create') }}" class="flex items-center p-4 bg-gradient-to-br from-teal-500/10 to-cyan-500/10 border-2 border-teal-500/30 rounded-lg hover:border-teal-500/50 hover:shadow-lg transition-all group">
                    <svg class="w-6 h-6 text-teal-400 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span class="text-teal-300 font-semibold">Add New Book</span>
                </a>
                
                <a href="{{ route('admin.categories.create') }}" class="flex items-center p-4 bg-gradient-to-br from-emerald-500/10 to-green-500/10 border-2 border-emerald-500/30 rounded-lg hover:border-emerald-500/50 hover:shadow-lg transition-all group">
                    <svg class="w-6 h-6 text-emerald-400 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span class="text-emerald-300 font-semibold">Add Category</span>
                </a>
                
                <a href="{{ route('books.index') }}" class="flex items-center p-4 bg-gradient-to-br from-indigo-500/10 to-purple-500/10 border-2 border-indigo-500/30 rounded-lg hover:border-indigo-500/50 hover:shadow-lg transition-all group">
                    <svg class="w-6 h-6 text-indigo-400 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span class="text-indigo-300 font-semibold">Manage Books</span>
                </a>
                
                <a href="{{ route('categories.index') }}" class="flex items-center p-4 bg-gradient-to-br from-amber-500/10 to-orange-500/10 border-2 border-amber-500/30 rounded-lg hover:border-amber-500/50 hover:shadow-lg transition-all group">
                    <svg class="w-6 h-6 text-amber-400 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="text-amber-300 font-semibold">Manage Categories</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

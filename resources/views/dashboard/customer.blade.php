@extends('layouts.app')

@section('title', 'My Dashboard - PageTurner')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Welcome back, {{ $user->name }}!</h1>
        <p class="text-slate-400 mt-2">Here's what's happening with your account</p>
    </div>

    {{-- Account Status Alerts --}}
    @if(!$user->hasVerifiedEmail())
        <div class="mb-6 bg-yellow-500/10 border border-yellow-500/30 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-yellow-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <div>
                    <p class="text-yellow-300 font-medium">Email Verification Required</p>
                    <p class="text-yellow-400/80 text-sm">Please verify your email address to access all features.</p>
                </div>
                <a href="{{ route('verification.notice') }}" class="ml-auto bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-4 py-2 rounded-md text-sm hover:from-yellow-600 hover:to-orange-600 transition-all">
                    Verify Now
                </a>
            </div>
        </div>
    @endif

    {{-- Order Summary Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gradient-to-br from-blue-500/20 to-purple-500/20 text-blue-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-400">Total Orders</p>
                    <p class="text-2xl font-semibold text-white">{{ $orderSummary['total_orders'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gradient-to-br from-yellow-500/20 to-orange-500/20 text-yellow-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-400">Pending Orders</p>
                    <p class="text-2xl font-semibold text-white">{{ $orderSummary['pending_orders'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-gradient-to-br from-green-500/20 to-emerald-500/20 text-green-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-slate-400">Completed Orders</p>
                    <p class="text-2xl font-semibold text-white">{{ $orderSummary['completed_orders'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Recent Orders --}}
        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-slate-700/50 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-white">Recent Orders</h2>
                <a href="{{ route('orders.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">View All</a>
            </div>
            <div class="p-6">
                @forelse($recentOrders as $order)
                    <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-slate-700/50' : '' }}">
                        <div>
                            <p class="font-medium text-white">Order #{{ $order->id }}</p>
                            <p class="text-sm text-slate-400">{{ $order->orderItems->count() }} items</p>
                            <p class="text-xs text-slate-500">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-medium text-white">${{ number_format($order->total_amount, 2) }}</p>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                @if($order->status === 'completed') bg-green-500/20 text-green-400
                                @elseif($order->status === 'processing') bg-blue-500/20 text-blue-400
                                @elseif($order->status === 'pending') bg-yellow-500/20 text-yellow-400
                                @else bg-red-500/20 text-red-400 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-slate-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <p class="text-slate-400">No orders yet</p>
                        <a href="{{ route('books.index') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium mt-2 inline-block">
                            Start Shopping →
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Account Security --}}
        <div class="bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-slate-700/50">
                <h2 class="text-lg font-semibold text-white">Account Security</h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-white">Email Verification</p>
                        <p class="text-sm text-slate-400">Secure your account with email verification</p>
                    </div>
                    <div class="flex items-center">
                        @if($user->hasVerifiedEmail())
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-500/20 text-green-400">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Verified
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-500/20 text-red-400">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                                Not Verified
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-white">Two-Factor Authentication</p>
                        <p class="text-sm text-slate-400">Add an extra layer of security</p>
                    </div>
                    <div class="flex items-center">
                        @if($user->two_factor_enabled)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-500/20 text-green-400">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                Enabled
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-700 text-slate-400">
                                Disabled
                            </span>
                        @endif
                    </div>
                </div>

                <div class="pt-4">
                    <a href="{{ route('profile.edit') }}" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:from-blue-600 hover:to-purple-700 text-center block transition-all">
                        Manage Security Settings
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Recently Purchased Books --}}
    @if($recentPurchases->count() > 0)
        <div class="mt-8 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-slate-700/50">
                <h2 class="text-lg font-semibold text-white">Recently Purchased Books</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentPurchases as $book)
                        <div class="border border-slate-700/50 rounded-lg p-4 hover:shadow-lg hover:border-slate-600/50 transition-all bg-slate-800/30">
                            <div class="flex items-start">
                                <div class="w-16 h-20 bg-slate-700 rounded flex-shrink-0 mr-4">
                                    @if($book->cover_image)
                                        <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover rounded">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-medium text-white text-sm">{{ Str::limit($book->title, 40) }}</h3>
                                    <p class="text-xs text-slate-400 mt-1">by {{ $book->author }}</p>
                                    <p class="text-xs text-slate-500 mt-1">{{ $book->category->name }}</p>
                                    <a href="{{ route('books.show', $book) }}" class="text-blue-400 hover:text-blue-300 text-xs font-medium mt-2 inline-block">
                                        View Details →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Review Activity --}}
    @if($reviewActivity->count() > 0)
        <div class="mt-8 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-slate-700/50">
                <h2 class="text-lg font-semibold text-white">Your Recent Reviews</h2>
            </div>
            <div class="p-6">
                @foreach($reviewActivity as $review)
                    <div class="py-4 {{ !$loop->last ? 'border-b border-slate-700/50' : '' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <p class="font-medium text-white">{{ $review->book->title }}</p>
                                    <div class="ml-2 flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-slate-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                @if($review->comment)
                                    <p class="text-slate-300 mt-2 text-sm">{{ Str::limit($review->comment, 100) }}</p>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-slate-500">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Quick Actions --}}
    <div class="mt-8 bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b border-slate-700/50">
            <h2 class="text-lg font-semibold text-white">Quick Actions</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('books.index') }}" class="flex items-center p-4 bg-gradient-to-br from-blue-500/10 to-purple-500/10 border border-blue-500/20 rounded-lg hover:from-blue-500/20 hover:to-purple-500/20 transition-all">
                    <svg class="w-6 h-6 text-blue-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span class="text-blue-300 font-medium">Browse Books</span>
                </a>
                
                <a href="{{ route('orders.index') }}" class="flex items-center p-4 bg-gradient-to-br from-green-500/10 to-emerald-500/10 border border-green-500/20 rounded-lg hover:from-green-500/20 hover:to-emerald-500/20 transition-all">
                    <svg class="w-6 h-6 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span class="text-green-300 font-medium">Order History</span>
                </a>
                
                <a href="{{ route('profile.edit') }}" class="flex items-center p-4 bg-gradient-to-br from-purple-500/10 to-pink-500/10 border border-purple-500/20 rounded-lg hover:from-purple-500/20 hover:to-pink-500/20 transition-all">
                    <svg class="w-6 h-6 text-purple-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-purple-300 font-medium">Profile Settings</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

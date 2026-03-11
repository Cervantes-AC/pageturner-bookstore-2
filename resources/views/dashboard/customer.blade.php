@extends('layouts.app')
@section('title', 'My Dashboard')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="mt-2 text-sm text-gray-600">Here's an overview of your account activity.</p>
        </div>

        <!-- Account Status Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Email Verification Status -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Email Status</p>
                        <p class="text-lg font-semibold mt-1 {{ auth()->user()->hasVerifiedEmail() ? 'text-green-600' : 'text-yellow-600' }}">
                            {{ auth()->user()->hasVerifiedEmail() ? 'Verified' : 'Unverified' }}
                        </p>
                    </div>
                    <div class="w-12 h-12 {{ auth()->user()->hasVerifiedEmail() ? 'bg-green-100' : 'bg-yellow-100' }} rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 {{ auth()->user()->hasVerifiedEmail() ? 'text-green-600' : 'text-yellow-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                @if(!auth()->user()->hasVerifiedEmail())
                    <a href="{{ route('verification.notice') }}" class="mt-4 inline-block text-sm text-blue-600 hover:text-blue-700 font-medium">
                        Verify Now →
                    </a>
                @endif
            </div>

            <!-- 2FA Status -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Two-Factor Auth</p>
                        <p class="text-lg font-semibold mt-1 {{ auth()->user()->two_factor_enabled ? 'text-green-600' : 'text-gray-600' }}">
                            {{ auth()->user()->two_factor_enabled ? 'Enabled' : 'Disabled' }}
                        </p>
                    </div>
                    <div class="w-12 h-12 {{ auth()->user()->two_factor_enabled ? 'bg-green-100' : 'bg-gray-100' }} rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 {{ auth()->user()->two_factor_enabled ? 'text-green-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}" class="mt-4 inline-block text-sm text-blue-600 hover:text-blue-700 font-medium">
                    Manage Security →
                </a>
            </div>

            <!-- Total Orders -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Orders</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalOrders }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Orders -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Recent Orders</h2>
                    <a href="{{ route('orders.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">View All →</a>
                </div>
                <div class="p-6">
                    @forelse($recentOrders as $order)
                        <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Order #{{ $order->id }}</p>
                                <p class="text-xs text-gray-500">{{ $order->created_at->format('M d, Y') }} • {{ $order->orderItems->count() }} items</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-900">₱{{ number_format($order->total_amount, 2) }}</p>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' :
                                       ($order->status === 'cancelled' ? 'bg-red-100 text-red-800' :
                                       ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' :
                                       'bg-yellow-100 text-yellow-800')) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <p class="text-sm text-gray-500 mb-4">No orders yet</p>
                            <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                                Start Shopping
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- My Reviews -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">My Reviews</h2>
                </div>
                <div class="p-6">
                    @forelse($myReviews as $review)
                        <div class="py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                            <div class="flex items-start justify-between mb-1">
                                <p class="text-sm font-medium text-gray-900">{{ $review->book->title }}</p>
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mb-1">{{ $review->created_at->format('M d, Y') }}</p>
                            @if($review->comment)
                                <p class="text-sm text-gray-600">{{ Str::limit($review->comment, 100) }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                            <p class="text-sm text-gray-500">No reviews yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg shadow-sm p-6 text-white">
            <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('books.index') }}" class="flex items-center space-x-3 bg-white/10 hover:bg-white/20 rounded-lg p-4 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <span class="font-medium">Browse Books</span>
                </a>
                <a href="{{ route('orders.index') }}" class="flex items-center space-x-3 bg-white/10 hover:bg-white/20 rounded-lg p-4 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <span class="font-medium">View Orders</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 bg-white/10 hover:bg-white/20 rounded-lg p-4 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="font-medium">Account Settings</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

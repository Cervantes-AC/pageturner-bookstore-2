@extends('layouts.app')
@section('title', 'Dashboard - PageTurner')

@section('content')
    <div class="card p-8 animate-fade-in">
        <div class="flex items-start gap-4 mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-primary-600 to-accent-600 rounded-2xl flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h2>
                <p class="text-gray-600 mt-1">You are logged in as <span class="badge-primary">{{ ucfirst(auth()->user()->role) }}</span></p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
            <a href="{{ route('books.index') }}" class="card-hover p-6 group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors">Browse Books</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Explore our collection</p>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('orders.index') }}" class="card-hover p-6 group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors">My Orders</h3>
                        <p class="text-sm text-gray-500 mt-0.5">View your order history</p>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('categories.index') }}" class="card-hover p-6 group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-accent-100 to-accent-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 group-hover:text-accent-600 transition-colors">Categories</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Browse by genre</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
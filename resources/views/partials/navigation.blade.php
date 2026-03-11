<nav class="bg-gradient-to-r from-slate-800 via-slate-900 to-slate-800 border-b border-slate-700 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ auth()->check() ? route('dashboard') : route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg group-hover:shadow-teal-500/50 transition-all">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">PageTurner</span>
                </a>
                <div class="hidden md:flex ml-10 space-x-1">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white hover:bg-slate-700/50 px-3 py-2 rounded-md transition-all">Home</a>
                    <a href="{{ route('books.index') }}" class="text-gray-300 hover:text-white hover:bg-slate-700/50 px-3 py-2 rounded-md transition-all">Books</a>
                    <a href="{{ route('categories.index') }}" class="text-gray-300 hover:text-white hover:bg-slate-700/50 px-3 py-2 rounded-md transition-all">Categories</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white hover:bg-slate-700/50 px-3 py-2 rounded-md transition-all">Dashboard</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.books.create') }}" class="text-teal-400 hover:text-teal-300 hover:bg-slate-700/50 px-3 py-2 rounded-md transition-all">+ Add Book</a>
                            <a href="{{ route('admin.categories.create') }}" class="text-cyan-400 hover:text-cyan-300 hover:bg-slate-700/50 px-3 py-2 rounded-md transition-all">+ Add Category</a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="flex items-center space-x-3">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-4 py-2 rounded-md transition-all">Login</a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-teal-600 to-cyan-600 text-white px-4 py-2 rounded-md font-medium hover:from-teal-700 hover:to-cyan-700 transition-all shadow-md">Register</a>
                @endguest
                @auth
                    @if(!auth()->user()->hasVerifiedEmail())
                        <div class="bg-amber-900/30 border border-amber-700/50 text-amber-400 px-3 py-1 rounded-md text-xs font-medium">
                            Email Not Verified
                        </div>
                    @endif
                    
                    <a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md relative transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        @php
                            $cart = session()->get('cart', []);
                            $cartCount = array_sum($cart);
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-gradient-to-r from-teal-500 to-cyan-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold shadow-lg">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('orders.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md transition-all">Orders</a>
                    
                    {{-- User Dropdown --}}
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="flex items-center text-gray-300 hover:text-white hover:bg-slate-700/50 px-3 py-2 rounded-md transition-all">
                            <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-full flex items-center justify-center mr-2 shadow-md">
                                <span class="text-white text-sm font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <span class="hidden sm:block">{{ auth()->user()->name }}</span>
                            @if(auth()->user()->two_factor_enabled)
                                <svg class="w-3 h-3 ml-1 text-teal-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                </svg>
                            @endif
                            <svg class="w-4 h-4 ml-1 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-xl py-1 z-50"
                             style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                Profile Settings
                            </a>
                            @if(auth()->user()->two_factor_enabled)
                                <a href="{{ route('two-factor.recovery-codes') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    Recovery Codes
                                </a>
                            @endif
                            <div class="border-t border-gray-200 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
<footer class="bg-white/80 backdrop-blur-md border-t border-gray-200/50 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="col-span-1">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-600 to-accent-600 rounded-xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="text-lg font-bold bg-gradient-to-r from-primary-600 to-accent-600 bg-clip-text text-transparent">PageTurner</span>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed">Your trusted partner for professional bookstore management and discovery.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Explore</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('books.index') }}" class="text-sm text-gray-600 hover:text-primary-600 transition-colors flex items-center group">
                        <span class="w-1 h-1 bg-primary-600 rounded-full mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        Browse Books
                    </a></li>
                    <li><a href="{{ route('categories.index') }}" class="text-sm text-gray-600 hover:text-primary-600 transition-colors flex items-center group">
                        <span class="w-1 h-1 bg-primary-600 rounded-full mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        Categories
                    </a></li>
                    @auth
                        <li><a href="{{ route('orders.index') }}" class="text-sm text-gray-600 hover:text-primary-600 transition-colors flex items-center group">
                            <span class="w-1 h-1 bg-primary-600 rounded-full mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            My Orders
                        </a></li>
                    @endauth
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Support</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-sm text-gray-600 hover:text-primary-600 transition-colors flex items-center group">
                        <span class="w-1 h-1 bg-primary-600 rounded-full mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        Help Center
                    </a></li>
                    <li><a href="#" class="text-sm text-gray-600 hover:text-primary-600 transition-colors flex items-center group">
                        <span class="w-1 h-1 bg-primary-600 rounded-full mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        Contact Us
                    </a></li>
                    <li><a href="#" class="text-sm text-gray-600 hover:text-primary-600 transition-colors flex items-center group">
                        <span class="w-1 h-1 bg-primary-600 rounded-full mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                        Privacy Policy
                    </a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Connect</h3>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        aaronclydeccervantes@gmail.com
                    </li>
                    <li class="pt-4 border-t border-gray-200">
                        <p class="text-xs text-gray-500">© {{ date('Y') }} PageTurner</p>
                        <p class="text-xs text-gray-500">All rights reserved</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

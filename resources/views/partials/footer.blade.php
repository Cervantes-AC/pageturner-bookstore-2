<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand -->
            <div class="col-span-1">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-gray-900">PageTurner</span>
                </div>
                <p class="text-sm text-gray-600">Professional bookstore management system for modern businesses.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('books.index') }}" class="text-sm text-gray-600 hover:text-blue-600 transition-colors">Browse Books</a></li>
                    <li><a href="{{ route('categories.index') }}" class="text-sm text-gray-600 hover:text-blue-600 transition-colors">Categories</a></li>
                    @auth
                        <li><a href="{{ route('orders.index') }}" class="text-sm text-gray-600 hover:text-blue-600 transition-colors">My Orders</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Support</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 transition-colors">Help Center</a></li>
                    <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 transition-colors">Contact Us</a></li>
                    <li><a href="#" class="text-sm text-gray-600 hover:text-blue-600 transition-colors">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Contact</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>support@pageturner.com</li>
                    <li>© {{ date('Y') }} PageTurner</li>
                    <li>All rights reserved</li>
                </ul>
            </div>
        </div>
    </div>
</footer>

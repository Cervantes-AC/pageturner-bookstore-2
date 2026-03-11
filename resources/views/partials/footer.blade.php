<footer class="bg-gradient-to-r from-slate-800 via-slate-900 to-slate-800 border-t border-slate-700 text-white py-12 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="md:col-span-2">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">PageTurner</span>
                </div>
                <p class="text-gray-400 max-w-md">Your destination for quality books at great prices. Discover, read, and grow with our extensive collection.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4 text-white">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-teal-400 transition-colors">Home</a></li>
                    <li><a href="{{ route('books.index') }}" class="text-gray-400 hover:text-teal-400 transition-colors">Browse Books</a></li>
                    <li><a href="{{ route('categories.index') }}" class="text-gray-400 hover:text-teal-400 transition-colors">Categories</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-teal-400 transition-colors">Dashboard</a></li>
                    @endauth
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4 text-white">Contact</h3>
                <ul class="space-y-2 text-gray-400">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        support@pageturner.com
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        (123) 456-7890
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-slate-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} PageTurner Bookstore. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-gray-400 hover:text-teal-400 transition-colors">
                    <span class="sr-only">Privacy Policy</span>
                    Privacy
                </a>
                <a href="#" class="text-gray-400 hover:text-teal-400 transition-colors">
                    <span class="sr-only">Terms of Service</span>
                    Terms
                </a>
            </div>
        </div>
    </div>
</footer>

<section>
    <div class="space-y-6">
        {{-- Email Verification Status --}}
        <div class="flex items-center justify-between p-4 bg-slate-900/50 rounded-lg border border-slate-700/30">
            <div>
                <h3 class="font-medium text-white">Email Verification</h3>
                <p class="text-sm text-slate-400">Verify your email address to secure your account</p>
            </div>
            <div>
                @if (auth()->user()->hasVerifiedEmail())
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-500/20 text-green-400">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Verified
                    </span>
                @else
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-500/20 text-red-400">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Not Verified
                        </span>
                        <a href="{{ route('verification.notice') }}" class="text-blue-400 hover:text-blue-300 text-xs font-medium">
                            Verify Now
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Two-Factor Authentication --}}
        <div class="p-4 bg-slate-900/50 rounded-lg border border-slate-700/30">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="font-medium text-white">Two-Factor Authentication</h3>
                    <p class="text-sm text-slate-400">Add an extra layer of security to your account</p>
                </div>
                <div>
                    @if (auth()->user()->two_factor_enabled)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-500/20 text-green-400">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Enabled
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-700 text-slate-400">
                            Disabled
                        </span>
                    @endif
                </div>
            </div>

            @if (auth()->user()->two_factor_enabled)
                {{-- 2FA is enabled --}}
                <div class="space-y-3">
                    <p class="text-sm text-green-400 bg-green-500/10 border border-green-500/30 p-3 rounded">
                        Two-factor authentication is currently enabled on your account. You'll receive a verification code via email when logging in.
                    </p>
                    
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('two-factor.recovery-codes') }}" class="inline-flex items-center px-3 py-2 border border-slate-600 shadow-sm text-sm leading-4 font-medium rounded-md text-slate-300 bg-slate-800 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-slate-900">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            View Recovery Codes
                        </a>
                        
                        <button onclick="document.getElementById('disable-2fa-modal').classList.remove('hidden')" class="inline-flex items-center px-3 py-2 border border-red-500/30 shadow-sm text-sm leading-4 font-medium rounded-md text-red-400 bg-red-500/10 hover:bg-red-500/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 focus:ring-offset-slate-900">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Disable 2FA
                        </button>
                    </div>
                </div>
            @else
                {{-- 2FA is disabled --}}
                <div class="space-y-3">
                    <p class="text-sm text-slate-300">
                        Two-factor authentication adds an extra layer of security to your account. When enabled, you'll receive a verification code via email during login.
                    </p>
                    
                    <button onclick="document.getElementById('enable-2fa-modal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-slate-900">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Enable Two-Factor Authentication
                    </button>
                </div>
            @endif
        </div>

        {{-- Login Activity --}}
        @if (auth()->user()->last_login_at)
            <div class="p-4 bg-slate-900/50 rounded-lg border border-slate-700/30">
                <h3 class="font-medium text-white mb-2">Recent Login Activity</h3>
                <div class="text-sm text-slate-400">
                    <p>Last login: {{ auth()->user()->last_login_at->format('M d, Y \a\t g:i A') }}</p>
                    @if (auth()->user()->last_login_ip)
                        <p>IP Address: {{ auth()->user()->last_login_ip }}</p>
                    @endif
                </div>
            </div>
        @endif
    </div>

    {{-- Enable 2FA Modal --}}
    <div id="enable-2fa-modal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border border-slate-700/50 w-96 shadow-2xl rounded-lg bg-slate-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-white">Enable Two-Factor Authentication</h3>
                    <button onclick="document.getElementById('enable-2fa-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form method="POST" action="{{ route('two-factor.enable') }}">
                    @csrf
                    <div class="mb-4">
                        <p class="text-sm text-slate-300 mb-4">
                            Please confirm your password to enable two-factor authentication. You'll receive backup recovery codes after enabling.
                        </p>
                        
                        <label for="enable-password" class="block text-sm font-medium text-slate-300">Current Password</label>
                        <input type="password" name="password" id="enable-password" required 
                               class="mt-1 block w-full bg-slate-900 border-slate-700 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @error('password')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="document.getElementById('enable-2fa-modal').classList.add('hidden')" 
                                class="px-4 py-2 text-sm font-medium text-slate-300 bg-slate-700 rounded-md hover:bg-slate-600">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-purple-600 rounded-md hover:from-blue-600 hover:to-purple-700">
                            Enable 2FA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Disable 2FA Modal --}}
    <div id="disable-2fa-modal" class="hidden fixed inset-0 bg-black/70 backdrop-blur-sm overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border border-slate-700/50 w-96 shadow-2xl rounded-lg bg-slate-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-white">Disable Two-Factor Authentication</h3>
                    <button onclick="document.getElementById('disable-2fa-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form method="POST" action="{{ route('two-factor.disable') }}">
                    @csrf
                    <div class="mb-4">
                        <p class="text-sm text-red-400 mb-4 bg-red-500/10 border border-red-500/30 p-3 rounded">
                            <strong>Warning:</strong> Disabling two-factor authentication will make your account less secure. All recovery codes will be deleted.
                        </p>
                        
                        <label for="disable-password" class="block text-sm font-medium text-slate-300">Current Password</label>
                        <input type="password" name="password" id="disable-password" required 
                               class="mt-1 block w-full bg-slate-900 border-slate-700 text-white rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                        @error('password')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="document.getElementById('disable-2fa-modal').classList.add('hidden')" 
                                class="px-4 py-2 text-sm font-medium text-slate-300 bg-slate-700 rounded-md hover:bg-slate-600">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-red-600 rounded-md hover:from-red-600 hover:to-red-700">
                            Disable 2FA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
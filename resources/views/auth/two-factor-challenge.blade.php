<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-gradient-to-br from-teal-500 to-cyan-600 mb-4">
            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-white">Two-Factor Authentication</h2>
        <p class="text-gray-400 text-sm mt-2">Enter the 6-digit code sent to your email</p>
    </div>

<form class="space-y-5" action="{{ route('two-factor.verify') }}" method="POST">
    @csrf
    
    <div>
        <label for="code" class="sr-only">Verification Code</label>
        <input id="code" name="code" type="text" maxlength="6" required 
               class="appearance-none rounded-lg relative block w-full px-3 py-3 bg-slate-700/50 border border-slate-600 placeholder-gray-400 text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center text-2xl tracking-widest font-mono"
               placeholder="000000" 
               autocomplete="one-time-code"
               inputmode="numeric"
               pattern="[0-9]{6}">
        @error('code')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <button type="submit" 
                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 focus:ring-offset-slate-800 transition shadow-lg">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </span>
            Verify Code
        </button>
    </div>

    <div class="flex items-center justify-between text-sm">
        <form action="{{ route('two-factor.resend') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-teal-400 hover:text-teal-300 font-medium transition">
                Resend Code
            </button>
        </form>

        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-gray-400 hover:text-gray-300 font-medium transition">
                Sign Out
            </button>
        </form>
    </div>
</form>

@if(session('status'))
    <div class="mt-4 rounded-lg bg-green-900/30 border border-green-700/50 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-400">
                    {{ session('status') }}
                </p>
            </div>
        </div>
    </div>
@endif

<div class="mt-6">
    <div class="relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-slate-700"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-slate-800/50 text-gray-400">Or use a recovery code</span>
        </div>
    </div>

    <div class="mt-4">
        <p class="text-center text-sm text-gray-400">
            Lost your device? You can use one of your recovery codes instead.
        </p>
    </div>
</div>

<script>
document.getElementById('code').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
    if (this.value.length === 6) {
        this.form.submit();
    }
});
</script>
</x-guest-layout>
@extends('layouts.app')
@section('title', 'Verify Order - PageTurner')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card p-8 animate-slide-up">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Verify Your Order</h1>
            <p class="text-gray-600">Enter the 6-digit code sent to your email</p>
            <p class="text-sm text-primary-600 font-medium mt-2">{{ auth()->user()->email }}</p>
        </div>

        <!-- Order Summary -->
        <div class="bg-gradient-to-r from-primary-50 to-accent-50 rounded-xl p-6 mb-8 border border-primary-100">
            <h3 class="font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                Order Summary
            </h3>
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Total Amount:</span>
                    <span class="font-bold text-gray-900 text-lg">₱{{ number_format($pendingOrder['total_amount'], 2) }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Shipping To:</span>
                    <span class="font-medium text-gray-900">{{ $pendingOrder['shipping_name'] }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Items:</span>
                    <span class="font-medium text-gray-900">{{ count($pendingOrder['items']) }} item(s)</span>
                </div>
            </div>
        </div>

        <!-- 2FA Form -->
        <form method="POST" action="{{ route('orders.verify2fa.submit') }}" class="space-y-6">
            @csrf

            <div>
                <label for="code" class="block text-gray-700 font-medium mb-2">Verification Code</label>
                <input type="text" 
                       id="code" 
                       name="code" 
                       maxlength="6" 
                       required 
                       autofocus
                       placeholder="000000"
                       class="input-field text-center text-2xl font-mono tracking-widest"
                       pattern="[0-9]{6}"
                       inputmode="numeric">
                @error('code')
                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-sm text-blue-800">
                    <p class="font-medium mb-1">Security Notice</p>
                    <p>For your security, we require verification before completing your order. Check your email for the 6-digit code.</p>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col gap-3">
                <button type="submit" class="btn-primary w-full flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Verify & Complete Order
                </button>

                <form method="POST" action="{{ route('orders.verify2fa.resend') }}" class="w-full">
                    @csrf
                    <button type="submit" class="btn-secondary w-full flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Resend Code
                    </button>
                </form>

                <a href="{{ route('cart.checkout') }}" class="btn-outline w-full text-center">
                    Cancel & Go Back
                </a>
            </div>
        </form>

        <!-- Help Text -->
        <div class="mt-8 pt-6 border-t border-gray-200 text-center">
            <p class="text-sm text-gray-600">
                Didn't receive the code? Check your spam folder or 
                <button onclick="document.querySelector('form[action=&quot;{{ route('orders.verify2fa.resend') }}&quot;]').submit()" 
                        class="text-primary-600 hover:text-primary-700 font-medium">
                    request a new one
                </button>
            </p>
            <p class="text-xs text-gray-500 mt-2">
                The code expires in 10 minutes
            </p>
        </div>
    </div>

    <!-- Recovery Code Option -->
    <div class="mt-6 text-center">
        <details class="inline-block text-left">
            <summary class="text-sm text-gray-600 hover:text-primary-600 cursor-pointer font-medium">
                Use recovery code instead
            </summary>
            <div class="mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-sm text-gray-600 mb-3">
                    If you don't have access to your email, you can use one of your recovery codes.
                </p>
                <form method="POST" action="{{ route('orders.verify2fa.submit') }}" class="space-y-3">
                    @csrf
                    <input type="text" 
                           name="code" 
                           placeholder="Enter recovery code"
                           class="input-field text-center font-mono"
                           required>
                    <button type="submit" class="btn-secondary w-full text-sm">
                        Verify with Recovery Code
                    </button>
                </form>
            </div>
        </details>
    </div>
</div>

<script>
// Auto-format code input
document.getElementById('code').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
    if (this.value.length === 6) {
        // Auto-submit when 6 digits entered (optional)
        // this.form.submit();
    }
});

// Auto-focus on page load
window.addEventListener('load', function() {
    document.getElementById('code').focus();
});
</script>
@endsection

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-red-700 hover:to-red-800 focus:from-red-700 focus:to-red-800 active:from-red-800 active:to-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-slate-800 transition ease-in-out duration-150 shadow-lg']) }}>
    {{ $slot }}
</button>

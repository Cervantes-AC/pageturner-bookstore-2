<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg font-semibold text-xs text-gray-300 uppercase tracking-widest hover:bg-slate-600 focus:bg-slate-600 active:bg-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-slate-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

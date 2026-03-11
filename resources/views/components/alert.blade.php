@props(['type' => 'info'])
@php
$classes = [
    'success' => 'bg-green-900/30 border-green-700/50 text-green-400',
    'error'   => 'bg-red-900/30 border-red-700/50 text-red-400',
    'warning' => 'bg-yellow-900/30 border-yellow-700/50 text-yellow-400',
    'info'    => 'bg-blue-900/30 border-blue-700/50 text-blue-400',
];
@endphp
<div {{ $attributes->merge(['class' => 'border px-4 py-3 rounded-lg backdrop-blur-sm ' . ($classes[$type] ?? $classes['info'])]) }}>
    {{ $slot }}
</div>
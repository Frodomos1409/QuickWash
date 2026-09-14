@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center gap-1.5 px-3.5 py-2 rounded-full text-sm font-semibold text-white bg-white/15 shadow-inner transition duration-150 ease-in-out'
            : 'inline-flex items-center gap-1.5 px-3.5 py-2 rounded-full text-sm font-medium text-brand-100/80 hover:text-white hover:bg-white/10 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

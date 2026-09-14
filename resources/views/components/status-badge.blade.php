@props(['estado'])

@php
$config = [
    'pendiente' => ['bg-amber-50 text-amber-700 ring-amber-200', 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
    'en_proceso' => ['bg-sky-50 text-sky-700 ring-sky-200', 'M4.5 12a7.5 7.5 0 0015 0m0 0l-3-3m3 3l3-3M19.5 12a7.5 7.5 0 00-15 0m0 0l3 3m-3-3l-3 3'],
    'finalizada' => ['bg-emerald-50 text-emerald-700 ring-emerald-200', 'M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z'],
    'cancelada' => ['bg-rose-50 text-rose-700 ring-rose-200', 'M6 18L18 6M6 6l12 12'],
][$estado] ?? ['bg-slate-100 text-slate-600 ring-slate-200', 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'];

[$classes, $icon] = $config;
$label = ucfirst(str_replace('_', ' ', $estado));
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold ring-1 ring-inset whitespace-nowrap $classes"]) }}>
    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}" />
    </svg>
    {{ $label }}
</span>

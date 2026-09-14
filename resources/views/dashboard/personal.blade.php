<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800">
                    Panel de control 🧺
                </h2>
                <p class="text-slate-500 text-sm mt-1">Resumen general de todas las reservas de QuickWash.</p>
            </div>
            <a href="{{ route('personal.reservations.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 rounded-xl font-semibold text-sm text-white shadow-brand hover:bg-brand-700 transition">
                Gestionar reservas
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Stat cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl shadow-card border border-slate-100 p-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">Pendientes</span>
                        <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-amber-50 text-amber-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800 mt-3">{{ $stats['pendientes'] }}</p>
                </div>

                <div class="bg-white rounded-2xl shadow-card border border-slate-100 p-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">En proceso</span>
                        <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-sky-50 text-sky-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m0 0l-3-3m3 3l3-3M19.5 12a7.5 7.5 0 00-15 0m0 0l3 3m-3-3l-3 3" /></svg>
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800 mt-3">{{ $stats['en_proceso'] }}</p>
                </div>

                <div class="bg-white rounded-2xl shadow-card border border-slate-100 p-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">Finalizadas</span>
                        <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800 mt-3">{{ $stats['finalizadas'] }}</p>
                </div>

                <div class="bg-white rounded-2xl shadow-card border border-slate-100 p-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">Canceladas</span>
                        <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-rose-50 text-rose-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800 mt-3">{{ $stats['canceladas'] }}</p>
                </div>
            </div>

            <!-- Actividad reciente -->
            <div class="bg-white rounded-2xl shadow-card border border-slate-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-slate-800">Actividad reciente</h3>
                    <a href="{{ route('personal.reservations.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">Ver todas</a>
                </div>

                @forelse ($recientes as $reserva)
                    <div class="flex items-center gap-4 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                        <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-brand-50 text-brand-600 font-bold text-sm shrink-0">
                            {{ $reserva->machine->numero }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-slate-800 truncate">{{ $reserva->user->name }} · {{ $reserva->machine->nombre }}</p>
                            <p class="text-sm text-slate-500">{{ $reserva->fecha->format('d/m/Y') }} · {{ substr($reserva->hora_inicio, 0, 5) }} - {{ substr($reserva->hora_fin, 0, 5) }}</p>
                        </div>
                        <x-status-badge :estado="$reserva->estado" />
                    </div>
                @empty
                    <p class="text-slate-500 text-center py-10">Aún no hay reservas registradas.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

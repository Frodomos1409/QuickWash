<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800">
                    Hola, {{ explode(' ', Auth::user()->name)[0] }} 👋
                </h2>
                <p class="text-slate-500 text-sm mt-1">Esto es lo que pasa con tu lavado hoy.</p>
            </div>
            <a href="{{ route('reservations.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 rounded-xl font-semibold text-sm text-white shadow-brand hover:bg-brand-700 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                Nueva reserva
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Stat cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl shadow-card border border-slate-100 p-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">Activas</span>
                        <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-brand-50 text-brand-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="4" y="5" width="16" height="16" rx="2"/><path stroke-linecap="round" d="M8 3v4M16 3v4M4 10h16"/></svg>
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800 mt-3">{{ $stats['activas'] }}</p>
                    <p class="text-xs text-slate-400 mt-1">de un máximo de 3</p>
                </div>

                <div class="bg-white rounded-2xl shadow-card border border-slate-100 p-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">Pendientes</span>
                        <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-amber-50 text-amber-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800 mt-3">{{ $stats['pendientes'] }}</p>
                    <p class="text-xs text-slate-400 mt-1">por atender</p>
                </div>

                <div class="bg-white rounded-2xl shadow-card border border-slate-100 p-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">Finalizadas</span>
                        <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800 mt-3">{{ $stats['finalizadas'] }}</p>
                    <p class="text-xs text-slate-400 mt-1">lavados completados</p>
                </div>

                <div class="bg-white rounded-2xl shadow-card border border-slate-100 p-5">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wide text-slate-400">Disponibles</span>
                        <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-sky-50 text-sky-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="13" r="6" stroke-linecap="round"/><path stroke-linecap="round" d="M9 5h6"/></svg>
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-slate-800 mt-3">{{ $stats['disponibles'] }}</p>
                    <p class="text-xs text-slate-400 mt-1">máquinas listas</p>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Próximas reservas -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-card border border-slate-100 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-slate-800">Próximas reservas</h3>
                        <a href="{{ route('reservations.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">Ver todas</a>
                    </div>

                    @forelse ($proximas as $reserva)
                        <div class="flex items-center gap-4 py-3.5 {{ !$loop->last ? 'border-b border-slate-100' : '' }}">
                            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-brand-50 text-brand-600 font-bold text-sm shrink-0">
                                {{ $reserva->machine->numero }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-slate-800 truncate">{{ $reserva->machine->nombre }}</p>
                                <p class="text-sm text-slate-500">{{ $reserva->fecha->format('d/m/Y') }} · {{ substr($reserva->hora_inicio, 0, 5) }} - {{ substr($reserva->hora_fin, 0, 5) }}</p>
                            </div>
                            <x-status-badge :estado="$reserva->estado" />
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <p class="text-slate-500 mb-4">No tienes reservas próximas.</p>
                            <a href="{{ route('reservations.create') }}" class="text-brand-600 font-semibold hover:text-brand-700">Reserva una máquina &rarr;</a>
                        </div>
                    @endforelse
                </div>

                <!-- Quick actions -->
                <div class="bg-brand-gradient rounded-2xl shadow-brand p-6 text-white relative overflow-hidden">
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 rounded-full bg-white/10"></div>
                    <h3 class="font-bold mb-1 relative">¿Listo para lavar?</h3>
                    <p class="text-sm text-brand-100/90 mb-5 relative">Revisa las máquinas disponibles y reserva tu horario ideal.</p>
                    <div class="space-y-2.5 relative">
                        <a href="{{ route('machines.index') }}" class="flex items-center justify-between bg-white/15 hover:bg-white/25 transition rounded-xl px-4 py-3 font-semibold text-sm">
                            Ver máquinas
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                        </a>
                        <a href="{{ route('reservations.create') }}" class="flex items-center justify-between bg-white text-brand-700 hover:bg-brand-50 transition rounded-xl px-4 py-3 font-semibold text-sm">
                            Nueva reserva
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

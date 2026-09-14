<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800">Mis reservas</h2>
                <p class="text-slate-500 text-sm mt-1">Historial y estado de tus turnos de lavado.</p>
            </div>
            <a href="{{ route('reservations.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 rounded-xl font-semibold text-sm text-white shadow-brand hover:bg-brand-700 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                Nueva reserva
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="flex items-center gap-2 p-4 bg-emerald-50 text-emerald-700 rounded-xl ring-1 ring-emerald-200">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="flex items-center gap-2 p-4 bg-rose-50 text-rose-700 rounded-xl ring-1 ring-rose-200">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                    {{ session('error') }}
                </div>
            @endif

            @forelse ($reservations as $reservation)
                <div class="bg-white rounded-2xl shadow-card border border-slate-100 p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="flex items-center justify-center w-14 h-14 rounded-2xl bg-brand-50 text-brand-600 font-extrabold text-sm shrink-0">
                        {{ $reservation->machine->numero }}
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <p class="font-bold text-slate-800">{{ $reservation->machine->nombre }}</p>
                            <x-status-badge :estado="$reservation->estado" />
                        </div>
                        <div class="flex items-center gap-4 mt-1.5 text-sm text-slate-500">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="4" y="5" width="16" height="16" rx="2"/><path stroke-linecap="round" d="M8 3v4M16 3v4M4 10h16"/></svg>
                                {{ $reservation->fecha->format('d/m/Y') }}
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ substr($reservation->hora_inicio, 0, 5) }} - {{ substr($reservation->hora_fin, 0, 5) }}
                            </span>
                        </div>
                    </div>

                    @if ($reservation->puedeCancelarse())
                        <form method="POST" action="{{ route('reservations.cancel', $reservation) }}" onsubmit="return confirm('¿Cancelar esta reserva?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 transition">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                                Cancelar
                            </button>
                        </form>
                    @endif
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-2xl shadow-card border border-slate-100">
                    <p class="text-slate-500 mb-4">Aún no tienes reservas.</p>
                    <a href="{{ route('reservations.create') }}" class="text-brand-600 font-semibold hover:text-brand-700">Crear tu primera reserva &rarr;</a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>

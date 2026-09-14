<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-extrabold text-2xl text-slate-800">Reservas realizadas</h2>
            <p class="text-slate-500 text-sm mt-1">Supervisa y actualiza el estado de cada turno.</p>
        </div>
    </x-slot>

    <div class="py-10" x-data="{ filtro: 'todas' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="flex items-center gap-2 p-4 bg-emerald-50 text-emerald-700 rounded-xl ring-1 ring-emerald-200">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('status') }}
                </div>
            @endif

            <!-- Filtros -->
            <div class="flex flex-wrap gap-2">
                @foreach (['todas' => 'Todas', 'pendiente' => 'Pendientes', 'en_proceso' => 'En proceso', 'finalizada' => 'Finalizadas', 'cancelada' => 'Canceladas'] as $value => $label)
                    <button type="button" @click="filtro = '{{ $value }}'"
                            class="px-4 py-2 rounded-full text-sm font-semibold transition"
                            :class="filtro === '{{ $value }}' ? 'bg-brand-600 text-white shadow-brand' : 'bg-white text-slate-600 border border-slate-200 hover:border-slate-300'">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <div class="bg-white rounded-2xl shadow-card border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Estudiante</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Máquina</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Fecha</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Horario</th>
                                <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($reservations as $reservation)
                                <tr x-show="filtro === 'todas' || filtro === '{{ $reservation->estado }}'" class="hover:bg-slate-50/60 transition">
                                    <td class="px-5 py-3.5">
                                        <div class="flex items-center gap-2.5">
                                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-brand-50 text-brand-600 font-bold text-xs shrink-0">
                                                {{ strtoupper(substr($reservation->user->name, 0, 1)) }}
                                            </span>
                                            <span class="font-medium text-slate-800">{{ $reservation->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-3.5 text-slate-600">{{ $reservation->machine->numero }} · {{ $reservation->machine->nombre }}</td>
                                    <td class="px-5 py-3.5 text-slate-600">{{ $reservation->fecha->format('d/m/Y') }}</td>
                                    <td class="px-5 py-3.5 text-slate-600">{{ substr($reservation->hora_inicio, 0, 5) }} - {{ substr($reservation->hora_fin, 0, 5) }}</td>
                                    <td class="px-5 py-3.5">
                                        <form method="POST" action="{{ route('personal.reservations.updateStatus', $reservation) }}">
                                            @csrf
                                            @method('PATCH')
                                            <select name="estado" onchange="this.form.submit()"
                                                    class="text-sm font-semibold rounded-lg border-slate-200 focus:border-brand-500 focus:ring-brand-500
                                                    @if($reservation->estado === 'pendiente') text-amber-700 bg-amber-50
                                                    @elseif($reservation->estado === 'en_proceso') text-sky-700 bg-sky-50
                                                    @elseif($reservation->estado === 'finalizada') text-emerald-700 bg-emerald-50
                                                    @else text-rose-700 bg-rose-50 @endif">
                                                @foreach (['pendiente' => 'Pendiente', 'en_proceso' => 'En proceso', 'finalizada' => 'Finalizada', 'cancelada' => 'Cancelada'] as $value => $label)
                                                    <option value="{{ $value }}" @selected($reservation->estado === $value)>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-12 text-center text-slate-500">No hay reservas registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

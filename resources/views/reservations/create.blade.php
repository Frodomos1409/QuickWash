<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-extrabold text-2xl text-slate-800">Nueva reserva</h2>
            <p class="text-slate-500 text-sm mt-1">Elige máquina, fecha y horario. Cada turno dura 1 hora.</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-card border border-slate-100 p-6 sm:p-8">
                @if ($errors->any())
                    <div class="mb-6 flex items-start gap-2 p-4 bg-rose-50 text-rose-700 rounded-xl ring-1 ring-rose-200">
                        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
                        <ul class="text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('reservations.store') }}" x-data="{ machine: '{{ old('machine_id', $selected ?: '') }}', hora: '{{ old('hora_inicio') }}' }">
                    @csrf

                    <!-- Machine picker -->
                    <div>
                        <x-input-label value="Máquina" />
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-3 mt-2">
                            @foreach ($machines as $machine)
                                <label class="cursor-pointer rounded-xl border-2 p-3 flex flex-col items-center gap-1 text-center transition"
                                       :class="machine == {{ $machine->id }} ? 'border-brand-500 bg-brand-50' : 'border-slate-200 hover:border-slate-300'">
                                    <input type="radio" name="machine_id" value="{{ $machine->id }}" class="sr-only" x-model="machine" required>
                                    <svg class="w-6 h-6" :class="machine == {{ $machine->id }} ? 'text-brand-600' : 'text-slate-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <circle cx="12" cy="13" r="6.5" />
                                        <path stroke-linecap="round" d="M8.5 13c1 1.6 1.9 2.4 3.5 2.4s2.5-.8 3.5-2.4" />
                                    </svg>
                                    <span class="text-xs font-bold" :class="machine == {{ $machine->id }} ? 'text-brand-700' : 'text-slate-600'">{{ $machine->numero }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('machine_id')" class="mt-2" />
                    </div>

                    <!-- Fecha -->
                    <div class="mt-6">
                        <x-input-label for="fecha" value="Fecha" />
                        <x-text-input id="fecha" name="fecha" type="date" class="block mt-1.5" :value="old('fecha')" min="{{ now()->toDateString() }}" required />
                        <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
                    </div>

                    <!-- Horario -->
                    <div class="mt-6">
                        <x-input-label value="Horario" />
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-2 mt-2">
                            @foreach (range(7, 20) as $h)
                                @php $valor = sprintf('%02d:00', $h); @endphp
                                <label class="cursor-pointer rounded-xl border-2 py-2 text-center text-sm font-semibold transition"
                                       :class="hora === '{{ $valor }}' ? 'border-brand-500 bg-brand-50 text-brand-700' : 'border-slate-200 text-slate-600 hover:border-slate-300'">
                                    <input type="radio" name="hora_inicio" value="{{ $valor }}" class="sr-only" x-model="hora" required>
                                    {{ $valor }}
                                </label>
                            @endforeach
                        </div>
                        <p class="text-xs text-slate-400 mt-2" x-show="hora" x-cloak>
                            Turno de <span x-text="hora"></span> a <span x-text="hora ? hora.split(':')[0].padStart(2,'0') * 1 + 1 + ':00' : ''"></span>
                        </p>
                        <x-input-error :messages="$errors->get('hora_inicio')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-100">
                        <a href="{{ route('machines.index') }}" class="text-sm font-semibold text-slate-500 hover:text-slate-700">Cancelar</a>
                        <x-primary-button class="px-6 py-2.5">
                            Registrar reserva
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-extrabold text-2xl text-slate-800">Máquinas</h2>
            <p class="text-slate-500 text-sm mt-1">Elige una máquina disponible y resérvala en segundos.</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-6 flex items-center gap-2 p-4 bg-emerald-50 text-emerald-700 rounded-xl ring-1 ring-emerald-200">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse ($machines as $machine)
                    <div class="group bg-white rounded-2xl shadow-card border border-slate-100 p-6 hover:-translate-y-0.5 hover:shadow-brand transition duration-200">
                        <div class="flex items-start justify-between mb-5">
                            <div class="flex items-center justify-center w-14 h-14 rounded-2xl {{ $machine->disponible ? 'bg-brand-50 text-brand-600' : 'bg-slate-100 text-slate-400' }}">
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="12" cy="13" r="6.5" />
                                    <path stroke-linecap="round" d="M8 5h8M8.5 13c1 1.8 1.9 2.6 3.5 2.6s2.5-.8 3.5-2.6" />
                                    <circle cx="9.5" cy="4" r=".8" fill="currentColor" stroke="none" />
                                    <circle cx="12" cy="4" r=".8" fill="currentColor" stroke="none" />
                                </svg>
                            </div>

                            @if ($machine->disponible)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Disponible
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500 ring-1 ring-inset ring-slate-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    No disponible
                                </span>
                            @endif
                        </div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-brand-600">{{ $machine->numero }}</p>
                        <h3 class="text-lg font-bold text-slate-800 mt-0.5">{{ $machine->nombre }}</h3>

                        <a href="{{ $machine->disponible ? route('reservations.create', ['machine' => $machine->id]) : '#' }}"
                           class="mt-5 flex items-center justify-center gap-2 w-full py-2.5 rounded-xl font-semibold text-sm transition {{ $machine->disponible ? 'bg-brand-600 text-white hover:bg-brand-700 shadow-brand' : 'bg-slate-100 text-slate-400 pointer-events-none' }}">
                            Reservar
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl shadow-card border border-slate-100">
                        <p class="text-slate-500">No hay máquinas registradas.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

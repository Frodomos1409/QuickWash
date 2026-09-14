<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>QuickWash · Reserva de lavadoras</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-900">
        <!-- Nav -->
        <header class="max-w-7xl mx-auto px-6 lg:px-8 py-6 flex flex-wrap items-center justify-between gap-4">
            <a href="/" class="flex items-center gap-2.5 text-brand-700">
                <x-application-logo class="w-10 h-10 shrink-0" />
                <span class="font-extrabold text-xl">QuickWash</span>
            </a>

            <nav class="flex items-center gap-2 sm:gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 sm:px-5 py-2.5 rounded-xl font-semibold text-sm bg-brand-600 text-white shadow-brand hover:bg-brand-700 transition whitespace-nowrap">
                        Ir al dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-3 sm:px-4 py-2.5 rounded-xl font-semibold text-sm text-slate-600 hover:text-brand-700 transition whitespace-nowrap">
                        Ingresar
                    </a>
                    <a href="{{ route('register') }}" class="px-4 sm:px-5 py-2.5 rounded-xl font-semibold text-sm bg-brand-600 text-white shadow-brand hover:bg-brand-700 transition whitespace-nowrap">
                        Crear cuenta
                    </a>
                @endauth
            </nav>
        </header>

        <!-- Hero -->
        <section class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-10 pb-24 grid lg:grid-cols-2 gap-12 items-center">
                <div class="animate-fade-up">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-50 text-brand-700 text-xs font-semibold uppercase tracking-wide">
                        Proyecto de Sistemas 3
                    </span>
                    <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight mt-5 text-slate-900">
                        Lava tu ropa sin <span class="text-brand-600">perder tiempo</span> haciendo fila.
                    </h1>
                    <p class="text-lg text-slate-500 mt-5 max-w-lg">
                        QuickWash conecta a estudiantes y personal en una sola plataforma: reserva tu máquina en segundos y el personal supervisa todo en tiempo real.
                    </p>

                    <div class="flex flex-wrap items-center gap-3 mt-8">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold bg-brand-600 text-white shadow-brand hover:bg-brand-700 transition">
                            Empezar gratis
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold bg-white text-slate-700 border border-slate-200 hover:border-slate-300 transition">
                            Ya tengo cuenta
                        </a>
                    </div>

                    <div class="flex items-center gap-8 mt-10 text-sm text-slate-500">
                        <div>
                            <p class="text-2xl font-extrabold text-slate-800">3</p>
                            <p>reservas activas máx.</p>
                        </div>
                        <div>
                            <p class="text-2xl font-extrabold text-slate-800">2h</p>
                            <p>para cancelar</p>
                        </div>
                        <div>
                            <p class="text-2xl font-extrabold text-slate-800">24/7</p>
                            <p>disponibilidad</p>
                        </div>
                    </div>
                </div>

                <div class="relative animate-fade-up" style="animation-delay: .1s">
                    <div class="absolute -inset-6 bg-brand-gradient rounded-[2rem] opacity-10 blur-2xl"></div>
                    <div class="relative bg-white rounded-[1.75rem] shadow-card border border-slate-100 p-6 space-y-3">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-bold text-slate-800">Máquinas disponibles</p>
                            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">En vivo</span>
                        </div>
                        @foreach ([['M-01', 'Lavadora 1', true], ['M-02', 'Lavadora 2', true], ['M-03', 'Lavadora 3', false]] as [$num, $name, $free])
                            <div class="flex items-center gap-3 p-3 rounded-xl {{ $free ? 'bg-slate-50' : 'bg-slate-50/50' }}">
                                <div class="flex items-center justify-center w-10 h-10 rounded-xl {{ $free ? 'bg-brand-50 text-brand-600' : 'bg-slate-100 text-slate-400' }}">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="13" r="6.5" /><path stroke-linecap="round" d="M8.5 13c1 1.6 1.9 2.4 3.5 2.4s2.5-.8 3.5-2.4" /></svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-700">{{ $num }} · {{ $name }}</p>
                                </div>
                                <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $free ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $free ? 'Disponible' : 'Ocupada' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Features -->
        <section class="bg-white border-y border-slate-100">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
                <div class="text-center max-w-2xl mx-auto mb-14">
                    <h2 class="text-3xl font-extrabold text-slate-900">Todo lo que necesitas para lavar sin fricción</h2>
                    <p class="text-slate-500 mt-3">Dos roles, un solo flujo simple.</p>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <div class="p-6 rounded-2xl border border-slate-100 hover:shadow-card transition">
                        <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="4" y="5" width="16" height="16" rx="2"/><path stroke-linecap="round" d="M8 3v4M16 3v4M4 10h16"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-800 mb-1.5">Reserva en segundos</h3>
                        <p class="text-sm text-slate-500">Elige máquina, fecha y horario disponible; sin choques ni sorpresas.</p>
                    </div>

                    <div class="p-6 rounded-2xl border border-slate-100 hover:shadow-card transition">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-800 mb-1.5">Control de estados</h3>
                        <p class="text-sm text-slate-500">El personal actualiza pendiente, en proceso, finalizada o cancelada.</p>
                    </div>

                    <div class="p-6 rounded-2xl border border-slate-100 hover:shadow-card transition">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="font-bold text-slate-800 mb-1.5">Reglas justas</h3>
                        <p class="text-sm text-slate-500">Máximo 3 reservas activas por estudiante y cancelación con 2h de anticipación.</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="max-w-7xl mx-auto px-6 lg:px-8 py-10 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-slate-400">
            <p>&copy; {{ date('Y') }} QuickWash · Proyecto de Sistemas 3</p>
            <div class="flex items-center gap-2">
                <x-application-logo class="w-5 h-5 text-brand-500" />
                <span>Hecho para lavar mejor.</span>
            </div>
        </footer>
    </body>
</html>

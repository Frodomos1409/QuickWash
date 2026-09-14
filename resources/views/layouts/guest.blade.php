<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'QuickWash') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="min-h-screen flex bg-slate-100">
            <!-- Brand panel -->
            <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-brand-gradient text-white flex-col justify-between p-12">
                <div class="absolute inset-0 bg-brand-radial"></div>
                <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-white/10 animate-float"></div>
                <div class="absolute top-1/3 -left-10 w-56 h-56 rounded-full bg-white/10 animate-float" style="animation-delay: -3s"></div>

                <a href="/" class="relative flex items-center gap-3">
                    <x-application-logo class="w-11 h-11" />
                    <span class="font-extrabold text-2xl tracking-tight">QuickWash</span>
                </a>

                <div class="relative max-w-md">
                    <h1 class="text-4xl font-extrabold leading-tight mb-4">
                        Reserva tu lavadora sin filas ni sorpresas.
                    </h1>
                    <p class="text-brand-100/90 text-lg">
                        Estudiantes reservan máquina, fecha y horario en segundos. Personal supervisa y actualiza el estado en tiempo real.
                    </p>

                    <div class="mt-10 space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-white/15">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </span>
                            <span class="text-sm text-brand-50">Sin choques de horario entre estudiantes.</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-white/15">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </span>
                            <span class="text-sm text-brand-50">Cancela hasta 2 horas antes, sin líos.</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-9 h-9 rounded-xl bg-white/15">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-5.13a4 4 0 11-8 0 4 4 0 018 0zm6 3a4 4 0 10-8 0" /></svg>
                            </span>
                            <span class="text-sm text-brand-50">Personal con panel de control en vivo.</span>
                        </div>
                    </div>
                </div>

                <p class="relative text-xs text-brand-100/70">&copy; {{ date('Y') }} QuickWash · Proyecto de Sistemas 3</p>
            </div>

            <!-- Form panel -->
            <div class="w-full lg:w-1/2 flex flex-col items-center justify-center px-6 py-12">
                <a href="/" class="lg:hidden flex items-center gap-2.5 mb-8 text-brand-700">
                    <x-application-logo class="w-10 h-10" />
                    <span class="font-extrabold text-xl">QuickWash</span>
                </a>

                <div class="w-full sm:max-w-md">
                    <div class="bg-white px-8 py-9 shadow-card rounded-2xl border border-slate-100 animate-fade-up">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

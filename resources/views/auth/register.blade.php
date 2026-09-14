<x-guest-layout>
    <div class="mb-7">
        <h2 class="text-2xl font-extrabold text-slate-900">Crea tu cuenta</h2>
        <p class="text-sm text-slate-500 mt-1">Únete a QuickWash como estudiante o personal.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4" x-data="{ role: '{{ old('role', 'estudiante') }}' }">
        @csrf

        <!-- Role -->
        <div>
            <x-input-label value="Rol" />
            <div class="grid grid-cols-2 gap-3 mt-1.5">
                <label class="relative cursor-pointer rounded-xl border-2 p-3.5 flex flex-col items-center gap-1.5 text-center transition"
                       :class="role === 'estudiante' ? 'border-brand-500 bg-brand-50' : 'border-slate-200 hover:border-slate-300'">
                    <input type="radio" name="role" value="estudiante" class="sr-only" x-model="role" required>
                    <svg class="w-6 h-6" :class="role === 'estudiante' ? 'text-brand-600' : 'text-slate-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.42A12.083 12.083 0 0112 21a12.083 12.083 0 01-6.16-10.42L12 14z" />
                    </svg>
                    <span class="text-sm font-semibold" :class="role === 'estudiante' ? 'text-brand-700' : 'text-slate-600'">Estudiante</span>
                </label>

                <label class="relative cursor-pointer rounded-xl border-2 p-3.5 flex flex-col items-center gap-1.5 text-center transition"
                       :class="role === 'personal' ? 'border-brand-500 bg-brand-50' : 'border-slate-200 hover:border-slate-300'">
                    <input type="radio" name="role" value="personal" class="sr-only" x-model="role" required>
                    <svg class="w-6 h-6" :class="role === 'personal' ? 'text-brand-600' : 'text-slate-400'" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-5.13a4 4 0 11-8 0 4 4 0 018 0zm6 3a4 4 0 10-8 0" />
                    </svg>
                    <span class="text-sm font-semibold" :class="role === 'personal' ? 'text-brand-700' : 'text-slate-600'">Personal</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1.5" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Tu nombre completo" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1.5" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="tucorreo@ejemplo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1.5"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1.5"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center py-3 mt-2">
            {{ __('Register') }}
        </x-primary-button>

        <p class="text-center text-sm text-slate-500 pt-2">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}" class="text-brand-600 hover:text-brand-700 font-semibold">Inicia sesión</a>
        </p>
    </form>
</x-guest-layout>

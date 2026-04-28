<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan email terdaftar" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="form-label mb-0">Password</label>
                @if (Route::has('password.request'))
                    <a class="auth-link font-normal" href="{{ route('password.request') }}" style="font-size: 0.75rem;">
                        Lupa Password?
                    </a>
                @endif
            </div>
            <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="mb-6 flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary focus:ring-primary shadow-sm" name="remember">
            <label for="remember_me" class="ml-2 text-xs text-gray-600">Ingat saya di perangkat ini</label>
        </div>

        <button type="submit" class="btn-auth">
            Masuk Sekarang
        </button>

        <div class="mt-6 text-center">
            <span class="text-gray-500 text-xs">Belum punya akun?</span>
            <a class="auth-link ml-1" href="{{ route('register') }}">
                Daftar Calon Siswa
            </a>
        </div>
    </form>
</x-guest-layout>

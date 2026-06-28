<x-guest-layout>
    {{-- Status Sesi --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Indikator Debugging: Baris ini untuk memastikan file ini yang tampil --}}
    <div class="hidden">v.2026-06-28</div>

    <h2 class="text-xl font-bold mb-4 text-center">Persuratan ATR/BPN</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Pilihan Role --}}
        <div class="mb-4">
            <x-input-label :value="__('Pilih Akses Masuk')" />
            <div class="grid grid-cols-3 gap-2 mt-2">
                <button type="button" onclick="setRole('admin')" id="btn-admin" class="py-2 text-sm font-semibold rounded border transition bg-gray-100">Admin</button>
                <button type="button" onclick="setRole('pegawai')" id="btn-pegawai" class="py-2 text-sm font-semibold rounded border transition bg-gray-100">Pegawai</button>
                <button type="button" onclick="setRole('umum')" id="btn-umum" class="py-2 text-sm font-semibold rounded border transition bg-gray-100">Umum</button>
            </div>
            <input type="hidden" name="login_as" id="selected-role" value="umum">
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Tombol & Lupa Password --}}
        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-indigo-600 underline transition" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        {{-- Link Register --}}
        <div class="mt-6 text-center text-sm text-gray-600">
            {{ __('Belum punya akun?') }}
            <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">
                {{ __('Daftar di sini') }}
            </a>
        </div>
    </form>

    <script>
        function setRole(role) {
            document.getElementById('selected-role').value = role;
            const buttons = ['admin', 'pegawai', 'umum'];
            buttons.forEach(r => {
                const btn = document.getElementById('btn-' + r);
                if(btn) {
                    if(r === role) {
                        btn.classList.add('bg-blue-600', 'text-white', 'border-blue-600');
                        btn.classList.remove('bg-gray-100');
                    } else {
                        btn.classList.remove('bg-blue-600', 'text-white', 'border-blue-600');
                        btn.classList.add('bg-gray-100');
                    }
                }
            });
        }
        // Pastikan default role ter-set
        setRole('umum');
    </script>
</x-guest-layout>
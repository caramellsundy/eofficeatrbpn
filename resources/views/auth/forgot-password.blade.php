<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa password? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan reset password agar Anda dapat memilih password baru.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-8 border-t pt-6 text-center">
        <p class="text-sm text-gray-600 font-semibold mb-3">
            {{ __('Atau jika Anda tidak memiliki akses email:') }}
        </p>
        
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <p class="text-sm text-gray-700">
                {{ __('Hubungi Helpdesk Admin ATR/BPN untuk reset manual:') }}
            </p>
            <div class="mt-3 flex justify-center items-center gap-2">
                <span class="text-gray-500 text-sm">WhatsApp:</span>
                <a href="https://wa.me/628123456789" target="_blank" class="text-green-600 font-bold hover:underline transition">
                    0812-3456-789
                </a>
            </div>
            <p class="text-xs text-gray-500 mt-3">
                {{ __('Pastikan Anda menyiapkan NIP atau bukti identitas lainnya.') }}
            </p>
        </div>
    </div>

    <div class="mt-6 text-center text-sm text-gray-600">
        <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">
            {{ __('Kembali ke halaman login') }}
        </a>
    </div>
</x-guest-layout>
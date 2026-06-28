<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persuratan ATR/BPN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex h-screen">

    <aside class="w-64 bg-white border-r border-gray-200 p-4 flex flex-col">
        <div class="mb-8 font-bold text-xl text-blue-600 px-4">Persuratan ATR/BPN</div>
        
        <nav class="space-y-1 flex-1">
            @php $role = auth()->user()->role; @endphp

            @if($role == 'admin')
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Dashboard</x-nav-link>
                <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')">Manajemen Pengguna</x-nav-link>
                <x-nav-link :href="route('admin.laporan')" :active="request()->routeIs('admin.laporan')">Laporan Surat</x-nav-link>
                <x-nav-link :href="route('admin.settings')" :active="request()->routeIs('admin.settings')">Pengaturan Sistem</x-nav-link>
            
            @elseif($role == 'pegawai')
                <x-nav-link :href="route('pegawai.dashboard')" :active="request()->routeIs('pegawai.dashboard')">Dashboard</x-nav-link>
                <x-nav-link :href="route('pegawai.surat.index')" :active="request()->routeIs('pegawai.surat.index')">Surat Masuk</x-nav-link>
                <x-nav-link :href="route('pegawai.surat.keluar')" :active="request()->routeIs('pegawai.surat.keluar')">Surat Keluar</x-nav-link>
                <x-nav-link :href="route('pegawai.surat.disposisi')" :active="request()->routeIs('pegawai.surat.disposisi')">Disposisi</x-nav-link>
            
            @elseif($role == 'umum')
                <x-nav-link :href="route('dashboard.umum')" :active="request()->routeIs('dashboard.umum')">Dashboard</x-nav-link>
                <x-nav-link href="#" :active="false">Profil Instansi</x-nav-link>
                <x-nav-link :href="route('umum.cari.form')" :active="request()->routeIs('umum.cari.form')">Cari Berkas</x-nav-link>
                <x-nav-link href="#" :active="false">Cari Layanan</x-nav-link>
            @endif
        </nav>

        <div class="border-t pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 rounded">
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow-sm py-4 px-8 border-b">
            <h2 class="font-semibold text-gray-800">Selamat datang, {{ auth()->user()->name }}</h2>
        </header>

        <main class="flex-1 p-8 overflow-y-auto">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
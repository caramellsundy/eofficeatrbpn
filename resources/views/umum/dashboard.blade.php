<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Umum') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openModal: false, selectedSurat: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white p-6 shadow sm:rounded-lg mb-6">
                <h3 class="text-lg font-bold mb-4 text-gray-800">Aktivitas Surat Saya</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="py-3 px-4">Nomor Surat</th>
                                <th class="py-3 px-4">Judul</th>
                                <th class="py-3 px-4">Tanggal</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($surats as $surat)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="py-3 px-4">{{ $surat->nomor_surat }}</td>
                                    <td class="py-3 px-4">{{ $surat->judul_surat }}</td>
                                    <td class="py-3 px-4">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ ucfirst($surat->status) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <button @click="openModal = true; selectedSurat = {{ json_encode($surat) }}" 
                                                class="text-gray-500 hover:text-blue-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-gray-500">Belum ada aktivitas surat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <a href="{{ route('umum.cari.form') }}" class="bg-white p-6 shadow sm:rounded-lg flex items-center justify-between hover:shadow-lg transition">
                    <div>
                        <h4 class="font-bold text-gray-800">Cari Berkas</h4>
                        <p class="text-sm text-gray-500">Telusuri dokumen dan arsip surat Anda</p>
                    </div>
                    <span class="text-blue-600">→</span>
                </a>

                <a href="#" class="bg-white p-6 shadow sm:rounded-lg flex items-center justify-between hover:shadow-lg transition">
                    <div>
                        <h4 class="font-bold text-gray-800">Cari Layanan Surat</h4>
                        <p class="text-sm text-gray-500">Lihat berbagai jenis layanan surat tersedia</p>
                    </div>
                    <span class="text-blue-600">→</span>
                </a>
            </div> 

            <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4" style="display: none;">
                <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm" @click="openModal = false"></div>
                <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 relative z-[101]" x-show="openModal">
                    <div class="flex justify-between items-center mb-6 border-b pb-3">
                        <h2 class="text-xl font-bold text-gray-800">Detail Aktivitas</h2>
                        <button @click="openModal = false" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                    </div>
                    
                    <div class="space-y-4">
                        <div><label class="text-xs text-gray-500 uppercase font-semibold">Nomor Surat</label><p class="font-medium text-gray-900" x-text="selectedSurat.nomor_surat"></p></div>
                        <div><label class="text-xs text-gray-500 uppercase font-semibold">Tanggal</label><p class="font-medium text-gray-900" x-text="selectedSurat.tanggal_surat"></p></div>
                        <div><label class="text-xs text-gray-500 uppercase font-semibold">Judul</label><p class="font-medium text-gray-900" x-text="selectedSurat.judul_surat"></p></div>
                        <div><label class="text-xs text-gray-500 uppercase font-semibold">Status</label><p class="font-medium text-blue-600 capitalize" x-text="selectedSurat.status"></p></div>
                    </div>

                    <div class="mt-8">
                        <button @click="openModal = false" class="w-full bg-gray-100 border border-gray-200 text-gray-700 py-2 rounded-md hover:bg-gray-200 font-semibold transition">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
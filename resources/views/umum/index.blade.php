<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Surat Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm border border-gray-200 rounded-lg overflow-hidden">
                <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
                    <h1 class="text-lg font-bold text-white uppercase tracking-wide">Riwayat Surat Anda</h1>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-3">No</th>
                                    <th class="px-6 py-3">Nomor Surat</th>
                                    <th class="px-6 py-3">Perihal / Judul</th>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($surats as $index => $surat)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">{{ $surats->firstItem() + $index }}</td>
                                        <td class="px-6 py-4 font-bold text-gray-800">{{ $surat->nomor_surat }}</td>
                                        <td class="px-6 py-4">{{ $surat->perihal ?? $surat->judul_surat }}</td>
                                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs font-bold uppercase">
                                                {{ $surat->status ?? 'Aktif' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 italic">
                                            Belum ada data surat yang ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $surats->links() }}
                    </div>
                </div>
            </div>
            
            <div class="mt-6">
                <a href="{{ route('dashboard.umum') }}" 
                   class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600 transition font-bold shadow-sm">
                    KEMBALI KE DASHBOARD
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
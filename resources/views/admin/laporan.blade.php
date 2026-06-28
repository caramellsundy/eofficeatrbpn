<x-sidebar-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Laporan Surat</h2>
                    
                    {{-- Aksi Tambahan --}}
                    <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                        Cetak PDF
                    </a>
                </div>

                {{-- Tabel Data Surat --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-3 border">No. Surat</th>
                                <th class="p-3 border">Perihal</th>
                                <th class="p-3 border">Tanggal Masuk</th>
                                <th class="p-3 border">Tanggal Keluar</th>
                                <th class="p-3 border">Pengirim</th>
                                <th class="p-3 border text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Contoh Data --}}
                            <tr>
                                <td class="p-3 border">SRT/2026/001</td>
                                <td class="p-3 border">Permohonan Sertifikat Tanah</td>
                                <td class="p-3 border">26/06/2026</td>
                                <td class="p-3 border">28/06/2026</td>
                                <td class="p-3 border">Budi Santoso</td>
                                <td class="p-3 border text-center">
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Selesai</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-3 border">SRT/2026/002</td>
                                <td class="p-3 border">Pengajuan Balik Nama</td>
                                <td class="p-3 border">25/06/2026</td>
                                <td class="p-3 border">27/06/2026</td>
                                <td class="p-3 border">Siti Aminah</td>
                                <td class="p-3 border text-center">
                                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Proses</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-sidebar-layout>
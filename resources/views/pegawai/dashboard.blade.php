<x-sidebar-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto">
            
            {{-- Statistik Cepat --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-blue-600 p-6 rounded-lg shadow text-white">
                    <div class="text-sm opacity-80">Surat Masuk</div>
                    <div class="text-3xl font-bold mt-1">12</div>
                </div>
                <div class="bg-green-600 p-6 rounded-lg shadow text-white">
                    <div class="text-sm opacity-80">Surat Keluar</div>
                    <div class="text-3xl font-bold mt-1">8</div>
                </div>
                <div class="bg-purple-600 p-6 rounded-lg shadow text-white">
                    <div class="text-sm opacity-80">Perlu Disposisi</div>
                    <div class="text-3xl font-bold mt-1">3</div>
                </div>
            </div>

            {{-- Pesan Selamat Datang & Pengumuman --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Halo, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600 text-sm">Panel kontrol Pegawai. Silakan pantau aktivitas surat terbaru Anda melalui dashboard ini.</p>
                </div>
                
                {{-- Kotak Pengumuman --}}
                <div class="bg-yellow-50 p-6 rounded-lg shadow-sm border border-yellow-200">
                    <h3 class="text-lg font-bold text-yellow-800 flex items-center">
                        <span class="mr-2">📢</span> Pengumuman
                    </h3>
                    <ul class="text-sm text-yellow-700 mt-2 list-disc list-inside space-y-1">
                        <li>Jadwal pengarsipan bulanan dilakukan pada tanggal 30.</li>
                        <li>Sistem akan maintenance pada jam 22:00 WIB.</li>
                    </ul>
                </div>
            </div>

            {{-- Tabel Aktivitas Terbaru --}}
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <h3 class="font-bold text-gray-800 mb-4">Aktivitas Surat Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-sm text-gray-500 border-b">
                                <th class="pb-3">No. Surat</th>
                                <th class="pb-3">Perihal</th>
                                <th class="pb-3">Status</th>
                                <th class="pb-3">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <tr class="border-b">
                                <td class="py-3 font-medium">SRT/2026/001</td>
                                <td class="py-3">Permohonan Sertifikat Tanah</td>
                                <td class="py-3"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Menunggu</span></td>
                                <td class="py-3 text-gray-500">2 jam lalu</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 font-medium">SRT/2026/002</td>
                                <td class="py-3">Pengajuan Balik Nama</td>
                                <td class="py-3"><span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Selesai</span></td>
                                <td class="py-3 text-gray-500">5 jam lalu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-sidebar-layout>
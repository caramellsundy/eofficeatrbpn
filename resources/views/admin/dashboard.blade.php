<x-sidebar-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto">
            
            {{-- Statistik Cepat: Tambahkan mb-8 agar tidak mepet dengan elemen di bawahnya --}}
            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500 font-medium">Total Pengguna</div>
                        <div class="text-3xl font-bold text-gray-800">{{ $data['totalUser'] ?? 0 }}</div>
                    </div>
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500 font-medium">Total Surat</div>
                        <div class="text-3xl font-bold text-gray-800">{{ $data['totalSurat'] ?? 0 }}</div>
                    </div>
                    <div class="p-3 bg-green-100 text-green-600 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <div class="text-sm text-gray-500 font-medium">Perlu Ditinjau</div>
                        <div class="text-3xl font-bold text-gray-800">{{ $data['suratBaru'] ?? 0 }}</div>
                    </div>
                    <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                </div>
            </div>

            {{-- Ringkasan Aktivitas & Log Sistem: Tambahkan mb-8 --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 h-full">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Aktivitas</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Surat Terselesaikan</span>
                                <span class="font-bold">{{ $data['persentaseSelesai'] ?? 0 }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $data['persentaseSelesai'] ?? 0 }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Pengguna Aktif</span>
                                <span class="font-bold">{{ $data['persentaseUser'] ?? 0 }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-600 h-2 rounded-full" style="width: {{ $data['persentaseUser'] ?? 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 h-full">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Log Sistem Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600">
                            <thead class="text-xs uppercase bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2">Waktu</th>
                                    <th class="px-4 py-2">Pengguna</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data['logs'] ?? [] as $log)
                                <tr class="border-b">
                                    <td class="px-4 py-3">{{ $log->created_at->diffForHumans() }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $log->user->name ?? 'Sistem' }}</td>
                                    <td class="px-4 py-3">{{ $log->action }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-4 text-center italic text-gray-400">Belum ada aktivitas tercatat.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Daftar Surat Terbaru: Tambahkan mb-8 --}}
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Daftar Surat Terbaru</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($data['latestSurats'] ?? [] as $surat)
                    <a href="{{ route('admin.surat.show', $surat->id) }}" 
                       class="block border-l-4 {{ $surat->is_priority ? 'border-red-500 bg-red-50' : 'border-green-500 bg-green-50' }} p-4 rounded shadow-sm hover:shadow-md transition">
                        <div class="flex justify-between items-center">
                            <span class="{{ $surat->is_priority ? 'text-red-700' : 'text-green-700' }} font-bold text-sm uppercase">
                                {{ $surat->is_priority ? 'Prioritas' : 'Diproses Otomatis' }}
                            </span>
                            <span class="text-xs text-gray-500">{{ $surat->created_at->diffForHumans() }}</span>
                        </div>
                        <h4 class="font-bold mt-1 text-gray-800">{{ $surat->nomor_surat }}</h4>
                    </a>
                    @empty
                    <p class="col-span-2 text-center text-gray-500 p-4">Tidak ada data surat terbaru.</p>
                    @endforelse
                </div>
            </div>

            {{-- Informasi Operasional --}}
            <div class="bg-indigo-50 p-6 rounded-lg border border-indigo-100">
                <h3 class="text-indigo-900 font-bold">Informasi Operasional</h3>
                <p class="text-indigo-700 text-sm mt-1">Pastikan selalu melakukan backup database secara berkala melalui menu Pengaturan Sistem untuk menjaga keamanan data surat.</p>
            </div>
        </div>
    </div>
</x-sidebar-layout>
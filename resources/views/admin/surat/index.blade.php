<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Manajemen Data Surat (Admin)</h2>

            <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Info Surat</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($surats as $surat)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="font-bold text-sm text-gray-900">{{ $surat->nomor_surat }}</div>
                                            <div class="text-xs text-gray-500 max-w-[150px] truncate">{{ $surat->judul_surat }}</div>
                                        </div>
                                        @if($surat->is_priority)
                                            <span class="ml-2 px-2 py-0.5 bg-red-100 text-red-700 text-[9px] font-bold rounded-full uppercase">Prioritas</span>
                                        @endif
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4">
                                    @php
                                        $status = strtolower(trim($surat->status));
                                    @endphp
                                    @if($status == 'pending' || $status == 'menunggu')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-md text-[10px] font-bold uppercase">Menunggu</span>
                                    @elseif($status == 'approved')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-md text-[10px] font-bold uppercase">Disetujui</span>
                                    @else
                                        <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-md text-[10px] font-bold uppercase">{{ $surat->status }}</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 flex justify-center items-center gap-3">
                                    <a href="{{ route('admin.surat.show', $surat->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold text-xs mr-2" title="Tinjau Detail">Tinjau</a>

                                    <form action="{{ route('admin.surat.approve', $surat->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:text-green-900 font-bold {{ $status == 'approved' ? 'opacity-30 cursor-not-allowed' : '' }}" 
                                            title="Setujui" {{ $status == 'approved' ? 'disabled' : '' }}>
                                            ✅
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('admin.surat.edit', $surat->id) }}" class="text-blue-600 hover:text-blue-900" title="Edit">✏️</a>
                                    
                                    <form action="{{ route('admin.surat.destroy', $surat->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">🗑️</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-gray-500 italic">
                                    Tidak ada data surat yang ditemukan dengan filter ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    {{-- Menambahkan Paginasi agar data yang banyak tetap rapi --}}
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $surats->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
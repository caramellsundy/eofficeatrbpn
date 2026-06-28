<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm border border-gray-200 rounded-lg overflow-hidden">
                
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-gray-700">Pencetakan Lembar Disposisi</h2>
                    <form action="{{ route('disposisi.index') }}" method="GET" class="w-64">
                        <input type="text" name="search" placeholder="Pencarian..." 
                               class="w-full border-gray-300 rounded-md shadow-sm text-sm"
                               value="{{ request('search') }}">
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-[11px] font-bold">
                            <tr>
                                <th class="p-4 border-b">#</th>
                                <th class="p-4 border-b">Tanggal Surat</th>
                                <th class="p-4 border-b">Nomor Surat</th>
                                <th class="p-4 border-b">Nomor Agenda</th>
                                <th class="p-4 border-b">Asal Surat</th>
                                <th class="p-4 border-b">Perihal</th>
                                <th class="p-4 border-b">Tanggal Terima</th>
                                <th class="p-4 border-b text-center">Cetak</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($surats as $index => $surat)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 text-gray-500">{{ $index + 1 }}</td>
                                <td class="p-4 text-gray-700">{{ $surat->tanggal_surat }}</td>
                                <td class="p-4 text-gray-700">{{ $surat->nomor_surat }}</td>
                                <td class="p-4 text-gray-700">{{ $surat->nomor_agenda }}</td>
                                <td class="p-4 text-gray-700">{{ $surat->asal_surat }}</td>
                                <td class="p-4 text-gray-700 max-w-xs truncate">{{ $surat->perihal }}</td>
                                <td class="p-4 text-gray-500 text-xs">{{ $surat->created_at->format('d M Y') }}<br>{{ $surat->created_at->format('H:i') }}</td>
                                <td class="p-4 text-center">
                                    <a href="{{ route('disposisi.cetak', $surat->id) }}" 
                                       class="text-red-700 hover:text-red-900 text-lg">
                                       <i class="fas fa-print"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="p-6 text-center text-gray-500">Data tidak ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4 border-t border-gray-100">
                    {{ $surats->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
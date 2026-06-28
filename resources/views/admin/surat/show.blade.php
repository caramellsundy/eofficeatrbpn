<x-app-layout>
    {{-- Container utama agar sejajar dengan navbar atas --}}
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            
        {{-- Header Bar --}}
        <div class="flex justify-between items-center mb-6 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <h2 class="text-xl font-bold text-gray-800">Detail Peninjauan Surat</h2>
            <a href="{{ route('admin.dashboard') }}" class="text-sm bg-gray-100 px-4 py-2 rounded-lg hover:bg-gray-200 transition font-medium text-gray-700">
                &larr; Kembali ke Dashboard
            </a>
        </div>

        {{-- Stepper Progress --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-6">
            <div class="flex justify-between items-center text-center">
                @foreach(['Belum Diproses', 'Diproses Otomatis', 'Ditinjau', 'Selesai'] as $index => $step)
                    <div class="flex-1 relative">
                        <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center font-bold {{ $index == 0 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                            {{ $index + 1 }}
                        </div>
                        <p class="text-xs mt-2 font-medium {{ $index == 0 ? 'text-blue-600' : 'text-gray-400' }}">{{ $step }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Grid Utama --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">
            
            {{-- Kolom Kiri: Informasi & Tindakan --}}
            <div class="lg:col-span-1 flex flex-col gap-6">
                {{-- Informasi Surat dengan logika Prioritas --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border-2 {{ $surat->is_priority ? 'border-red-500 bg-red-50' : 'border-gray-100' }}">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="font-bold text-gray-700 border-b pb-2 w-full">Informasi Surat</h3>
                        @if($surat->is_priority)
                            <span class="ml-2 px-2 py-1 bg-red-600 text-white text-[10px] font-bold rounded uppercase">Prioritas</span>
                        @endif
                    </div>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-bold">Nomor Surat</p>
                            <p class="text-sm font-semibold text-gray-800">{{ $surat->nomor_surat }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-bold">Status</p>
                            <span class="inline-block px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-bold mt-1">{{ $surat->status }}</span>
                        </div>
                    </div>
                </div>

                {{-- Form Aksi --}}
                <form action="#" method="POST" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col flex-grow">
                    @csrf
                    <h3 class="font-bold text-gray-700 mb-4">Keputusan Admin</h3>
                    <textarea name="catatan" class="w-full border-gray-200 rounded-lg bg-gray-50 mb-4 flex-grow" placeholder="Tambahkan catatan untuk pegawai..."></textarea>
                    <div class="grid grid-cols-2 gap-3">
                        <button type="submit" name="aksi" value="setuju" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition">
                            Setujui
                        </button>
                        <button type="submit" name="aksi" value="tolak" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition">
                            Tolak
                        </button>
                    </div>
                </form>
            </div>

            {{-- Kolom Kanan: Pratinjau Dokumen --}}
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 h-full flex flex-col">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-gray-700">Pratinjau Dokumen</h3>
                        <span class="text-[10px] text-gray-400 bg-gray-100 px-2 py-1 rounded">Maks 5 MB (PDF)</span>
                    </div>
                    
                    <div class="flex-grow border-2 border-dashed border-gray-200 rounded-lg overflow-hidden bg-gray-50 flex items-center justify-center">
                        @if(!empty($surat->file_path))
                            <iframe src="{{ asset('storage/' . $surat->file_path) }}" class="w-full h-full" type="application/pdf"></iframe>
                        @else
                            <p class="text-sm text-gray-400">Tidak ada dokumen dilampirkan</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
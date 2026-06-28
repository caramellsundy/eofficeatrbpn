<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
                
                {{-- Header Section --}}
                <div class="px-6 py-4 border-b border-gray-100">
                    <h1 class="text-lg font-bold text-gray-800 uppercase tracking-wide">
                        EDIT SURAT {{ strtoupper($type) }}
                    </h1>
                    <p class="text-xs text-gray-500 mt-0.5">Ubah data surat {{ $type }} pada formulir di bawah ini</p>
                </div>

                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded-lg border border-red-200 text-sm">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="list-disc ml-5 mt-1">
                                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pegawai.surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="jenis_surat" value="{{ $type }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            
                            @if($type === 'masuk')
                                {{-- Form Edit Surat Masuk --}}
                                <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Asal Surat*:</label><input type="text" name="asal_surat" value="{{ old('asal_surat', $surat->asal_surat) }}" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                                <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Judul Surat*:</label><input type="text" name="judul_surat" value="{{ old('judul_surat', $surat->judul_surat) }}" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                                <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Kode Surat*:</label><input type="text" name="kode_surat" value="{{ old('kode_surat', $surat->kode_surat) }}" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                                <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Nomor Surat*:</label><input type="text" name="nomor_surat" value="{{ old('nomor_surat', $surat->nomor_surat) }}" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                                <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Tanggal Surat*:</label><input type="date" name="tanggal_surat" value="{{ old('tanggal_surat', $surat->tanggal_surat) }}" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                                <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Metode:</label>
                                    <select name="metode" class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2">
                                        @foreach(['Pos', 'Email', 'Loket'] as $m)<option value="{{ $m }}" {{ old('metode', $surat->metode) == $m ? 'selected' : '' }}>{{ $m }}</option>@endforeach
                                    </select>
                                </div>
                            @else
                                {{-- Form Edit Surat Keluar (Sama dengan Tambah) --}}
                                <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Nomor Surat*:</label><input type="text" name="nomor_surat" value="{{ old('nomor_surat', $surat->nomor_surat) }}" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                                <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Tanggal Surat*:</label><input type="date" name="tanggal_surat" value="{{ old('tanggal_surat', $surat->tanggal_surat) }}" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                                <div class="md:col-span-2 space-y-1"><label class="block text-xs font-bold text-gray-700">Perihal*:</label><textarea name="perihal" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2">{{ old('perihal', $surat->perihal) }}</textarea></div>
                                
                                {{-- Bagian Kirim --}}
                                <div class="md:col-span-2 mt-4 border-t pt-4">
                                    <h2 class="text-sm font-bold text-blue-600 mb-3">KIRIM KE</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Unit Kerja*:</label>
                                            <select name="unit_kerja" class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2 select-filter">
                                                <option value="">Pilih Unit Kerja...</option>
                                                <option value="1" {{ $surat->unit_kerja == 1 ? 'selected' : '' }}>Sekretariat</option>
                                            </select>
                                        </div>
                                        <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Jabatan*:</label>
                                            <select name="jabatan" class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2 select-filter">
                                                <option value="">Pilih Jabatan...</option>
                                                <option value="1" {{ $surat->jabatan == 1 ? 'selected' : '' }}>Kepala Bagian</option>
                                            </select>
                                        </div>
                                        <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Pegawai*:</label>
                                            <select name="pegawai" class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2 select-filter">
                                                <option value="">Cari Pegawai...</option>
                                                <option value="1" {{ $surat->pegawai == 1 ? 'selected' : '' }}>Agus Purwanto</option>
                                            </select>
                                        </div>
                                        <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Redaksi*:</label>
                                            <select name="redaksi" class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2">
                                                <option value="hormat" {{ $surat->redaksi == 'hormat' ? 'selected' : '' }}>Hormat Kami</option>
                                                <option value="salam" {{ $surat->redaksi == 'salam' ? 'selected' : '' }}>Salam Takzim</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Dokumen --}}
                            <div class="md:col-span-2 space-y-1 mt-4">
                                <label class="block text-xs font-bold text-gray-700">Ganti Dokumen (PDF, Max 5MB):</label>
                                <input type="file" name="dokumen" accept=".pdf" class="w-full text-sm text-gray-500 border border-gray-300 rounded-lg p-1">
                                @if($surat->file_path)
                                    <p class="text-[10px] text-gray-400 mt-1">File saat ini: {{ basename($surat->file_path) }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex justify-end items-center gap-3 pt-4 border-t">
                            <a href="{{ route('pegawai.surat.index', ['type' => $type]) }}" class="px-5 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-semibold">BATAL</a>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold shadow-md">UPDATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
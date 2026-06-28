<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
                
                <div class="px-6 py-4 border-b border-gray-100">
                    <h1 class="text-lg font-bold text-gray-800 uppercase tracking-wide">
                        BUAT {{ strtoupper($type == 'disposisi' ? 'Lembar Disposisi' : 'Surat ' . $type) }}
                    </h1>
                </div>

                <div class="p-6">
                    <form action="{{ route('pegawai.surat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="jenis_surat" value="{{ $type }}">

                        @if($type == 'disposisi')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Nomor Agenda*:</label><input type="text" name="nomor_agenda" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                                <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Nomor Surat*:</label><input type="text" name="nomor_surat" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                                <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Asal Surat*:</label><input type="text" name="asal_surat" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                                <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Tanggal Surat*:</label><input type="date" name="tanggal_surat" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                                <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Tanggal Terima*:</label><input type="date" name="tanggal_terima" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                                <div class="md:col-span-2 space-y-1"><label class="block text-xs font-bold text-gray-700">Perihal*:</label><textarea name="perihal" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></textarea></div>
                            </div>

                            {{-- BAGIAN DITERUSKAN KEPADA --}}
                            <div class="mt-6 border-t pt-4" id="section-disposisi">
                                <h2 class="text-sm font-bold text-blue-600 mb-3">SURAT INI DITERUSKAN KEPADA:</h2>
                                <div class="space-y-3">
                                    <div class="flex gap-4 mb-3">
                                        <label class="flex items-center text-xs font-bold"><input type="radio" name="kategori_tujuan" value="jabatan" checked class="mr-2"> JABATAN</label>
                                        <label class="flex items-center text-xs font-bold"><input type="radio" name="kategori_tujuan" value="personal" class="mr-2"> PERSONAL</label>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <select id="select_unit" name="unit_kerja" class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"><option value="">Pilih Unit Kerja...</option><option value="1">Biro Umum</option></select>
                                        <select id="select_jabatan" name="jabatan" class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"><option value="">Pilih Jabatan...</option><option value="1">Kepala Bagian</option></select>
                                        <select id="select_pegawai" name="pegawai" class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"><option value="">Cari Pegawai...</option><option value="1">Lusi Komala Sari, S.SiT, M.A.P.</option></select>
                                    </div>
                                    <button type="button" onclick="autoFill()" class="mt-2 text-[10px] bg-green-600 text-white px-2 py-1 rounded shadow cursor-pointer">✓ Tambah otomatis dari Unit Kerja</button>
                                </div>
                                
                                {{-- Tabel Tujuan --}}
                                <div class="mt-4 overflow-x-auto">
                                    <table class="w-full text-xs text-left border">
                                        <thead class="bg-gray-50"><tr><th class="p-2 border">Jabatan</th><th class="p-2 border">Pegawai</th><th class="p-2 border">Hapus</th></tr></thead>
                                        <tbody id="table-tujuan"><tr><td class="p-2 border">Kepala Bagian Tata Naskah</td><td class="p-2 border">Lusi Komala Sari, S.SiT, M.A.P.</td><td class="p-2 border text-center text-red-500 cursor-pointer">🗑</td></tr></tbody>
                                    </table>
                                </div>
                            </div>
                        @elseif($type == 'keluar')
                            {{-- ... (Form Surat Keluar Tetap Sama) ... --}}
                        @else
                            <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Asal Surat*:</label><input type="text" name="asal_surat" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                            <div class="space-y-1"><label class="block text-xs font-bold text-gray-700">Judul Surat*:</label><input type="text" name="judul_surat" required class="w-full border-gray-300 rounded-lg shadow-sm text-sm p-2"></div>
                        @endif

                        <div class="md:col-span-2 space-y-1 mt-4">
                            <label class="block text-xs font-bold text-gray-700">File Surat (PDF, Max 5MB)*:</label>
                            <input type="file" name="dokumen" class="w-full text-sm text-gray-500 border border-gray-300 rounded-lg p-1">
                        </div>

                        <div class="flex justify-end items-center gap-3 pt-4 border-t">
                            <a href="{{ route('pegawai.surat.index', ['type' => $type]) }}" class="px-5 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-semibold">BATAL</a>
                            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg text-sm font-semibold">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function autoFill() {
            const unit = document.getElementById('select_unit').options[document.getElementById('select_unit').selectedIndex].text;
            const jabatan = document.getElementById('select_jabatan').options[document.getElementById('select_jabatan').selectedIndex].text;
            const pegawai = document.getElementById('select_pegawai').options[document.getElementById('select_pegawai').selectedIndex].text;
            
            if(unit !== 'Pilih Unit Kerja...') {
                const tbody = document.getElementById('table-tujuan');
                tbody.innerHTML += `<tr><td class="p-2 border">${jabatan}</td><td class="p-2 border">${pegawai}</td><td class="p-2 border text-center text-red-500 cursor-pointer">🗑</td></tr>`;
            } else {
                alert('Pilih unit kerja terlebih dahulu!');
            }
        }
    </script>
</x-app-layout>
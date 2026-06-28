<x-app-layout>
    <div class="py-12" x-data="{ open: {{ isset($hasil) ? 'true' : 'false' }} }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm border border-gray-300 rounded-lg">
                <div class="bg-blue-600 px-6 py-4 rounded-t-lg">
                    <h1 class="text-lg font-bold text-white uppercase tracking-wide">Cari Berkas Internal</h1>
                </div>

                <div class="p-6">
                    <form action="{{ route('layanan.cari-berkas') }}" method="GET" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block font-semibold text-gray-700 mb-2">Nomor Berkas:</label>
                                <input type="text" name="nomor_berkas" value="{{ request('nomor_berkas') }}" required 
                                    class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            
                            <div>
                                <label class="block font-semibold text-gray-700 mb-2">Kantor:</label>
                                <select name="kantor_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Kantor --</option>
                                    <option value="barito_utara">Kantor Pertanahan Kabupaten Barito Utara</option>
                                    <option value="hulu_sungai">Kantor Pertanahan Kabupaten Hulu Sungai Tengah</option>
                                    <option value="lhokseumawe">Kantor Pertanahan Kota Lhokseumawe</option>
                                    <option value="mentawai">Kantor Pertanahan Kabupaten Kepulauan Mentawai</option>
                                    <option value="nagekeo">Kantor Pertanahan Kabupaten Nagekeo</option>
                                    <option value="bulungan">Kantor Pertanahan Kabupaten Bulungan</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block font-semibold text-gray-700 mb-2">Tahun:</label>
                                <select name="tahun" class="w-full border-gray-300 rounded-md shadow-sm">
                                    @for ($year = date('Y'); $year >= 2020; $year--)
                                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="border border-gray-200 p-4 rounded-md bg-gray-50 flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" disabled class="w-6 h-6 mr-3">
                                <span class="text-gray-600">I'm not a robot</span>
                            </div>
                            <span class="text-xs text-gray-400">reCAPTCHA</span>
                        </div>

                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-yellow-500 text-white px-12 py-2 rounded-md hover:bg-yellow-600 transition font-bold uppercase">
                                Cari Berkas
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if(isset($hasil))
<div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900 bg-opacity-50">
    <div @click.away="open = false" class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <h3 class="text-lg font-bold text-gray-800">Detail Berkas</h3>
            <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>

        @if($hasil)
            <div class="space-y-4">
                <p><strong>Nomor Surat:</strong> {{ $hasil->nomor_surat }}</p>
                <p><strong>Kantor:</strong> {{ $hasil->kantor_id }}</p>
                <p><strong>Status:</strong> <span class="text-green-600 font-semibold">Ditemukan</span></p>
            </div>
        @else
            <p class="text-red-500 text-center py-4">Data tidak ditemukan.</p>
        @endif

        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ route('dashboard.umum') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
               Kembali ke Dashboard
            </a>
            <button @click="open = false" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Tutup</button>
        </div>
    </div>
</div>
@endif
        </div>
    </div>
</x-app-layout>
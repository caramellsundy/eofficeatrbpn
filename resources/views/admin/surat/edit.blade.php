<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                    Edit Data Surat
                </h2>
            </div>

            <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-gray-200">
                {{-- Pastikan route ini sesuai dengan Route Name di web.php --}}
                <form action="{{ route('admin.surat.update', $surat->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Surat</label>
                            <input type="text" name="nomor_surat" value="{{ old('nomor_surat', $surat->nomor_surat) }}" 
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul / Perihal Surat</label>
                            <input type="text" name="judul_surat" value="{{ old('judul_surat', $surat->judul_surat) }}" 
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status Verifikasi</label>
                            <select name="status" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="pending" {{ $surat->status == 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                                <option value="approved" {{ $surat->status == 'approved' ? 'selected' : '' }}>Disetujui (Approved)</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-8 pt-6 border-t">
                        <a href="{{ route('admin.surat.index') }}" class="px-5 py-2.5 text-gray-600 hover:bg-gray-100 rounded-lg">Batal</a>
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
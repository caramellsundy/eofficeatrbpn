<x-sidebar-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <h2 class="text-xl font-bold mb-6">Pengaturan Sistem</h2>

                <form action="#" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Pengaturan Umum --}}
                        <div class="space-y-4">
                            <h3 class="font-semibold text-gray-700 border-b pb-2">Informasi Instansi</h3>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Nama Instansi</label>
                                <input type="text" value="ATR/BPN Kantor Wilayah" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Alamat Email Sistem</label>
                                <input type="email" value="admin@atrbpn.go.id" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>

                        {{-- Pengaturan Backup --}}
                        <div class="space-y-4">
                            <h3 class="font-semibold text-gray-700 border-b pb-2">Pemeliharaan Data</h3>
                            <div class="p-4 bg-gray-50 rounded-md border">
                                <p class="text-sm text-gray-600 mb-3">Backup database secara rutin untuk menjaga keamanan data surat.</p>
                                <button type="button" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 text-sm">
                                    Download Backup Database
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-sidebar-layout>
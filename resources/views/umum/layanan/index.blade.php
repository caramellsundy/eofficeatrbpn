<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-100 text-center">
                
                <h1 class="text-2xl font-bold text-yellow-500 mb-4">Mudah Daftar, Mudah Dapatkan Layanan!</h1>
                
                <p class="text-gray-600 mb-8">
                    Ingin mengurus layanan pertanahan dengan cepat dan mudah? Daftarkan diri Anda sekarang dan nikmati akses penuh ke berbagai layanan pertanahan secara online! semua proses kini lebih praktis dan transparan. Dengan beberapa langkah sederhana, Anda dapat mengakses layanan kapan saja dan di mana saja!
                </p>

                <div class="flex justify-center mb-6">
                    <svg class="w-24 h-24 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>

                <div class="relative">
                    <select name="layanan" class="w-full p-4 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 appearance-none bg-white cursor-pointer">
                        <option value="" disabled selected>Pilih Layanan</option>
                        <option value="jual_beli">Jual Beli</option>
                        <option value="tukar_menukar">Tukar Menukar</option>
                        <option value="warisan">Warisan</option>
                        <option value="lelang">Lelang</option>
                        <option value="pembagian_hak">Pembagian Hak Bersama</option>
                        <option value="pemecahan">Pemecahan</option>
                        <option value="penggabungan">Penggabungan</option>
                        <option value="konversi">Konversi</option>
                        <option value="wakaf">Wakaf</option>
                        <option value="pemberian_hak">Pemberian Hak Milik Perorangan</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
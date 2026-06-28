<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cari Layanan Pertanahan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg border border-gray-200">
                
                {{-- Gambar diperkecil menjadi 64px (w-16 h-16) --}}
                <div class="text-center mb-6">
                    <img src="https://cdn-icons-png.flaticon.com/512/2910/2910791.png" 
                         class="w-16 h-16 mx-auto object-contain" 
                         alt="Icon Layanan">
                </div>
                
                <form id="form-cari-layanan" action="{{ route('layanan.cari-layanan') }}" method="GET">
                    <div class="mb-6">
                        <label for="layanan" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Jenis Layanan</label>
                        <select id="layanan" name="layanan" class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm p-3" required>
                            <option value="" disabled {{ !request('layanan') ? 'selected' : '' }}>-- Pilih Layanan --</option>
                            <option value="jual_beli" {{ request('layanan') == 'jual_beli' ? 'selected' : '' }}>Jual Beli</option>
                            <option value="pewarisan" {{ request('layanan') == 'pewarisan' ? 'selected' : '' }}>Pewarisan</option>
                            <option value="tukar_menukar" {{ request('layanan') == 'tukar_menukar' ? 'selected' : '' }}>Tukar Menukar</option>
                            <option value="lelang" {{ request('layanan') == 'lelang' ? 'selected' : '' }}>Lelang</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition font-medium">
                            CARI LAYANAN
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
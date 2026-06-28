<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pencarian Berkas') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ isChecked: false }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Formulir Cari Berkas</h3>
                    
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 font-medium">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-medium">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('umum.cari.proses') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pilih Kantor</label>
                                <select name="kantor" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Kantor Layanan...</option>
                                    <option value="Jakarta">Kantor Pertanahan Jakarta</option>
                                    <option value="Bogor">Kantor Pertanahan Bogor</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nomor Berkas</label>
                                <input type="text" name="nomor_berkas" required placeholder="Masukkan nomor berkas" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tahun</label>
                                <select name="tahun" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="2026">2026</option>
                                    <option value="2025">2025</option>
                                    <option value="2024">2024</option>
                                </select>
                            </div>

                            <div class="flex items-center">
                                <div @click="isChecked = !isChecked" 
                                     class="border border-gray-300 rounded px-4 py-3 flex items-center justify-between w-full bg-[#f9f9f9] cursor-pointer hover:bg-gray-50 transition">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 border-2 border-gray-400 rounded-sm flex items-center justify-center mr-3"
                                             :class="isChecked ? 'bg-blue-600 border-blue-600' : 'bg-white'">
                                            <svg x-show="isChecked" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <span class="text-gray-700 text-sm font-medium">I'm not a robot</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <img src="https://www.gstatic.com/recaptcha/api2/logo_48.png" class="w-8 h-8 opacity-70" alt="reCAPTCHA">
                                        <span class="text-[10px] text-gray-500">reCAPTCHA</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" 
                                    :disabled="!isChecked" 
                                    class="w-full bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-bold py-3 px-4 rounded-md transition duration-200">
                                Cari Berkas Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
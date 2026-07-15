@extends('layouts.admin')

@section('title', 'Profil')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Profil Saya
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Kelola informasi akun dan keamanan akun Anda.
        </p>
    </div>

    {{-- Informasi Profil --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">

        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Informasi Profil
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Perbarui nama dan email akun Anda.
            </p>
        </div>

        <div class="p-6">

            @include('profile.partials.update-profile-information-form')

        </div>

    </div>

    {{-- Password --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">

        <div class="border-b border-gray-200 px-6 py-4">

            <h2 class="text-lg font-semibold text-gray-800">
                Ubah Password
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Gunakan password yang kuat agar akun tetap aman.
            </p>

        </div>

        <div class="p-6">

            @include('profile.partials.update-password-form')

        </div>

    </div>

    {{-- Hapus Akun --}}
    <div class="bg-white rounded-xl shadow-sm border border-red-200">

        <div class="border-b border-red-100 px-6 py-4">

            <h2 class="text-lg font-semibold text-red-600">
                Hapus Akun
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Menghapus akun bersifat permanen dan tidak dapat dibatalkan.
            </p>

        </div>

        <div class="p-6">

            @include('profile.partials.delete-user-form')

        </div>

    </div>

</div>

@endsection
@props(['active' => false])

@php
// Mengatur kelas dasar: jika aktif, beri warna biru/tebal; jika tidak, warna abu-abu standar
$classes = ($active ?? false)
            ? 'block px-4 py-2 text-blue-700 bg-blue-50 border-l-4 border-blue-600 font-bold transition duration-150 ease-in-out'
            : 'block px-4 py-2 text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
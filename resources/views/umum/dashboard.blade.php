@extends('layouts.umum')

@section('title', 'Dashboard Umum')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-umum.css') }}">
@endpush

@section('content')

<div class="dashboard-page">

    <div class="container-fluid">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}
        @include('umum.dashboard.header')



        



        



        {{-- ========================================================= --}}
        {{-- INFORMASI ATR/BPN --}}
        {{-- ========================================================= --}}
        @include('umum.dashboard.informasi')



        {{-- ========================================================= --}}
        {{-- RIWAYAT SURAT --}}
        {{-- ========================================================= --}}
        @include('umum.dashboard.riwayat')




    </div>

</div>

@endsection


@push('scripts')

<script src="{{ asset('js/dashboard-umum.js') }}"></script>

@endpush
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>

        @yield('title','Dashboard')

        | E-Office ATR/BPN

    </title>

    {{-- ========================================================= --}}
    {{-- Bootstrap --}}
    {{-- ========================================================= --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    {{-- ========================================================= --}}
    {{-- Bootstrap Icons --}}
    {{-- ========================================================= --}}

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">

    {{-- ========================================================= --}}
    {{-- Google Font --}}
    {{-- ========================================================= --}}

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    {{-- ========================================================= --}}
    {{-- Laravel Assets --}}
    {{-- ========================================================= --}}

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    {{-- ========================================================= --}}
    {{-- Dashboard CSS --}}
    {{-- ========================================================= --}}

    <link rel="stylesheet"
          href="{{ asset('css/dashboard-admin.css') }}">

    @stack('styles')

</head>

<body>

<div class="admin-layout">

    {{-- ========================================================= --}}
    {{-- SIDEBAR --}}
    {{-- ========================================================= --}}

    <aside
        class="sidebar"
        id="sidebar">

        {{-- ===================================================== --}}
        {{-- LOGO --}}
        {{-- ===================================================== --}}

        <div class="sidebar-logo">

            <div class="logo-icon">

                <i class="bi bi-buildings-fill"></i>

            </div>

            <div class="logo-text">

                <h3>

                    E-OFFICE

                </h3>

                <small>

                    ATR / BPN

                </small>

            </div>

        </div>

        {{-- ===================================================== --}}
        {{-- USER --}}
        {{-- ===================================================== --}}

        <div class="sidebar-user">

            <div class="avatar">

                {{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}

            </div>

            <div>

                <h6 class="mb-0">

                    {{ auth()->user()->name }}

                </h6>

                <small>

                    Administrator

                </small>

            </div>

        </div>

        {{-- ===================================================== --}}
        {{-- MENU --}}
        {{-- ===================================================== --}}

        <nav class="sidebar-menu">

            <span class="menu-title">

                MENU UTAMA

            </span>

            <a
                href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                <i class="bi bi-speedometer2"></i>

                <span>

                    Dashboard

                </span>

            </a>

            <span class="menu-title">

                MASTER DATA

            </span>

            <a
                href="{{ route('admin.pegawai.index') }}"
                class="{{ request()->routeIs('admin.pegawai.*') ? 'active' : '' }}">

                <i class="bi bi-person-badge-fill"></i>

                <span>

                    Data Pegawai

                </span>

            </a>
                        @if(Route::has('admin.jabatan.index'))

                <a
                    href="{{ route('admin.jabatan.index') }}"
                    class="{{ request()->routeIs('admin.jabatan.*') ? 'active' : '' }}">

                    <i class="bi bi-diagram-3-fill"></i>

                    <span>

                        Data Jabatan

                    </span>

                </a>

            @endif

            @if(Route::has('admin.unit.kerja.index'))

<a
    href="{{ route('admin.unit.kerja.index') }}"
    class="{{ request()->routeIs('admin.unit.kerja.*') ? 'active' : '' }}">

    <i class="bi bi-building-fill"></i>

    <span>Data Unit Kerja</span>

</a>

@endif

            {{-- ===================================================== --}}
            {{-- PERSURATAN --}}
            {{-- ===================================================== --}}

            <span class="menu-title">

                PERSURATAN

            </span>

            <a
                href="{{ route('admin.surat.masuk.index') }}"
                class="{{ request()->routeIs('admin.surat.masuk.*') ? 'active' : '' }}">

                <i class="bi bi-envelope-arrow-down-fill"></i>

                <span>

                    Surat Masuk

                </span>

                @if(($__mn = \App\Models\Surat::where('jenis_surat','masuk')->where('status','menunggu')->count()) > 0)

                    <span class="menu-badge bg-warning text-dark">{{ $__mn }}</span>

                @endif

            </a>

            <a
                href="{{ route('admin.surat.keluar.index') }}"
                class="{{ request()->routeIs('admin.surat.keluar.*') ? 'active' : '' }}">

                <i class="bi bi-envelope-arrow-up-fill"></i>

                <span>

                    Surat Keluar

                </span>

            </a>

            <a
                href="{{ route('admin.disposisi.index') }}"
                class="{{ request()->routeIs('admin.disposisi.*') ? 'active' : '' }}">

                <i class="bi bi-send-fill"></i>

                <span>

                    Disposisi

                </span>

            </a>

            {{-- ===================================================== --}}
            {{-- LAPORAN --}}
            {{-- ===================================================== --}}

            @if(Route::has('admin.laporan.index'))

                <span class="menu-title">

                    LAPORAN

                </span>

                <a
                    href="{{ route('admin.laporan.index') }}"
                    class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">

                    <i class="bi bi-file-earmark-bar-graph-fill"></i>

                    <span>

                        Laporan Surat

                    </span>

                </a>

            @endif

            {{-- ===================================================== --}}
            {{-- AKUN --}}
            {{-- ===================================================== --}}

            <span class="menu-title">

                AKUN

            </span>

            <a href="{{ route('profile.edit') }}">

                <i class="bi bi-person-circle"></i>

                <span>

                    Profil Saya

                </span>

            </a>

            <div class="sidebar-footer">

                <form
                    action="{{ route('logout') }}"
                    method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="btn-logout">

                        <i class="bi bi-box-arrow-right"></i>

                        <span>

                            Logout

                        </span>

                    </button>

                </form>

            </div>

        </nav>

    </aside>

    {{-- ========================================================= --}}
    {{-- MAIN WRAPPER --}}
    {{-- ========================================================= --}}

    <div class="main-wrapper">
                {{-- ========================================================= --}}
        {{-- TOPBAR --}}
        {{-- ========================================================= --}}

        <header class="topbar">

            {{-- ========================= --}}
            {{-- LEFT --}}
            {{-- ========================= --}}

            <div class="topbar-left">

                <button
                    class="toggle-sidebar"
                    id="toggleSidebar"
                    type="button">

                    <i class="bi bi-list"></i>

                </button>

                <div class="page-title">

                    <h4>

                        @yield('title','Dashboard')

                    </h4>

                    <small>

                        Selamat datang kembali,

                        <strong>

                            {{ auth()->user()->name }}

                        </strong>

                    </small>

                </div>

            </div>

            {{-- ========================= --}}
            {{-- RIGHT --}}
            {{-- ========================= --}}

            <div class="topbar-right">

                {{-- Tanggal --}}

                <div class="topbar-date">

                    <i class="bi bi-calendar-event"></i>

                    <span>

                        {{ now()->translatedFormat('l, d F Y') }}

                    </span>

                </div>

                {{-- Notifikasi --}}

                <button
                    class="topbar-icon"
                    type="button">

                    <i class="bi bi-bell-fill"></i>

                </button>

                {{-- User Dropdown --}}

                <div class="dropdown">

                    <button
                        class="topbar-user border-0 bg-transparent"
                        data-bs-toggle="dropdown"
                        type="button">

                        <div class="avatar">

                            {{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}

                        </div>

                        <div class="text-start">

                            <strong>

                                {{ auth()->user()->name }}

                            </strong>

                            <small>

                                Administrator

                            </small>

                        </div>

                        <i class="bi bi-chevron-down ms-2"></i>

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end user-dropdown">

                        <li class="user-dropdown-header">

                            <div class="user-dropdown-avatar">

                                {{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}

                            </div>

                            <h6>

                                {{ auth()->user()->name }}

                            </h6>

                            <small>

                                {{ auth()->user()->email }}

                            </small>

                        </li>

                        <li>

                            <a
                                class="dropdown-item"
                                href="{{ route('profile.edit') }}">

                                <i class="bi bi-person-circle"></i>

                                Profil Saya

                            </a>

                        </li>

                        <li>

                            <hr class="dropdown-divider">

                        </li>

                        <li>

                            <form
                                action="{{ route('logout') }}"
                                method="POST">

                                @csrf

                                <button
                                    class="dropdown-item"
                                    type="submit">

                                    <i class="bi bi-box-arrow-right"></i>

                                    Logout

                                </button>

                            </form>

                        </li>

                    </ul>

                </div>

            </div>

        </header>

        {{-- ========================================================= --}}
        {{-- CONTENT --}}
        {{-- ========================================================= --}}

        <main class="content">

            <div class="content-wrapper">
                                {{-- ========================================================= --}}
                {{-- BREADCRUMB --}}
                {{-- ========================================================= --}}

                @hasSection('breadcrumb')

                    <nav
                        aria-label="breadcrumb"
                        class="mb-4">

                        <ol class="breadcrumb">

                            @yield('breadcrumb')

                        </ol>

                    </nav>

                @endif

                {{-- ========================================================= --}}
                {{-- SUCCESS --}}
                {{-- ========================================================= --}}

                @if(session('success'))

                    <div
                        class="alert alert-success alert-dismissible fade show">

                        <i class="bi bi-check-circle-fill"></i>

                        <div class="flex-grow-1">

                            {{ session('success') }}

                        </div>

                        <button
                            class="btn-close"
                            data-bs-dismiss="alert"
                            type="button">

                        </button>

                    </div>

                @endif

                {{-- ========================================================= --}}
                {{-- ERROR --}}
                {{-- ========================================================= --}}

                @if(session('error'))

                    <div
                        class="alert alert-danger alert-dismissible fade show">

                        <i class="bi bi-x-circle-fill"></i>

                        <div class="flex-grow-1">

                            {{ session('error') }}

                        </div>

                        <button
                            class="btn-close"
                            data-bs-dismiss="alert"
                            type="button">

                        </button>

                    </div>

                @endif

                {{-- ========================================================= --}}
                {{-- WARNING --}}
                {{-- ========================================================= --}}

                @if(session('warning'))

                    <div
                        class="alert alert-warning alert-dismissible fade show">

                        <i class="bi bi-exclamation-triangle-fill"></i>

                        <div class="flex-grow-1">

                            {{ session('warning') }}

                        </div>

                        <button
                            class="btn-close"
                            data-bs-dismiss="alert"
                            type="button">

                        </button>

                    </div>

                @endif

                {{-- ========================================================= --}}
                {{-- INFO --}}
                {{-- ========================================================= --}}

                @if(session('info'))

                    <div
                        class="alert alert-info alert-dismissible fade show">

                        <i class="bi bi-info-circle-fill"></i>

                        <div class="flex-grow-1">

                            {{ session('info') }}

                        </div>

                        <button
                            class="btn-close"
                            data-bs-dismiss="alert"
                            type="button">

                        </button>

                    </div>

                @endif

                {{-- ========================================================= --}}
                {{-- VALIDATION ERROR --}}
                {{-- ========================================================= --}}

                @if($errors->any())

                    <div class="alert alert-warning">

                        <i class="bi bi-exclamation-circle-fill"></i>

                        <div class="flex-grow-1">

                            <strong>

                                Terdapat kesalahan input.

                            </strong>

                            <ul class="mt-2 mb-0">

                                @foreach($errors->all() as $error)

                                    <li>

                                        {{ $error }}

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                @endif

                {{-- ========================================================= --}}
                {{-- PAGE CONTENT --}}
                {{-- ========================================================= --}}

                <div class="fade-up">

                    @yield('content')

                </div>
    </div>

            
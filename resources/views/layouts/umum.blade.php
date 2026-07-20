<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>

        @yield('title') | E-Office ATR/BPN

    </title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    {{-- Google Font --}}
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    {{-- ========================= --}}
    {{-- SWIPER CSS --}}
    {{-- ========================= --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    {{-- Laravel --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- Dashboard CSS --}}
    <link rel="stylesheet"
          href="{{ asset('css/dashboard-umum.css') }}">

    @stack('styles')

</head>

<body>

<div class="wrapper">

    {{-- ========================= --}}
    {{-- SIDEBAR --}}
    {{-- ========================= --}}

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">

            <div class="logo-circle">

                <i class="bi bi-buildings-fill"></i>

            </div>

            <div>

                <h4 class="mb-0">

                    E-Office

                </h4>

                <small>

                    Administrasi Digital

                </small>

            </div>

        </div>

        <div class="sidebar-menu">

            <span class="sidebar-title">

                Dashboard

            </span>

            <a href="{{ route('umum.dashboard') }}"
               class="{{ request()->routeIs('umum.dashboard') ? 'active' : '' }}">

                <i class="bi bi-speedometer2"></i>

                Dashboard

            </a>

            <span class="sidebar-title">

                Persuratan

            </span>

            <a href="{{ route('umum.surat.index') }}"
               class="{{ request()->routeIs('umum.surat.*') ? 'active' : '' }}">

                <i class="bi bi-envelope-paper-fill"></i>

                Surat Saya

            </a>

            <a href="{{ route('umum.cari.form') }}"
               class="{{ request()->routeIs('umum.cari.*') ? 'active' : '' }}">

                <i class="bi bi-search"></i>

                Cari Berkas

            </a>

            <a href="{{ route('umum.layanan.index') }}"
               class="{{ request()->routeIs('umum.layanan.*') ? 'active' : '' }}">

                <i class="bi bi-journal-bookmark-fill"></i>

                Layanan

            </a>

            <span class="sidebar-title">

                Akun

            </span>

            <a href="{{ route('profile.edit') }}">

                <i class="bi bi-person-circle"></i>

                Profil Saya

            </a>

            <form action="{{ route('logout') }}"
                  method="POST"
                  class="mt-3">

                @csrf

                <button type="submit"
                        class="logout-btn">

                    <i class="bi bi-box-arrow-right"></i>

                    Logout

                </button>

            </form>

        </div>

    </aside>

    {{-- ========================= --}}
    {{-- MAIN --}}
    {{-- ========================= --}}

    <main class="main-content">

        {{-- ========================= --}}
        {{-- TOPBAR --}}
        {{-- ========================= --}}

        <header class="topbar">

            <div class="topbar-left">

                <button class="menu-toggle"
                        id="menuToggle">

                    <i class="bi bi-list"></i>

                </button>

                <div>

                    <h3 class="mb-0">

                        @yield('title')

                    </h3>

                    <small class="text-muted">

                        Sistem Informasi Persuratan ATR/BPN

                    </small>

                </div>

            </div>

            <div class="topbar-right">

                <div class="user-box">

                    <div class="avatar">

                        {{ strtoupper(substr(auth()->user()->name ?? 'U',0,1)) }}

                    </div>

                    <div>

                        <strong>

                            {{ auth()->user()->name }}

                        </strong>

                        <br>

                        <small>

                            Masyarakat Umum

                        </small>

                    </div>

                </div>

            </div>

        </header>

        {{-- ========================= --}}
        {{-- CONTENT --}}
        {{-- ========================= --}}

        <section class="page-content">

            @yield('content')

        </section>

        {{-- ========================= --}}
        {{-- FOOTER --}}
        {{-- ========================= --}}

        <footer class="footer">

            <div>

                © {{ date('Y') }} E-Office ATR/BPN

            </div>

            <div>

                Kementerian Agraria dan Tata Ruang /
                Badan Pertanahan Nasional

            </div>

        </footer>

    </main>

</div>

{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- ========================= --}}
{{-- SWIPER JS --}}
{{-- ========================= --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

{{-- Dashboard JS --}}
<script src="{{ asset('js/dashboard-umum.js') }}"></script>

@stack('scripts')

</body>

</html>

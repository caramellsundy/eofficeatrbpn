{{-- ===========================================================
    HEADER DASHBOARD
=========================================================== --}}

@php
    $user = auth()->user();
@endphp

<div class="dashboard-header mb-4">

    <div class="row align-items-center">

        <div class="col-lg-8">

            <div class="hero-content">

                <span class="hero-badge">
                    <i class="bi bi-buildings-fill"></i>
                    E-OFFICE ATR/BPN
                </span>

                <h2 class="hero-title">
                    Dashboard Masyarakat Umum
                </h2>

                <p class="hero-text">

                    Selamat datang,

                    <strong>
                        {{ $user?->name ?? 'Pengguna' }}
                    </strong>

                    di Sistem Informasi Persuratan
                    Kementerian Agraria dan Tata Ruang /
                    Badan Pertanahan Nasional.

                    Melalui dashboard ini Anda dapat
                    memantau status surat,
                    mencari berkas,
                    melihat informasi layanan,
                    serta memperoleh informasi terbaru
                    mengenai ATR/BPN.

                </p>

                <div class="hero-button mt-4">

                    <a href="{{ route('umum.surat.index') }}"
                       class="btn btn-primary rounded-pill">

                        <i class="bi bi-envelope-paper-fill"></i>

                        Surat Saya

                    </a>

                    <a href="{{ route('umum.cari.form') }}"
                       class="btn btn-outline-primary rounded-pill">

                        <i class="bi bi-search"></i>

                        Cari Berkas

                    </a>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="hero-card shadow-sm">

                <div class="hero-date">

                    <i class="bi bi-calendar-event-fill"></i>

                    <div>

                        <small>Hari Ini</small>

                        <h5>

                            {{ now()->translatedFormat('l') }}

                        </h5>

                        <strong>

                            {{ now()->translatedFormat('d F Y') }}

                        </strong>

                    </div>

                </div>

                <hr>

                <div class="hero-user">

                    <div class="avatar">

                        {{ strtoupper(substr($user?->name ?? 'U',0,1)) }}

                    </div>

                    <div>

                        <h6 class="mb-0">

                            {{ $user?->name ?? 'Guest' }}

                        </h6>

                        <small>

                            Masyarakat Umum

                        </small>

                    </div>

                </div>

                <hr>

                <div class="hero-info">

                    <span>

                        <i class="bi bi-envelope-paper"></i>

                        Total Surat

                    </span>

                    <strong>

                        {{ $totalSurat ?? 0 }}

                    </strong>

                </div>

                <div class="hero-info">

                    <span>

                        <i class="bi bi-check-circle"></i>

                        Surat Selesai

                    </span>

                    <strong>

                        {{ $selesai ?? 0 }}

                    </strong>

                </div>

                <div class="hero-info">

                    <span>

                        <i class="bi bi-hourglass-split"></i>

                        Diproses

                    </span>

                    <strong>

                        {{ $diproses ?? 0 }}

                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>
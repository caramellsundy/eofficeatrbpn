{{-- ===========================================================
    STATISTIK DASHBOARD UMUM
=========================================================== --}}

<div class="row g-4 mb-5">

    {{-- Total Surat --}}
    <div class="col-xl-3 col-md-6">

        <div class="stat-card bg-primary text-white">

            <div class="stat-icon">

                <i class="bi bi-envelope-paper-fill"></i>

            </div>

            <div class="stat-content">

                <small>Total Surat</small>

                <h2>{{ $totalSurat }}</h2>

                <p class="mb-0">

                    Seluruh surat yang telah diajukan.

                </p>

            </div>

        </div>

    </div>

    {{-- Diproses --}}
    <div class="col-xl-3 col-md-6">

        <div class="stat-card bg-warning text-dark">

            <div class="stat-icon">

                <i class="bi bi-hourglass-split"></i>

            </div>

            <div class="stat-content">

                <small>Sedang Diproses</small>

                <h2>{{ $diproses }}</h2>

                <p class="mb-0">

                    Surat sedang diperiksa petugas.

                </p>

            </div>

        </div>

    </div>

    {{-- Selesai --}}
    <div class="col-xl-3 col-md-6">

        <div class="stat-card bg-success text-white">

            <div class="stat-icon">

                <i class="bi bi-check-circle-fill"></i>

            </div>

            <div class="stat-content">

                <small>Surat Selesai</small>

                <h2>{{ $selesai }}</h2>

                <p class="mb-0">

                    Surat telah selesai diproses.

                </p>

            </div>

        </div>

    </div>

    {{-- Ditolak --}}
    <div class="col-xl-3 col-md-6">

        <div class="stat-card bg-danger text-white">

            <div class="stat-icon">

                <i class="bi bi-x-circle-fill"></i>

            </div>

            <div class="stat-content">

                <small>Surat Ditolak</small>

                <h2>{{ $ditolak }}</h2>

                <p class="mb-0">

                    Surat tidak dapat diproses.

                </p>

            </div>

        </div>

    </div>

</div>

{{-- ===========================================================
    RINGKASAN STATUS
=========================================================== --}}

<div class="row mb-5">

    <div class="col-lg-8">

        <div class="card dashboard-card shadow-sm border-0 h-100">

            <div class="card-header bg-white">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-bar-chart-fill text-primary"></i>

                    Ringkasan Status Surat

                </h5>

            </div>

            <div class="card-body">

                @php

                    $total = max($totalSurat,1);

                    $persenDiproses = round(($diproses/$total)*100);

                    $persenSelesai  = round(($selesai/$total)*100);

                    $persenDitolak  = round(($ditolak/$total)*100);

                @endphp

                {{-- Diproses --}}

                <div class="mb-4">

                    <div class="d-flex justify-content-between">

                        <strong>Diproses</strong>

                        <span>{{ $persenDiproses }}%</span>

                    </div>

                    <div class="progress mt-2" style="height:10px;">

                        <div class="progress-bar bg-warning"

                             style="width:{{ $persenDiproses }}%">

                        </div>

                    </div>

                </div>

                {{-- Selesai --}}

                <div class="mb-4">

                    <div class="d-flex justify-content-between">

                        <strong>Selesai</strong>

                        <span>{{ $persenSelesai }}%</span>

                    </div>

                    <div class="progress mt-2" style="height:10px;">

                        <div class="progress-bar bg-success"

                             style="width:{{ $persenSelesai }}%">

                        </div>

                    </div>

                </div>

                {{-- Ditolak --}}

                <div>

                    <div class="d-flex justify-content-between">

                        <strong>Ditolak</strong>

                        <span>{{ $persenDitolak }}%</span>

                    </div>

                    <div class="progress mt-2" style="height:10px;">

                        <div class="progress-bar bg-danger"

                             style="width:{{ $persenDitolak }}%">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Informasi Singkat --}}

    <div class="col-lg-4">

        <div class="card dashboard-card shadow-sm border-0 h-100">

            <div class="card-header bg-white">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-info-circle-fill text-primary"></i>

                    Informasi

                </h5>

            </div>

            <div class="card-body">

                <div class="mb-3">

                    <i class="bi bi-check-circle-fill text-success"></i>

                    Pastikan seluruh data surat telah lengkap sebelum dikirim.

                </div>

                <div class="mb-3">

                    <i class="bi bi-clock-fill text-warning"></i>

                    Status surat akan berubah secara otomatis sesuai proses verifikasi.

                </div>

                <div class="mb-3">

                    <i class="bi bi-search text-primary"></i>

                    Gunakan menu Cari Berkas untuk melacak dokumen.

                </div>

                <div>

                    <i class="bi bi-envelope-paper text-danger"></i>

                    Semua riwayat surat dapat dilihat pada menu Surat Saya.

                </div>

            </div>

        </div>

    </div>

</div>
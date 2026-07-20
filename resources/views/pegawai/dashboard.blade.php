@extends('layouts.pegawai')

@section('title','Dashboard Pegawai')

@section('content')

<div class="container-fluid px-3 px-lg-4">

    {{-- ========================= --}}
    {{-- HEADER --}}
    {{-- ========================= --}}

    <div class="row g-4 mb-4">

        <div class="col-xl-8">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <h2 class="fw-bold mb-2">
                        Selamat Datang, {{ auth()->user()->name }} 👋
                    </h2>

                    <p class="text-muted mb-4 fs-5">
                        Selamat bekerja.
                        Kelola surat, disposisi, dan aktivitas harian Anda
                        melalui E-Office ATR/BPN.
                    </p>

                    <div class="d-flex flex-wrap gap-2">

                        <span class="badge rounded-pill bg-success px-4 py-3">

                            <i class="bi bi-calendar-event me-2"></i>

                            {{ now()->translatedFormat('l, d F Y') }}

                        </span>

                        <span class="badge rounded-pill bg-primary px-4 py-3">

                            <i class="bi bi-person-badge-fill me-2"></i>

                            Pegawai ATR/BPN

                        </span>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-4">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body text-center p-4">

                    <div class="avatar-dashboard mx-auto mb-3">

                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                    </div>

                    <h4 class="fw-bold mb-1">

                        {{ auth()->user()->name }}

                    </h4>

                    <div class="text-muted mb-3">

                        {{ auth()->user()->email }}

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-6">

                            <h3 class="fw-bold text-primary mb-0">

                                {{ $disposisiAktif }}

                            </h3>

                            <small class="text-muted">

                                Tugas Disposisi

                            </small>

                        </div>

                        <div class="col-6">

                            <h3 class="fw-bold text-success mb-0">

                                {{ $suratKeluar }}

                            </h3>

                            <small class="text-muted">

                                Surat Keluar

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- ========================= --}}
    {{-- STATISTIK --}}
    {{-- ========================= --}}

    <div class="row g-4 mb-5">

        {{-- Tugas Disposisi (aktif) --}}

        <div class="col-lg-3 col-md-6">

            <div class="card stat-card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <div class="text-muted">

                                Tugas Disposisi

                            </div>

                            <h2 class="fw-bold mt-3">

                                {{ $disposisiAktif }}

                            </h2>

                        </div>

                        <div class="stat-icon bg-primary">

                            <i class="bi bi-send-check-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- Surat Keluar --}}

        <div class="col-lg-3 col-md-6">

            <div class="card stat-card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <div class="text-muted">

                                Surat Keluar

                            </div>

                            <h2 class="fw-bold mt-3">

                                {{ $suratKeluar }}

                            </h2>

                        </div>

                        <div class="stat-icon bg-success">

                            <i class="bi bi-send-fill"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- Disposisi --}}

        <div class="col-lg-3 col-md-6">

            <div class="card stat-card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <div class="text-muted">

                                Disposisi

                            </div>

                            <h2 class="fw-bold mt-3">

                                {{ $disposisi }}

                            </h2>

                        </div>

                        <div class="stat-icon bg-warning">

                            <i class="bi bi-arrow-left-right"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- Menunggu --}}

        <div class="col-lg-3 col-md-6">

            <div class="card stat-card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <div class="text-muted">

                                Menunggu

                            </div>

                            <h2 class="fw-bold mt-3">

                                {{ $menunggu }}

                            </h2>

                        </div>

                        <div class="stat-icon bg-danger">

                            <i class="bi bi-hourglass-split"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- ========================================================= --}}
{{-- TUGAS HARI INI & AKTIVITAS --}}
{{-- ========================================================= --}}

<div class="row g-4 mb-5">

    {{-- ===================================================== --}}
    {{-- TUGAS HARI INI --}}
    {{-- ===================================================== --}}

    <div class="col-lg-6">

        <div class="card border-0 shadow-sm rounded-4 card-task h-100">

            <div class="card-header bg-white border-0 pt-4">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-list-task text-primary me-2"></i>

                    Tugas Hari Ini

                </h5>

            </div>

            <div class="card-body">

                @if($disposisiAktif > 0)

                    <a href="{{ route('pegawai.disposisi.index') }}"
                       class="btn btn-primary w-100 rounded-3 mb-3 py-3 d-flex justify-content-between align-items-center">

                        <span>

                            <i class="bi bi-send-check-fill me-2"></i>

                            Kerjakan Disposisi Anda

                        </span>

                        <span class="badge bg-white text-primary rounded-pill px-3">

                            {{ $disposisiAktif }}

                        </span>

                    </a>

                @endif

                <div class="list-group list-group-flush">

                    <div class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">

                        <div>

                            <i class="bi bi-envelope-check-fill text-danger me-2"></i>

                            Disposisi Hari Ini

                        </div>

                        <span class="badge bg-danger rounded-pill px-3">

                            {{ $disposisiBelum }}

                        </span>

                    </div>

                    <div class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">

                        <div>

                            <i class="bi bi-hourglass-split text-warning me-2"></i>

                            Surat Menunggu

                        </div>

                        <span class="badge bg-warning text-dark rounded-pill px-3">

                            {{ $menunggu }}

                        </span>

                    </div>

                    <div class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">

                        <div>

                            <i class="bi bi-exclamation-circle-fill text-primary me-2"></i>

                            Prioritas Tinggi

                        </div>

                        <span class="badge bg-primary rounded-pill px-3">

                            {{ $prioritasTinggi }}

                        </span>

                    </div>

                </div>

                <hr>

                @if($disposisiBelum==0 && $menunggu==0 && $prioritasTinggi==0)

                    <div class="text-center py-4">

                        <i class="bi bi-check-circle-fill text-success display-6"></i>

                        <h6 class="mt-3 fw-bold">

                            Tidak ada tugas hari ini

                        </h6>

                        <small class="text-muted">

                            Semua pekerjaan telah selesai.

                        </small>

                    </div>

                @else

                    <div class="alert alert-warning border-0 rounded-3 mb-0">

                        <i class="bi bi-info-circle-fill me-2"></i>

                        Kerjakan tugas dengan prioritas tinggi terlebih dahulu.

                    </div>

                @endif

            </div>

        </div>

    </div>



    {{-- ===================================================== --}}
    {{-- AKTIVITAS TERBARU --}}
    {{-- ===================================================== --}}

    <div class="col-lg-6">

        <div class="card border-0 shadow-sm rounded-4 card-activity h-100">

            <div class="card-header bg-white border-0 pt-4">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-clock-history text-success me-2"></i>

                    Aktivitas Terbaru

                </h5>

            </div>

            <div class="card-body">

                @forelse($aktivitasTerbaru as $item)

                    <div class="activity-item">

                        <div class="d-flex">

                            <div class="me-3">

                                <div class="activity-icon bg-{{ $item['warna'] }}">

                                    <i class="bi {{ $item['icon'] }}"></i>

                                </div>

                            </div>

                            <div class="flex-grow-1">

                                <div class="fw-semibold">

                                    {{ $item['judul'] }}

                                </div>

                                <div class="text-muted small">

                                    {{ $item['keterangan'] }}

                                </div>

                                <small class="text-primary">

                                    <i class="bi bi-clock"></i>

                                    {{ \Carbon\Carbon::parse($item['jam'])->format('d M Y • H:i') }}

                                </small>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-5">

                        <i class="bi bi-clock-history display-4 text-secondary"></i>

                        <h6 class="mt-3">

                            Belum ada aktivitas

                        </h6>

                        <small class="text-muted">

                            Aktivitas akan muncul ketika Anda mengirim surat
                            atau menerima disposisi.

                        </small>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

{{-- ========================================================= --}}
{{-- SURAT TERBARU & DISPOSISI TERBARU --}}
{{-- ========================================================= --}}

<div class="row g-4">

    {{-- ===================================================== --}}
    {{-- SURAT TERBARU --}}
    {{-- ===================================================== --}}

    <div class="col-lg-6">

        <div class="card border-0 shadow-sm rounded-4 card-surat h-100">

            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

                <h5 class="fw-bold mb-0">

                    <i class="bi bi-envelope-paper-fill text-primary me-2"></i>

                    Surat Terbaru

                </h5>

                <a href="{{ route('pegawai.surat-masuk.index') }}"
                   class="btn btn-sm btn-outline-primary rounded-pill">

                    Lihat Semua

                </a>

            </div>

            <div class="card-body p-0">

                @forelse($suratTerbaru as $surat)

                    <div class="p-3 border-bottom">

                        <div class="d-flex justify-content-between">

                            <div>

                                <h6 class="fw-bold mb-1">

                                    {{ $surat->nomor_surat }}

                                </h6>

                                <div class="text-muted small">

                                    {{ $surat->perihal }}

                                </div>

                                <small class="text-secondary">

                                    {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}

                                </small>

                            </div>

                            <div>

                                @php

                                    $warna='secondary';

                                    if(in_array($surat->status, ['draft', 'diajukan'])) $warna='warning';

                                    elseif($surat->status=='diverifikasi') $warna='success';

                                    elseif($surat->status=='selesai') $warna='success';

                                    elseif($surat->status=='dikembalikan') $warna='danger';

                                @endphp

                                <span class="badge bg-{{ $warna }}">

                                    {{ $surat->status_label }}

                                </span>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-5">

                        <i class="bi bi-inbox display-4 text-secondary"></i>

                        <h6 class="mt-3">

                            Belum ada surat.

                        </h6>

                    </div>

                @endforelse

            </div>

        </div>

    </div>



    {{-- ===================================================== --}}
{{-- DISPOSISI TERBARU --}}
{{-- ===================================================== --}}

<div class="col-lg-6">

    <div class="card border-0 shadow-sm rounded-4 card-disposisi h-100">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">

            <h5 class="fw-bold mb-0">

                <i class="bi bi-send text-success me-2"></i>

                Disposisi Terbaru

            </h5>


            <a href="{{ route('pegawai.disposisi.index') }}"
               class="btn btn-outline-success rounded-pill px-4">

                Lihat Semua

            </a>

        </div>


        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>NO SURAT</th>
                        <th>PRIORITAS</th>
                        <th>TANGGAL</th>
                        <th>STATUS</th>

                    </tr>

                </thead>


                <tbody>


                @forelse($disposisiTerbaru as $item)


                    <tr>


                        <td>

                            {{ optional($item->surat)->nomor_surat ?? '-' }}

                        </td>



                        <td>


                            @php

                                $prioritas = optional($item->disposisi)->prioritas;

                            @endphp


                            @if($prioritas == 'Tinggi')

                                <span class="badge bg-danger">
                                    Tinggi
                                </span>


                            @elseif($prioritas == 'Sedang')

                                <span class="badge bg-warning text-dark">
                                    Sedang
                                </span>


                            @else

                                <span class="badge bg-success">
                                    Rendah
                                </span>


                            @endif


                        </td>




                        <td>

                            {{ optional($item->disposisi)->tanggal_disposisi
                                ? \Carbon\Carbon::parse(
                                    $item->disposisi->tanggal_disposisi
                                  )->format('d M Y')
                                : '-'
                            }}

                        </td>




                        <td>


                            @if($item->status == 'Belum Dibaca')

                                <span class="badge bg-warning text-dark">

                                    Belum Dibaca

                                </span>


                            @elseif($item->status == 'Sudah Dibaca')

                                <span class="badge bg-primary">

                                    Sudah Dibaca

                                </span>


                            @elseif($item->status == 'Selesai')

                                <span class="badge bg-success">

                                    Selesai

                                </span>


                            @endif


                        </td>


                    </tr>



                @empty


                    <tr>

                        <td colspan="4" class="text-center py-5">


                            <i class="bi bi-send-x display-5 text-secondary"></i>


                            <h5 class="mt-3">

                                Belum ada disposisi.

                            </h5>


                            <p class="text-muted">

                                Disposisi yang diterima akan muncul di sini.

                            </p>


                        </td>

                    </tr>


                @endforelse



                </tbody>


            </table>


        </div>


    </div>


</div>

@endsection


@push('styles')

<style>

.dashboard-header{

    background:linear-gradient(135deg,#0d6efd,#3b82f6);

    color:white;

}

.avatar-dashboard{

    width:90px;

    height:90px;

    border-radius:50%;

    background:#0d6efd;

    color:#fff;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:38px;

    font-weight:bold;

}

.stat-card{

    transition:.3s;

    border-radius:18px;

}

.stat-card:hover{

    transform:translateY(-6px);

    box-shadow:0 15px 35px rgba(0,0,0,.08);

}

.stat-icon{

    width:60px;

    height:60px;

    border-radius:16px;

    color:white;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:24px;

}

.card-task,
.card-activity{

    min-height:370px;

}

.card-surat,
.card-disposisi{

    min-height:470px;

}

.activity-item{

    position:relative;

    padding-bottom:20px;

}

.activity-item:not(:last-child)::before{

    content:"";

    position:absolute;

    left:19px;

    top:42px;

    width:2px;

    height:45px;

    background:#dee2e6;

}

.activity-icon{

    width:40px;

    height:40px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    color:white;

}

.card-header{

    padding:18px 24px;

}

.table td{

    vertical-align:middle;

}

.border-bottom:last-child{

    border-bottom:none!important;

}

</style>

@endpush

@extends('layouts.admin')

@section('title','Dashboard')

@section('content')

<div class="container-fluid">


{{-- ================= HEADER ================= --}}
<div class="row mb-4">

    <div class="col-md-8">

        <h3 class="fw-bold text-primary">
            <i class="bi bi-speedometer2"></i>
            Dashboard Administrator
        </h3>

        <p class="text-muted">
            Selamat datang,
            <strong>{{ Auth::user()->name }}</strong>
            di Sistem Informasi E-Office ATR/BPN
        </p>

    </div>


    <div class="col-md-4 text-end">

        <span class="badge bg-primary p-3 fs-6">

            <i class="bi bi-calendar-event"></i>

            {{ now()->translatedFormat('l, d F Y') }}

        </span>

    </div>

</div>




{{-- ================= CARD STATISTIK ================= --}}

<div class="row g-4 mb-4">


<div class="col-xl-3 col-md-6">

<div class="card shadow-sm border-0">

<div class="card-body">

<div class="d-flex justify-content-between">


<div>

<small class="text-muted">
TOTAL USER
</small>


<h2 class="fw-bold">
{{ $totalUser }}
</h2>


</div>


<i class="bi bi-people-fill text-primary fs-1"></i>


</div>

</div>

</div>

</div>



<div class="col-xl-3 col-md-6">

<div class="card shadow-sm border-0">

<div class="card-body">

<div class="d-flex justify-content-between">


<div>

<small class="text-muted">
SURAT MASUK
</small>


<h2 class="fw-bold">
{{ $suratMasuk }}
</h2>


</div>


<i class="bi bi-envelope-fill text-success fs-1"></i>


</div>

</div>

</div>

</div>




<div class="col-xl-3 col-md-6">

<div class="card shadow-sm border-0">

<div class="card-body">


<div class="d-flex justify-content-between">


<div>

<small class="text-muted">
SURAT KELUAR
</small>


<h2 class="fw-bold">
{{ $suratKeluar }}
</h2>


</div>


<i class="bi bi-send-fill text-warning fs-1"></i>


</div>


</div>

</div>

</div>





<div class="col-xl-3 col-md-6">


<div class="card shadow-sm border-0">


<div class="card-body">


<div class="d-flex justify-content-between">


<div>


<small class="text-muted">
DISPOSISI
</small>


<h2 class="fw-bold">
{{ $totalDisposisi }}
</h2>


</div>


<i class="bi bi-share-fill text-danger fs-1"></i>


</div>


</div>


</div>


</div>


</div>






{{-- ================= GRAFIK + AKTIVITAS ================= --}}


<div class="row g-4">



<div class="col-lg-8">


<div class="card shadow-sm border-0">


<div class="card-header bg-white">


<h5 class="fw-bold">

<i class="bi bi-bar-chart text-primary"></i>

Grafik Surat {{ date('Y') }}

</h5>


</div>


<div class="card-body">


<canvas id="chartSurat"
height="120"></canvas>


</div>


</div>


</div>






<div class="col-lg-4">


<div class="card shadow-sm border-0">


<div class="card-header bg-white">


<h5 class="fw-bold">

<i class="bi bi-clock text-success"></i>

Aktivitas Hari Ini

</h5>


</div>



<div class="card-body">


<div class="mb-3">

<b>Surat Masuk</b>

<br>

<small class="text-muted">

{{ $suratMasukHariIni }}
surat diterima

</small>


</div>



<div class="mb-3">

<b>Surat Keluar</b>

<br>

<small class="text-muted">

{{ $suratKeluarHariIni }}
surat dikirim

</small>


</div>



<div class="mb-3">

<b>Disposisi</b>

<br>

<small class="text-muted">

{{ $disposisiHariIni }}
disposisi dibuat

</small>


</div>




<div>

<b>User Baru</b>

<br>

<small class="text-muted">

{{ $userHariIni }}
akun baru

</small>


</div>


</div>


</div>


</div>


</div>






{{-- ================= SURAT TERBARU ================= --}}


<div class="row mt-4">


<div class="col-lg-8">


<div class="card shadow-sm border-0">


<div class="card-header bg-white">


<h5 class="fw-bold">

<i class="bi bi-envelope-paper text-primary"></i>

Surat Terbaru

</h5>


</div>



<div class="table-responsive">


<table class="table table-hover mb-0">


<thead class="table-light">

<tr>

<th>No Surat</th>

<th>Perihal</th>

<th>Tanggal</th>

<th>Status</th>


</tr>


</thead>



<tbody>


@forelse($suratTerbaru as $surat)


<tr>


<td>
{{ $surat->nomor_surat }}
</td>


<td>
{{ $surat->perihal }}
</td>


<td>

{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}

</td>



<td>


<span class="badge bg-success">

{{ ucfirst($surat->status) }}

</span>


</td>



</tr>


@empty


<tr>

<td colspan="4" class="text-center">

Belum ada surat

</td>

</tr>


@endforelse



</tbody>


</table>


</div>


</div>


</div>





<div class="col-lg-4">


<div class="card shadow-sm border-0">


<div class="card-header bg-white">


<h5 class="fw-bold">

<i class="bi bi-pie-chart"></i>

Status Surat

</h5>


</div>



<div class="card-body">


<p>
Menunggu :
<b>{{ $menunggu }}</b>
</p>


<p>
Diproses :
<b>{{ $diproses }}</b>
</p>


<p>
Selesai :
<b>{{ $selesai }}</b>
</p>


</div>


</div>


</div>



</div>


</div>


@endsection
@extends('layouts.pegawai')

@section('title','Disposisi')

@section('content')

<div class="container-fluid">

    {{-- ===========================
        HEADER
    ============================ --}}
    <div class="page-header fade-up">

        <div>

            <h2>

                <i class="bi bi-diagram-3-fill text-primary me-2"></i>

                Disposisi

            </h2>

            <p class="text-muted mb-0">

                Daftar seluruh disposisi yang diterima pegawai.

            </p>

        </div>

    </div>



    {{-- ===========================
        ALERT
    ============================ --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif



    {{-- ===========================
        CARD STATISTIK
    ============================ --}}

    <div class="dashboard-grid">

        <div class="stat-card">

            <div>

                <span>Total Disposisi</span>

                <h3>

                    {{ $disposisi->total() }}

                </h3>

            </div>

            <div class="stat-icon primary">

                <i class="bi bi-files"></i>

            </div>

        </div>



        <div class="stat-card">

            <div>

                <span>Belum Dibaca</span>

                <h3>

                    {{ $disposisi->where('status','Belum Dibaca')->count() }}

                </h3>

            </div>

            <div class="stat-icon warning">

                <i class="bi bi-hourglass-split"></i>

            </div>

        </div>



        <div class="stat-card">

            <div>

                <span>Sudah Dibaca</span>

                <h3>

                    {{ $disposisi->where('status','Sudah Dibaca')->count() }}

                </h3>

            </div>

            <div class="stat-icon info">

                <i class="bi bi-arrow-repeat"></i>

            </div>

        </div>



        <div class="stat-card">

            <div>

                <span>Selesai</span>

                <h3>

                    {{ $disposisi->where('status','Selesai')->count() }}

                </h3>

            </div>

            <div class="stat-icon success">

                <i class="bi bi-check-circle-fill"></i>

            </div>

        </div>

    </div>



    {{-- ===========================
        TABLE CARD
    ============================ --}}

    <div class="table-card fade-up">

        <div class="table-header">

            <div>

                <h4>

                    <i class="bi bi-list-ul text-primary me-2"></i>

                    Daftar Disposisi

                </h4>

                <small>

                    Disposisi yang dikirim kepada Anda.

                </small>

            </div>

            <span class="badge bg-primary">

                {{ $disposisi->total() }} Disposisi

            </span>

        </div>



        {{-- ===========================
            SEARCH & FILTER
        ============================ --}}

        <div class="table-toolbar">

            <form
                method="GET"
                action="{{ route('pegawai.disposisi.index') }}"
                class="search-form">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    name="keyword"
                    value="{{ request('keyword') }}"
                    placeholder="Cari nomor surat / perihal...">

            </form>

            <form
                method="GET"
                action="{{ route('pegawai.disposisi.index') }}"
                class="filter-form">

                <input
                    type="hidden"
                    name="keyword"
                    value="{{ request('keyword') }}">

                <select
                    name="status"
                    class="form-select">

                    <option value="">

                        Semua Status

                    </option>

                    <option
                        value="Belum Dibaca"
                        {{ request('status')=='Belum Dibaca' ? 'selected':'' }}>

                        Belum Dibaca

                    </option>

                    <option
                        value="Sudah Dibaca"
                        {{ request('status')=='Sudah Dibaca' ? 'selected':'' }}>

                        Sudah Dibaca

                    </option>

                    <option
                        value="Selesai"
                        {{ request('status')=='Selesai' ? 'selected':'' }}>

                        Selesai

                    </option>

                </select>

                <button
                    class="btn btn-primary">

                    <i class="bi bi-funnel-fill"></i>

                </button>

            </form>

        </div>



        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th width="60">

                            No

                        </th>

                        <th>

                            Nomor Surat

                        </th>

                        <th>

                            Perihal

                        </th>

                        <th>

                            Pengirim

                        </th>

                        <th>

                            Tanggal

                        </th>

                        <th width="120">

                            Status

                        </th>

                        <th width="150">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($disposisi as $item)

                <tr>

    <td>

        {{ $loop->iteration + ($disposisi->currentPage()-1) * $disposisi->perPage() }}

    </td>

    <td>

        <strong>

            {{ $item->disposisi->surat->nomor_surat ?? '-' }}

        </strong>

    </td>

    <td>

        {{ $item->disposisi->surat->perihal ?? '-' }}

    </td>

    <td>

        {{ $item->disposisi->pengirim->name ?? '-' }}

    </td>

    <td>

        {{ optional($item->created_at)->format('d M Y') }}

    </td>

    <td>

        @if($item->status=='Belum Dibaca')

            <span class="badge bg-warning text-dark">

                Belum Dibaca

            </span>

        @elseif($item->status=='Sudah Dibaca')

            <span class="badge bg-info text-dark">

                Sudah Dibaca

            </span>

        @elseif($item->status=='Selesai')

            <span class="badge bg-success">

                Selesai

            </span>

        @elseif($item->status=='Ditolak')

            <span class="badge bg-danger">

                Ditolak

            </span>

        @else

            <span class="badge bg-secondary">

                {{ $item->status }}

            </span>

        @endif

    </td>

    <td>

        <div class="btn-group-custom">

            {{-- Detail --}}
            <a href="{{ route('pegawai.disposisi.show',$item->id) }}"
               class="btn btn-sm btn-outline-primary"
               title="Detail">

                <i class="bi bi-eye"></i>

            </a>

            {{-- Cetak --}}
            <a href="{{ route('pegawai.disposisi.cetak',$item->id) }}"
               target="_blank"
               class="btn btn-sm btn-outline-success"
               title="Cetak">

                <i class="bi bi-printer"></i>

            </a>

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="7">

        <div class="empty-state">

            <i class="bi bi-inbox"></i>

            <h5>

                Belum Ada Disposisi

            </h5>

            <p class="text-muted">

                Tidak ada disposisi yang ditujukan kepada Anda.

            </p>

        </div>

    </td>

</tr>

@endforelse

                </tbody>

            </table>

        </div>

        {{-- ===========================
            FOOTER TABLE
        ============================ --}}

        <div class="table-footer">

            <div>

                Menampilkan

                <strong>{{ $disposisi->firstItem() ?? 0 }}</strong>

                -

                <strong>{{ $disposisi->lastItem() ?? 0 }}</strong>

                dari

                <strong>{{ $disposisi->total() }}</strong>

                data

            </div>

            <div>

                {{ $disposisi->withQueryString()->links() }}

            </div>

        </div>

    </div>

</div>

@endsection


@push('styles')

<style>

/* ======================================================
    PAGE
====================================================== */

body{

    background:#F8FAFC;

}

/* ======================================================
    HEADER
====================================================== */

.page-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:30px;

}

.page-header h2{

    font-weight:700;

    color:#0f172a;

}

.page-header p{

    color:#64748b;

}

/* ======================================================
    DASHBOARD CARD
====================================================== */

.dashboard-grid{

    display:grid;

    grid-template-columns:repeat(4,1fr);

    gap:20px;

    margin-bottom:30px;

}

.stat-card{

    background:#fff;

    border-radius:20px;

    padding:24px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    box-shadow:0 10px 25px rgba(0,0,0,.05);

    transition:.3s;

}

.stat-card:hover{

    transform:translateY(-5px);

    box-shadow:0 18px 35px rgba(37,99,235,.15);

}

.stat-card span{

    font-size:14px;

    color:#64748b;

}

.stat-card h3{

    margin-top:6px;

    font-size:32px;

    font-weight:700;

}

.stat-icon{

    width:60px;

    height:60px;

    border-radius:16px;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:24px;

}

.primary{

    background:#DBEAFE;

    color:#2563EB;

}

.warning{

    background:#FEF3C7;

    color:#D97706;

}

.info{

    background:#E0F2FE;

    color:#0284C7;

}

.success{

    background:#DCFCE7;

    color:#16A34A;

}

/* ======================================================
    TABLE CARD
====================================================== */

.table-card{

    background:#fff;

    border-radius:20px;

    overflow:hidden;

    box-shadow:0 10px 30px rgba(0,0,0,.05);

}

.table-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:25px 30px;

    border-bottom:1px solid #edf2f7;

}

.table-toolbar{

    display:flex;

    justify-content:space-between;

    gap:20px;

    flex-wrap:wrap;

    padding:20px 30px;

}

.search-form{

    position:relative;

    flex:1;

}

.search-form i{

    position:absolute;

    top:50%;

    left:15px;

    transform:translateY(-50%);

    color:#94A3B8;

}

.search-form input{

    width:100%;

    padding:12px 15px 12px 45px;

    border-radius:12px;

    border:1px solid #dbe2ea;

}

.filter-form{

    display:flex;

    gap:10px;

}

.table{

    margin:0;

}

.table thead{

    background:#F8FAFC;

}

.table thead th{

    border:none;

    font-weight:700;

}

.table tbody tr{

    transition:.25s;

}

.table tbody tr:hover{

    background:#F8FAFC;

}

.table td{

    vertical-align:middle;

}

/* ======================================================
    BUTTON AKSI
====================================================== */

.btn-group-custom{

    display:flex;

    justify-content:center;

    gap:8px;

}

.btn-group-custom .btn{

    width:38px;

    height:38px;

    display:flex;

    justify-content:center;

    align-items:center;

    border-radius:10px;

}

/* ======================================================
    BADGE
====================================================== */

.badge{

    border-radius:30px;

    padding:8px 14px;

    font-size:12px;

}

/* ======================================================
    EMPTY
====================================================== */

.empty-state{

    text-align:center;

    padding:60px 20px;

}

.empty-state i{

    font-size:70px;

    color:#CBD5E1;

}

.empty-state h5{

    margin-top:20px;

}

/* ======================================================
    FOOTER
====================================================== */

.table-footer{

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:20px 30px;

    border-top:1px solid #edf2f7;

    background:#fafafa;

}

.pagination{

    margin:0;

}

.page-link{

    border-radius:10px !important;

}

/* ======================================================
    ANIMATION
====================================================== */

.fade-up{

    animation:fadeUp .45s ease;

}

@keyframes fadeUp{

from{

opacity:0;

transform:translateY(15px);

}

to{

opacity:1;

transform:translateY(0);

}

}

/* ======================================================
    RESPONSIVE
====================================================== */

@media(max-width:992px){

.dashboard-grid{

grid-template-columns:repeat(2,1fr);

}

}

@media(max-width:768px){

.page-header{

flex-direction:column;

align-items:flex-start;

}

.table-toolbar{

flex-direction:column;

}

.table-footer{

flex-direction:column;

gap:15px;

text-align:center;

}

}

@media(max-width:576px){

.dashboard-grid{

grid-template-columns:1fr;

}

}

</style>

@endpush

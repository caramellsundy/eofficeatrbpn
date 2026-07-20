@extends('layouts.pegawai')

@section('title','Surat Keluar')

@section('content')

<div class="container-fluid">

    {{-- ===========================
        PAGE HEADER
    ============================ --}}
    <div class="page-header fade-up">

        <div>

            <h2>

                <i class="bi bi-send-fill text-primary me-2"></i>

                Surat Keluar

            </h2>

            <p>

                Seluruh surat keluar yang telah Anda buat.

            </p>

        </div>

        <a href="{{ route('pegawai.surat-keluar.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle-fill me-2"></i>

            Tambah Surat

        </a>

    </div>


    {{-- ALERT --}}
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

                <span>Total Surat</span>

                <h3>

                    {{ $surat->total() }}

                </h3>

            </div>

            <div class="stat-icon primary">

                <i class="bi bi-envelope-fill"></i>

            </div>

        </div>



        <div class="stat-card">

            <div>

                <span>Menunggu</span>

                <h3>

                    {{ $surat->where('status','diajukan')->count() }}

                </h3>

            </div>

            <div class="stat-icon warning">

                <i class="bi bi-hourglass-split"></i>

            </div>

        </div>



        <div class="stat-card">

            <div>

                <span>Diverifikasi</span>

                <h3>

                    {{ $surat->where('status','diverifikasi')->count() }}

                </h3>

            </div>

            <div class="stat-icon info">

                <i class="bi bi-arrow-repeat"></i>

            </div>

        </div>



        <div class="stat-card">

            <div>

                <span>Ke Pimpinan</span>

                <h3>

                    {{ $surat->where('status','diteruskan_ke_pimpinan')->count() }}

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

                    Daftar Surat Keluar

                </h4>

                <small>

                    Data seluruh surat keluar pegawai.

                </small>

            </div>

            <span class="badge bg-primary">

                {{ $surat->total() }} Surat

            </span>

        </div>



        {{-- ===========================
            SEARCH & FILTER
        ============================ --}}

        <div class="table-toolbar">

            <form
                action="{{ route('pegawai.surat-keluar.index') }}"
                method="GET"
                class="search-form">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    name="keyword"
                    value="{{ request('keyword') }}"
                    placeholder="Cari nomor surat atau perihal...">

            </form>


            <form
                action="{{ route('pegawai.surat-keluar.index') }}"
                method="GET"
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
                        value="draft"
                        {{ request('status')=='draft' ? 'selected' : '' }}>

                        Draft

                    </option>

                    <option
                        value="diajukan"
                        {{ request('status')=='diajukan' ? 'selected' : '' }}>

                        Diajukan

                    </option>

                    <option
                        value="diteruskan_ke_pimpinan"
                        {{ request('status')=='diteruskan_ke_pimpinan' ? 'selected' : '' }}>

                        Diteruskan ke Pimpinan

                    </option>

                </select>

                <button class="btn btn-primary">

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

                            Tujuan Surat

                        </th>

                        <th width="130">

                            Tanggal

                        </th>

                        <th width="120">

                            Status

                        </th>

                        <th width="170">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($surat as $item)

                <tr>

    <td>

        {{ $loop->iteration + ($surat->currentPage()-1) * $surat->perPage() }}

    </td>

    <td>

        <strong>

            {{ $item->nomor_surat }}

        </strong>

    </td>

    <td>

        {{ $item->perihal }}

    </td>

    <td>

        {{ $item->tujuan_surat ?? '-' }}

    </td>

    <td>

        {{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d M Y') }}

    </td>

    <td>

        @if(in_array($item->status, ['draft', 'Menunggu']))

            <span class="badge bg-warning text-dark">

                Draft

            </span>

        @elseif($item->status=='diajukan')

            <span class="badge bg-info text-dark">

                Diajukan

            </span>

        @elseif($item->status=='diteruskan_ke_pimpinan')

            <span class="badge bg-success">

                Diteruskan ke Pimpinan

            </span>

        @elseif($item->status=='dikembalikan')

            <span class="badge bg-danger">

                Ditolak

            </span>

        @else

            <span class="badge bg-secondary">

                {{ $item->status_label }}

            </span>

        @endif

    </td>

    <td>

        <div class="btn-group-custom">

            {{-- DETAIL --}}
            <a
                href="{{ route('pegawai.surat-keluar.show',$item->id) }}"
                class="btn btn-sm btn-outline-primary"
                title="Detail">

                <i class="bi bi-eye"></i>

            </a>

            {{-- EDIT --}}
            @if(in_array($item->status, ['draft', 'dikembalikan', 'Menunggu']))
            <a
                href="{{ route('pegawai.surat-keluar.edit',$item->id) }}"
                class="btn btn-sm btn-outline-warning"
                title="Edit">

                <i class="bi bi-pencil-square"></i>

            </a>

            <form action="{{ route('pegawai.surat-keluar.kirim', $item->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-sm btn-outline-success" title="Kirim ke admin" onclick="return confirm('Kirim surat ini ke admin?')">
                    <i class="bi bi-send-fill"></i>
                </button>
            </form>

            {{-- HAPUS --}}
            <form
                action="{{ route('pegawai.surat-keluar.destroy',$item->id) }}"
                method="POST"
                class="d-inline"
                onsubmit="return confirm('Yakin ingin menghapus surat ini?')">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-sm btn-outline-danger"
                    title="Hapus">

                    <i class="bi bi-trash"></i>

                </button>

            </form>
            @endif

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="7">

        <div class="empty-state">

            <i class="bi bi-inbox"></i>

            <h5>

                Belum ada Surat Keluar

            </h5>

            <p>

                Silakan klik tombol <strong>Tambah Surat</strong> untuk membuat surat baru.

            </p>

            <a
                href="{{ route('pegawai.surat-keluar.create') }}"
                class="btn btn-primary">

                <i class="bi bi-plus-circle-fill me-2"></i>

                Tambah Surat

            </a>

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

                <strong>

                    {{ $surat->firstItem() ?? 0 }}

                </strong>

                -

                <strong>

                    {{ $surat->lastItem() ?? 0 }}

                </strong>

                dari

                <strong>

                    {{ $surat->total() }}

                </strong>

                data

            </div>

            <div>

                {{ $surat->withQueryString()->links() }}

            </div>

        </div>

    </div>

</div>

@endsection


@push('styles')

<style>

body{

    background:#F8FAFC;

}

/* ===========================
HEADER
=========================== */

.page-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:30px;

    gap:20px;

}

.page-header h2{

    font-weight:700;

    margin-bottom:5px;

}

.page-header p{

    color:#64748b;

    margin:0;

}

/* ===========================
CARD STATISTIK
=========================== */

.dashboard-grid{

    display:grid;

    grid-template-columns:repeat(4,1fr);

    gap:20px;

    margin-bottom:30px;

}

.stat-card{

    background:#fff;

    border-radius:18px;

    padding:25px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    box-shadow:0 10px 30px rgba(0,0,0,.05);

    transition:.3s;

}

.stat-card:hover{

    transform:translateY(-6px);

}

.stat-card span{

    color:#64748b;

}

.stat-card h3{

    font-size:32px;

    font-weight:700;

    margin-top:8px;

}

.stat-icon{

    width:60px;

    height:60px;

    border-radius:16px;

    display:flex;

    align-items:center;

    justify-content:center;

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

    background:#DBEAFE;

    color:#0284C7;

}

.success{

    background:#DCFCE7;

    color:#16A34A;

}

/* ===========================
TABLE CARD
=========================== */

.table-card{

    background:#fff;

    border-radius:18px;

    overflow:hidden;

    box-shadow:0 10px 35px rgba(0,0,0,.05);

}

.table-header{

    padding:25px 30px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    border-bottom:1px solid #edf2f7;

}

.table-toolbar{

    display:flex;

    justify-content:space-between;

    gap:20px;

    padding:25px 30px;

    flex-wrap:wrap;

}

.search-form{

    position:relative;

    flex:1;

}

.search-form i{

    position:absolute;

    left:15px;

    top:50%;

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

.table th{

    font-weight:700;

    border:none;

}

.table td{

    vertical-align:middle;

}

.table tbody tr:hover{

    background:#F8FAFC;

}

/* ===========================
BUTTON AKSI
=========================== */

.btn-group-custom{

    display:flex;

    gap:8px;

    justify-content:center;

}

.btn-group-custom .btn{

    width:38px;

    height:38px;

    display:flex;

    justify-content:center;

    align-items:center;

    border-radius:10px;

}

/* ===========================
EMPTY
=========================== */

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

.table-footer{

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:20px 30px;

    border-top:1px solid #edf2f7;

}

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

}

}

@media(max-width:576px){

.dashboard-grid{

grid-template-columns:1fr;

}

}

</style>

@endpush

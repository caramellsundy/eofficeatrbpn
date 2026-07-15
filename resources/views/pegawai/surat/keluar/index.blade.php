@extends('layouts.pegawai')

@section('title','Surat Keluar')

@section('content')

<div class="container-fluid">

    {{-- =====================================
        HEADER
    ====================================== --}}
    <div class="page-header fade-up">

        <div>

            <h2>

                <i class="bi bi-send-fill text-primary me-2"></i>

                Surat Keluar

            </h2>

            <p class="text-muted mb-0">

                Kelola seluruh surat keluar yang telah Anda buat.

            </p>

        </div>

        <a href="{{ route('pegawai.surat-keluar.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle-fill me-2"></i>

            Tambah Surat

        </a>

    </div>



    {{-- =====================================
        ALERT
    ====================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif



    {{-- =====================================
        STATISTIK
    ====================================== --}}

    <div class="dashboard-grid mb-4">

        <div class="stat-card">

            <div>

                <span>Total Surat</span>

                <h3>

                    {{ $surat->total() }}

                </h3>

            </div>

            <div class="stat-icon primary">

                <i class="bi bi-envelope-paper-fill"></i>

            </div>

        </div>



        <div class="stat-card">

            <div>

                <span>Menunggu</span>

                <h3>

                    {{ $surat->where('status','Menunggu')->count() }}

                </h3>

            </div>

            <div class="stat-icon warning">

                <i class="bi bi-hourglass-split"></i>

            </div>

        </div>



        <div class="stat-card">

            <div>

                <span>Diproses</span>

                <h3>

                    {{ $surat->where('status','Diproses')->count() }}

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

                    {{ $surat->where('status','Selesai')->count() }}

                </h3>

            </div>

            <div class="stat-icon success">

                <i class="bi bi-check-circle-fill"></i>

            </div>

        </div>

    </div>



    {{-- =====================================
        TABLE CARD
    ====================================== --}}

    <div class="table-card fade-up">

        <div class="table-header">

            <div>

                <h4>

                    <i class="bi bi-list-ul me-2 text-primary"></i>

                    Daftar Surat Keluar

                </h4>

                <small class="text-muted">

                    Seluruh surat keluar yang telah Anda buat.

                </small>

            </div>

            <span class="badge bg-primary rounded-pill px-3 py-2">

                {{ $surat->total() }} Surat

            </span>

        </div>



        {{-- =====================================
            SEARCH & FILTER
        ====================================== --}}

        <div class="table-toolbar">

            <form
                action="{{ route('pegawai.surat-keluar.index') }}"
                method="GET"
                class="toolbar-form">

                <div class="search-box">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        name="keyword"
                        value="{{ request('keyword') }}"
                        placeholder="Cari nomor surat atau perihal...">

                </div>

                <select
                    name="status"
                    class="form-select">

                    <option value="">
                        Semua Status
                    </option>

                    <option value="Menunggu"
                        {{ request('status')=='Menunggu' ? 'selected' : '' }}>
                        Menunggu
                    </option>

                    <option value="Diproses"
                        {{ request('status')=='Diproses' ? 'selected' : '' }}>
                        Diproses
                    </option>

                    <option value="Selesai"
                        {{ request('status')=='Selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>

                </select>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-funnel-fill"></i>

                </button>

            </form>

        </div>



        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th width="60">No</th>

                        <th>Nomor Surat</th>

                        <th>Perihal</th>

                        <th>Tujuan</th>

                        <th width="140">Tanggal</th>

                        <th width="140">Status</th>

                        <th width="180">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($surat as $item)

<tr>

    <td>

        {{ $surat->firstItem() + $loop->index }}

    </td>

    <td>

        <div class="fw-semibold">

            {{ $item->nomor_surat }}

        </div>

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

        @switch($item->status)

            @case('Menunggu')

                <span class="badge bg-warning text-dark">

                    Menunggu

                </span>

            @break

            @case('Diproses')

                <span class="badge bg-primary">

                    Diproses

                </span>

            @break

            @case('Selesai')

                <span class="badge bg-success">

                    Selesai

                </span>

            @break

            @default

                <span class="badge bg-secondary">

                    {{ ucfirst($item->status) }}

                </span>

        @endswitch

    </td>

    <td>

        <div class="btn-group">

            {{-- DETAIL --}}
            <a href="{{ route('pegawai.surat-keluar.show',$item->id) }}"
               class="btn btn-sm btn-outline-primary"
               title="Detail">

                <i class="bi bi-eye"></i>

            </a>


            {{-- EDIT --}}
            @if($item->status == 'Menunggu')

                <a href="{{ route('pegawai.surat-keluar.edit',$item->id) }}"
                   class="btn btn-sm btn-outline-warning"
                   title="Edit">

                    <i class="bi bi-pencil-square"></i>

                </a>

            @endif


            {{-- HAPUS --}}
            @if($item->status == 'Menunggu')

                <form
                    action="{{ route('pegawai.surat-keluar.destroy',$item->id) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus surat ini?')">

                    @csrf

                    @method('DELETE')

                    <button
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

            <h5 class="mt-3">

                Belum Ada Surat Keluar

            </h5>

            <p class="text-muted">

                Silakan klik tombol <b>Tambah Surat</b> untuk membuat surat keluar pertama.

            </p>

        </div>

    </td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="table-footer">

    <div>

        Menampilkan

        <strong>{{ $surat->firstItem() ?? 0 }}</strong>

        -

        <strong>{{ $surat->lastItem() ?? 0 }}</strong>

        dari

        <strong>{{ $surat->total() }}</strong>

        surat

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
    /* ===============================
   PAGE
================================= */

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    margin:20px 0 30px;
}

.page-header h2{
    font-size:32px;
    font-weight:700;
    color:#0f172a;
}

.page-header p{
    color:#64748b;
    margin:0;
}

/* ===============================
   DASHBOARD GRID
================================= */

.dashboard-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:22px;
    margin-bottom:30px;
}

/* ===============================
   CARD
================================= */

.stat-card{
    background:#fff;
    border-radius:22px;
    padding:25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border:1px solid #edf2f7;
    box-shadow:0 10px 25px rgba(15,23,42,.05);
    transition:.3s;
}

.stat-card:hover{

    transform:translateY(-6px);

    box-shadow:0 18px 40px rgba(37,99,235,.10);

}

.stat-card span{

    display:block;

    color:#64748b;

    font-size:14px;

}

.stat-card h3{

    margin-top:8px;

    margin-bottom:0;

    font-size:32px;

    font-weight:700;

    color:#0f172a;

}

.stat-icon{

    width:64px;

    height:64px;

    border-radius:18px;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:28px;

}

/* ===============================
   COLORS
================================= */

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

/* ===============================
   TABLE CARD
================================= */

.table-card{

    background:#fff;

    border-radius:22px;

    overflow:hidden;

    border:1px solid #edf2f7;

    box-shadow:0 10px 25px rgba(15,23,42,.05);

}

.table-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:25px 30px;

    border-bottom:1px solid #edf2f7;

}

.table-header h4{

    font-weight:700;

    margin-bottom:4px;

}

.table-header small{

    color:#64748b;

}

/* ===============================
   TOOLBAR
================================= */

.table-toolbar{

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:20px;

    flex-wrap:wrap;

    padding:20px 30px;

}

/* ===============================
   SEARCH
================================= */

.table-search{

    position:relative;

    flex:1;

}

.table-search i{

    position:absolute;

    top:50%;

    left:15px;

    transform:translateY(-50%);

    color:#94A3B8;

}

.table-search input{

    width:100%;

    border:1px solid #dbe2ea;

    border-radius:14px;

    padding:12px 15px 12px 46px;

    transition:.3s;

}

.table-search input:focus{

    outline:none;

    border-color:#2563EB;

    box-shadow:0 0 0 4px rgba(37,99,235,.08);

}

/* ===============================
   TABLE
================================= */

.table{

    margin-bottom:0;

}

.table thead{

    background:#F8FAFC;

}

.table thead th{

    padding:16px;

    font-weight:700;

    color:#334155;

    border:none;

}

.table tbody td{

    padding:16px;

    vertical-align:middle;

}

.table tbody tr{

    transition:.25s;

}

.table tbody tr:hover{

    background:#F8FAFC;

}

/* ===============================
   BUTTON GROUP
================================= */

.btn-group{

    display:flex;

    gap:6px;

}

.btn{

    border-radius:10px;

    transition:.3s;

}

.btn:hover{

    transform:translateY(-2px);

}

/* ===============================
   BADGE
================================= */

.badge{

    padding:8px 14px;

    border-radius:50px;

    font-size:12px;

    font-weight:600;

}

/* ===============================
   EMPTY STATE
================================= */

.empty-state{

    text-align:center;

    padding:70px 20px;

}

.empty-state i{

    font-size:60px;

    color:#94A3B8;

}

.empty-state h5{

    margin-top:20px;

    font-weight:700;

    color:#334155;

}

.empty-state p{

    color:#64748b;

}

/* ===============================
   FOOTER
================================= */

.table-footer{

    display:flex;

    justify-content:space-between;

    align-items:center;

    padding:20px 30px;

    background:#fafafa;

    border-top:1px solid #edf2f7;

}

/* ===============================
   PAGINATION
================================= */

.pagination{

    margin:0;

}

.page-link{

    border:none;

    margin:0 2px;

    border-radius:10px !important;

    color:#2563EB;

}

.page-item.active .page-link{

    background:#2563EB;

}

/* ===============================
   ALERT
================================= */

.alert{

    border-radius:15px;

    border:none;

    box-shadow:0 8px 18px rgba(0,0,0,.05);

}

/* ===============================
   ANIMATION
================================= */

.fade-up{

    animation:fadeUp .45s ease;

}

@keyframes fadeUp{

    from{

        opacity:0;

        transform:translateY(18px);

    }

    to{

        opacity:1;

        transform:translateY(0);

    }

}

/* ===============================
   RESPONSIVE
================================= */

@media(max-width:1200px){

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

align-items:stretch;

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

.page-header h2{

font-size:24px;

}

.stat-card{

padding:20px;

}

.stat-card h3{

font-size:28px;

}

}
</style>
@extends('layouts.pegawai')

@section('title','Surat Masuk')

@section('content')

<div class="page-header fade-up">

    <div>

        <h2>

            <i class="bi bi-envelope-paper-fill text-primary me-2"></i>

            Surat Masuk

        </h2>

        <p class="text-muted mb-0">

            Kelola seluruh surat masuk yang telah Anda input ke sistem.

        </p>

    </div>

    <a
        href="{{ route('pegawai.surat-masuk.create') }}"
        class="btn btn-primary">

        <i class="bi bi-plus-circle-fill me-2"></i>

        Tambah Surat

    </a>

</div>



{{-- ========================================================= --}}
{{-- STATISTIK --}}
{{-- ========================================================= --}}

<div class="dashboard-grid mb-4">

    <div class="stat-card">

        <div>

            <span>Total Surat</span>

            <h3>

                {{ $suratMasuk->total() }}

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

                {{ $suratMasuk->where('status','Menunggu')->count() }}

            </h3>

        </div>

        <div class="stat-icon secondary">

            <i class="bi bi-hourglass-split"></i>

        </div>

    </div>



    <div class="stat-card">

        <div>

            <span>Diproses</span>

            <h3>

                {{ $suratMasuk->where('status','Diproses')->count() }}

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

                {{ $suratMasuk->where('status','Selesai')->count() }}

            </h3>

        </div>

        <div class="stat-icon success">

            <i class="bi bi-check-circle-fill"></i>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- CARD TABEL --}}
{{-- ========================================================= --}}

<div class="table-card fade-up">

    <div class="table-header">

        <div>

            <h4>

                <i class="bi bi-list-ul me-2 text-primary"></i>

                Daftar Surat Masuk

            </h4>

            <small class="text-muted">

                Daftar seluruh surat masuk milik Anda.

            </small>

        </div>

        <span class="badge bg-primary">

            {{ $suratMasuk->total() }} Surat

        </span>

    </div>



    {{-- ========================================================= --}}
    {{-- SEARCH & FILTER --}}
    {{-- ========================================================= --}}

    <div class="table-toolbar">

        <form
            action="{{ route('pegawai.surat-masuk.index') }}"
            method="GET"
            class="table-search">

            <i class="bi bi-search"></i>

            <input
                type="text"
                name="keyword"
                value="{{ request('keyword') }}"
                placeholder="Cari nomor surat, asal surat, atau perihal...">

        </form>



        <form
            action="{{ route('pegawai.surat-masuk.index') }}"
            method="GET"
            class="d-flex gap-2">

            @if(request('keyword'))

                <input
                    type="hidden"
                    name="keyword"
                    value="{{ request('keyword') }}">

            @endif

            <select
                name="status"
                class="form-select">

                <option value="">

                    Semua Status

                </option>

                <option
                    value="Menunggu"
                    {{ request('status')=='Menunggu' ? 'selected' : '' }}>

                    Menunggu

                </option>

                <option
                    value="Diproses"
                    {{ request('status')=='Diproses' ? 'selected' : '' }}>

                    Diproses

                </option>

                <option
                    value="Selesai"
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

                    <th width="60">

                        No

                    </th>

                    <th>

                        Nomor Surat

                    </th>

                    <th>

                        Asal Surat

                    </th>

                    <th>

                        Perihal

                    </th>

                    <th width="130">

                        Tanggal

                    </th>

                    <th width="130">

                        Status

                    </th>

                    <th width="160">

                        Aksi

                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($suratMasuk as $surat)

<tr>

    <td>

        {{ $loop->iteration + ($suratMasuk->firstItem() - 1) }}

    </td>

    <td>

        <strong>

            {{ $surat->nomor_surat }}

        </strong>

    </td>

    <td>

        {{ $surat->asal_surat }}

    </td>

    <td>

        {{ $surat->perihal }}

    </td>

    <td>

        {{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d M Y') }}

    </td>

    <td>

        @if($surat->status == 'Menunggu')

            <span class="badge bg-warning">

                Menunggu

            </span>

        @elseif($surat->status == 'Diproses')

            <span class="badge bg-primary">

                Diproses

            </span>

        @elseif($surat->status == 'Selesai')

            <span class="badge bg-success">

                Selesai

            </span>

        @else

            <span class="badge bg-secondary">

                {{ $surat->status }}

            </span>

        @endif

    </td>

    <td>

        <div class="d-flex gap-1">

            {{-- DETAIL --}}
            <a
                href="{{ route('pegawai.surat-masuk.show',$surat->id) }}"
                class="btn btn-sm btn-outline-primary"
                title="Detail">

                <i class="bi bi-eye"></i>

            </a>


            {{-- EDIT hanya jika Menunggu --}}
            @if($surat->status == 'Menunggu')

                <a
                    href="{{ route('pegawai.surat-masuk.edit',$surat->id) }}"
                    class="btn btn-sm btn-outline-warning"
                    title="Edit">

                    <i class="bi bi-pencil-square"></i>

                </a>

            @endif


            {{-- KIRIM --}}
            @if($surat->status == 'Menunggu')

                <form
                    action="{{ route('pegawai.surat-masuk.kirim',$surat->id) }}"
                    method="POST"
                    class="d-inline">

                    @csrf

                    @method('PUT')

                    <button
                        type="submit"
                        class="btn btn-sm btn-outline-success"
                        onclick="return confirm('Kirim surat ini?')"
                        title="Kirim">

                        <i class="bi bi-send-fill"></i>

                    </button>

                </form>

            @endif


            {{-- HAPUS --}}
            @if($surat->status == 'Menunggu')

                <form
                    action="{{ route('pegawai.surat-masuk.destroy',$surat->id) }}"
                    method="POST"
                    class="d-inline">

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Yakin ingin menghapus surat ini?')"
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

    <td
        colspan="7"
        class="text-center py-5">

        <i class="bi bi-inbox display-5 text-secondary"></i>

        <br><br>

        <strong>

            Belum ada surat masuk

        </strong>

        <br>

        <small class="text-muted">

            Silakan tambahkan surat masuk terlebih dahulu.

        </small>

    </td>

</tr>

@endforelse

</tbody>

</table>

</div>

{{-- ========================================================= --}}
{{-- FOOTER TABLE --}}
{{-- ========================================================= --}}

<div class="table-footer">

    <div class="text-muted">

        Menampilkan

        <strong>

            {{ $suratMasuk->firstItem() ?? 0 }}

        </strong>

        -

        <strong>

            {{ $suratMasuk->lastItem() ?? 0 }}

        </strong>

        dari

        <strong>

            {{ $suratMasuk->total() }}

        </strong>

        surat

    </div>


    <div>

        {{ $suratMasuk->links() }}

    </div>


</div>


</div>

@endsection



{{-- ========================================================= --}}
{{-- STYLE --}}
{{-- ========================================================= --}}

@push('styles')

<style>


.page-header{

    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:20px;
    margin-bottom:30px;

}


.page-header h2{

    font-weight:700;

}



.dashboard-grid{

    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;

}



.stat-card{

    background:white;
    border-radius:18px;
    padding:25px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    box-shadow:0 10px 25px rgba(0,0,0,.05);

}



.stat-card span{

    color:#64748b;
    font-size:14px;

}



.stat-card h3{

    margin-top:8px;
    font-size:30px;
    font-weight:700;

}



.stat-icon{

    width:60px;
    height:60px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:25px;

}



.stat-icon.primary{

    background:#dbeafe;
    color:#2563eb;

}



.stat-icon.secondary{

    background:#fef3c7;
    color:#d97706;

}



.stat-icon.info{

    background:#cffafe;
    color:#0891b2;

}



.stat-icon.success{

    background:#dcfce7;
    color:#16a34a;

}



.table-card{

    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.05);

}



.table-header{

    padding:25px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid #edf2f7;

}



.table-header h4{

    font-weight:700;
    margin-bottom:5px;

}



.table-toolbar{

    padding:20px 30px;
    display:flex;
    justify-content:space-between;
    gap:20px;
    align-items:center;
    flex-wrap:wrap;

}



.table-search{

    position:relative;
    flex:1;

}



.table-search i{

    position:absolute;
    left:15px;
    top:50%;
    transform:translateY(-50%);
    color:#94a3b8;

}



.table-search input{

    width:100%;
    padding:12px 15px 12px 45px;
    border-radius:12px;
    border:1px solid #dbe2ea;

}



.table-search input:focus{

    outline:none;
    border-color:#2563eb;

}



.table-responsive{

    padding:0 20px;

}



.table{

    margin-bottom:0;

}



.table thead th{

    background:#f8fafc;
    color:#475569;
    font-size:14px;
    font-weight:600;

}



.table tbody td{

    padding:15px;
    vertical-align:middle;

}



.table tbody tr:hover{

    background:#f8fafc;

}



.badge{

    padding:8px 14px;
    border-radius:20px;
    font-size:12px;

}



.btn-sm{

    border-radius:10px;

}



.table-footer{

    padding:20px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-top:1px solid #edf2f7;
    background:#fafafa;

}



.pagination{

    margin-bottom:0;

}



@media(max-width:1200px){


.dashboard-grid{

    grid-template-columns:repeat(2,1fr);

}


}



@media(max-width:768px){


.page-header{

    flex-direction:column;
    align-items:flex-start;
    gap:15px;

}



.table-toolbar{

    flex-direction:column;
    align-items:stretch;

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
@extends('layouts.admin')

@section('title','Data Jabatan')

@section('content')

<div class="page-header fade-up">

    <div>

        <h2>

            <i class="bi bi-briefcase-fill text-primary"></i>

            Data Jabatan

        </h2>

        <p class="text-muted mb-0">

            Kelola seluruh data jabatan pegawai.

        </p>

    </div>

    <a
        href="{{ route('admin.jabatan.create') }}"
        class="btn btn-primary">

        <i class="bi bi-plus-circle me-2"></i>

        Tambah Jabatan

    </a>

</div>

{{-- Statistik --}}

<div class="stats-grid fade-up">

    <div class="stat-card">

        <div>

            <h3>

                {{ $jabatan->total() }}

            </h3>

            <p>Total Jabatan</p>

        </div>

        <div class="stat-icon bg-primary-soft">

            <i class="bi bi-briefcase-fill"></i>

        </div>

    </div>

</div>

<div class="content-card fade-up">

    <div class="card-header">

        <h5>

            Daftar Jabatan

        </h5>

        <form
            action="{{ route('admin.jabatan.index') }}"
            method="GET"
            class="search-box">

            <i class="bi bi-search"></i>

            <input
                type="text"
                name="keyword"
                value="{{ request('keyword') }}"
                placeholder="Cari jabatan...">

        </form>

    </div>

    <div class="table-responsive">

        <table class="table custom-table">

            <thead>

                <tr>

                    <th width="70">No</th>

                    <th>Kode</th>

                    <th>Nama Jabatan</th>

                    <th>Deskripsi</th>

                    <th width="180">Aksi</th>

                </tr>

            </thead>

            <tbody>
                                @forelse($jabatan as $item)

                    <tr>

                        <td>

                            {{ $loop->iteration + ($jabatan->firstItem() - 1) }}

                        </td>

                        <td>

                            <span class="fw-semibold text-primary">

                                {{ $item->kode }}

                            </span>

                        </td>

                        <td>

                            <strong>

                                {{ $item->nama }}

                            </strong>

                        </td>

                        <td>

                            {{ $item->deskripsi ?: '-' }}

                        </td>

                        <td>

                            <div class="table-actions">

                                <a
                                    href="{{ route('admin.jabatan.show',$item->id) }}"
                                    class="btn btn-sm btn-info text-white"
                                    title="Detail">

                                    <i class="bi bi-eye-fill"></i>

                                </a>

                                <a
                                    href="{{ route('admin.jabatan.edit',$item->id) }}"
                                    class="btn btn-sm btn-warning text-white"
                                    title="Edit">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                <form
                                    action="{{ route('admin.jabatan.destroy',$item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus jabatan ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-danger"
                                        title="Hapus">

                                        <i class="bi bi-trash-fill"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-5">

                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>

                            <span class="text-muted">

                                Belum ada data jabatan.

                            </span>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $jabatan->links() }}

    </div>

</div>

@endsection

@push('styles')

<style>

.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:25px;
}

.stat-card{
    background:#fff;
    border-radius:18px;
    padding:24px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 10px 25px rgba(15,76,129,.08);
}

.stat-card h3{
    margin:0;
    font-size:30px;
    font-weight:700;
    color:#0F4C81;
}

.stat-card p{
    margin:6px 0 0;
    color:#64748b;
}

.stat-icon{
    width:65px;
    height:65px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
}

.bg-primary-soft{
    background:#e7f1ff;
    color:#0F4C81;
}

.content-card{
    background:#fff;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(15,76,129,.08);
}

.content-card .card-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:24px 30px;
    border-bottom:1px solid #edf2f7;
}

.content-card .card-header h5{
    margin:0;
    font-size:20px;
    font-weight:700;
}

.search-box{
    position:relative;
}

.search-box i{
    position:absolute;
    top:50%;
    left:14px;
    transform:translateY(-50%);
    color:#94a3b8;
}

.search-box input{
    width:260px;
    padding:11px 14px 11px 42px;
    border:1px solid #dbe2ea;
    border-radius:12px;
    outline:none;
    transition:.3s;
}

.search-box input:focus{
    border-color:#0F4C81;
    box-shadow:0 0 0 .2rem rgba(15,76,129,.10);
}

.custom-table{
    margin:0;
}

.custom-table thead th{
    background:#f8fafc;
    color:#475569;
    font-weight:700;
    border-bottom:1px solid #e2e8f0;
    padding:16px;
}

.custom-table tbody td{
    padding:16px;
    vertical-align:middle;
}

.custom-table tbody tr:hover{
    background:#fafcff;
}

.table-actions{
    display:flex;
    gap:8px;
    align-items:center;
}

.table-actions form{
    display:inline;
    margin:0;
}

.table-actions .btn{
    width:38px;
    height:38px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:10px;
}

.card-footer{
    background:#fff;
    border-top:1px solid #edf2f7;
    padding:20px 30px;
}

.pagination{
    margin-bottom:0;
}

@media(max-width:768px){

    .content-card .card-header{
        flex-direction:column;
        align-items:flex-start;
        gap:15px;
    }

    .search-box,
    .search-box input{
        width:100%;
    }

    .table-actions{
        flex-wrap:wrap;
    }

}

</style>

@endpush


@extends('layouts.pegawai')

@section('title','Surat Keluar')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold text-primary">
                <i class="bi bi-envelope-paper-fill"></i>
                Surat Keluar
            </h3>

            <p class="text-muted mb-0">
                Kelola seluruh surat keluar.
            </p>
        </div>

        <a href="{{ route('pegawai.surat.create',['type'=>'keluar']) }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>
            Tambah Surat Keluar

        </a>

    </div>

    {{-- Pesan --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    {{-- Statistik --}}
    <div class="row mb-4">

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card border-0 shadow-sm bg-primary text-white">

                <div class="card-body">

                    <h6>Total Surat</h6>

                    <h2>{{ $surats->total() }}</h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card border-0 shadow-sm bg-warning text-dark">

                <div class="card-body">

                    <h6>Menunggu</h6>

                    <h2>{{ $surats->where('status','menunggu')->count() }}</h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card border-0 shadow-sm bg-info text-white">

                <div class="card-body">

                    <h6>Diproses</h6>

                    <h2>{{ $surats->where('status','diproses')->count() }}</h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card border-0 shadow-sm bg-success text-white">

                <div class="card-body">

                    <h6>Selesai</h6>

                    <h2>{{ $surats->where('status','selesai')->count() }}</h2>

                </div>

            </div>

        </div>

    </div>

    {{-- Filter --}}
    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-5">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari nomor surat atau judul..."
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-md-3">

                        <select
                            name="status"
                            class="form-select">

                            <option value="">Semua Status</option>

                            <option value="menunggu"
                                {{ request('status')=='menunggu'?'selected':'' }}>
                                Menunggu
                            </option>

                            <option value="diproses"
                                {{ request('status')=='diproses'?'selected':'' }}>
                                Diproses
                            </option>

                            <option value="ditolak"
                                {{ request('status')=='ditolak'?'selected':'' }}>
                                Ditolak
                            </option>

                            <option value="selesai"
                                {{ request('status')=='selesai'?'selected':'' }}>
                                Selesai
                            </option>

                        </select>

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary w-100">

                            <i class="bi bi-search"></i>

                            Cari

                        </button>

                    </div>

                    <div class="col-md-2">

                        <a href="{{ route('pegawai.surat.keluar') }}"
                           class="btn btn-secondary w-100">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- Tabel --}}
    <div class="card shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                Daftar Surat Keluar

            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">

                    <tr>

                        <th width="60">No</th>

                        <th>Nomor Surat</th>

                        <th>Judul Surat</th>

                        <th>Tujuan Surat</th>

                        <th>Tanggal Surat</th>

                        <th>Status</th>

                        <th width="180">Aksi</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($surats as $surat)

                        <tr>

                            <td>

                                {{ $surats->firstItem() + $loop->index }}

                            </td>

                            <td>

                                {{ $surat->nomor_surat }}

                            </td>

                            <td>

                                {{ $surat->judul_surat }}

                            </td>

                            <td>

                                {{ $surat->tujuan_surat ?? '-' }}

                            </td>

                            <td>

                                {{ $surat->tanggal_surat }}

                            </td>

                            <td>

                                @if($surat->status=='menunggu')

                                    <span class="badge bg-warning">

                                        Menunggu

                                    </span>

                                @elseif($surat->status=='diproses')

                                    <span class="badge bg-info">

                                        Diproses

                                    </span>

                                @elseif($surat->status=='ditolak')

                                    <span class="badge bg-danger">

                                        Ditolak

                                    </span>

                                @elseif($surat->status=='selesai')

                                    <span class="badge bg-success">

                                        Selesai

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        {{ ucfirst($surat->status) }}

                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('pegawai.surat.show',$surat->id) }}"
                                   class="btn btn-info btn-sm"
                                   title="Detail">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <a href="{{ route('pegawai.surat.edit',$surat->id) }}"
                                   class="btn btn-warning btn-sm"
                                   title="Edit">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                <form action="{{ route('pegawai.surat.destroy',$surat->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus surat ini?')">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        title="Hapus">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center text-muted">

                                Belum ada data surat keluar.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $surats->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
@extends('layouts.pegawai')

@section('title','Disposisi Saya')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold text-primary mb-1">

                <i class="bi bi-inbox-fill me-2"></i>

                Disposisi Saya

            </h3>

            <p class="text-muted mb-0">

                Seluruh disposisi surat yang ditujukan kepada Anda.

            </p>

        </div>

        <span class="badge bg-primary fs-6">

            Total :

            {{ $disposisi->total() }}

        </span>

    </div>

    {{-- Alert --}}
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

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="bi bi-exclamation-circle-fill me-2"></i>

            {{ session('error') }}

            <button
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <div class="row align-items-center">

                <div class="col-md-6">

                    <h5 class="mb-0">

                        <i class="bi bi-envelope-paper-fill me-2"></i>

                        Inbox Disposisi

                    </h5>

                </div>

                <div class="col-md-6">

                    <form method="GET"
                          action="{{ route('pegawai.surat.disposisi.index') }}">

                        <div class="input-group">

                            <input
                                type="text"
                                name="keyword"
                                value="{{ request('keyword') }}"
                                class="form-control"
                                placeholder="Cari nomor surat / judul surat">

                            <button
                                class="btn btn-light">

                                <i class="bi bi-search"></i>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Nomor Surat
                            </th>

                            <th>
                                Judul Surat
                            </th>

                            <th>
                                Dari
                            </th>

                            <th>
                                Prioritas
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th width="170">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($disposisi as $item)
                    <tr>

    <td>

        {{ $loop->iteration + ($disposisi->firstItem() - 1) }}

    </td>

    <td>

        <span class="fw-semibold">

            {{ $item->disposisi->surat->nomor_surat ?? '-' }}

        </span>

    </td>

    <td>

        <div class="fw-semibold">

            {{ $item->disposisi->surat->judul_surat ?? '-' }}

        </div>

        <small class="text-muted">

            {{ $item->disposisi->surat->perihal ?? '-' }}

        </small>

    </td>

    <td>

        {{ $item->disposisi->pengirim->name ?? '-' }}

    </td>

    <td>

        @if($item->disposisi->prioritas == 'Tinggi')

            <span class="badge bg-danger">

                Tinggi

            </span>

        @elseif($item->disposisi->prioritas == 'Sedang')

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

        @if($item->status == 'Belum Dibaca')

            <span class="badge bg-warning text-dark">

                <i class="bi bi-envelope me-1"></i>

                Belum Dibaca

            </span>

        @elseif($item->status == 'Sudah Dibaca')

            <span class="badge bg-info">

                <i class="bi bi-eye-fill me-1"></i>

                Sudah Dibaca

            </span>

        @elseif($item->status == 'Selesai')

            <span class="badge bg-success">

                <i class="bi bi-check-circle-fill me-1"></i>

                Selesai

            </span>

        @else

            <span class="badge bg-secondary">

                {{ $item->status }}

            </span>

        @endif

    </td>

    <td>

        {{ optional($item->disposisi->tanggal_disposisi)->format('d-m-Y') }}

    </td>

    <td>

        <div class="btn-group">

            <a href="{{ route('pegawai.surat.disposisi.show',$item->id) }}"
               class="btn btn-sm btn-primary"
               title="Lihat">

                <i class="bi bi-eye-fill"></i>

            </a>

            @if($item->status == 'Belum Dibaca')

                <form action="{{ route('pegawai.surat.disposisi.dibaca',$item->id) }}"
                      method="POST"
                      class="d-inline">

                    @csrf

                    @method('PATCH')

                    <button
                        type="submit"
                        class="btn btn-sm btn-info"
                        title="Tandai Sudah Dibaca">

                        <i class="bi bi-book-half"></i>

                    </button>

                </form>

            @endif

            @if($item->status != 'Selesai')

                <form action="{{ route('pegawai.surat.disposisi.selesai',$item->id) }}"
                      method="POST"
                      class="d-inline">

                    @csrf

                    @method('PATCH')

                    <button
                        type="submit"
                        class="btn btn-sm btn-success"
                        title="Selesaikan"
                        onclick="return confirm('Tandai disposisi ini sebagai selesai?')">

                        <i class="bi bi-check2-circle"></i>

                    </button>

                </form>

            @endif

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="8" class="text-center py-5">

        <i class="bi bi-inbox display-4 text-muted"></i>

        <br><br>

        <strong>

            Belum ada disposisi untuk Anda.

        </strong>

    </td>

</tr>

@endforelse
                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer bg-white">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div class="text-muted small">

                    Menampilkan

                    <strong>

                        {{ $disposisi->firstItem() ?? 0 }}

                    </strong>

                    -

                    <strong>

                        {{ $disposisi->lastItem() ?? 0 }}

                    </strong>

                    dari

                    <strong>

                        {{ $disposisi->total() }}

                    </strong>

                    data

                </div>

                <div>

                    {{ $disposisi->links() }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
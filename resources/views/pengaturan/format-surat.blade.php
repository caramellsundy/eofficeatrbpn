@extends('layouts.admin')

@section('title','Format Surat')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold text-primary">
                <i class="bi bi-file-earmark-text"></i>
                Pengaturan Format Surat
            </h3>

            <small class="text-muted">
                Mengatur format nomor surat masuk dan surat keluar.
            </small>
        </div>

        <a href="{{ route('admin.settings.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </a>

    </div>

    {{-- Alert Success --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

    @endif

    {{-- Alert Error --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="card shadow border-0">

        <div class="card-header bg-info text-white">

            <h5 class="mb-0">

                Edit Format Nomor Surat

            </h5>

        </div>

        <div class="card-body">

            <form action="{{ route('admin.settings.format.update') }}"method="POST">

                @csrf

                @method('PUT')

                {{-- Surat Masuk --}}
                <div class="mb-4">

                    <label class="form-label fw-bold">

                        Format Surat Masuk

                    </label>

                    <input
                        type="text"
                        name="format_masuk"
                        class="form-control @error('format_masuk') is-invalid @enderror"
                        value="{{ old('format_masuk', $formatMasuk ?? 'SM/{nomor}/{bulan}/{tahun}') }}">

                    @error('format_masuk')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                    <small class="text-muted">

                        Contoh:
                        <br>

                        SM/{nomor}/{bulan}/{tahun}

                    </small>

                </div>

                {{-- Surat Keluar --}}
                <div class="mb-4">

                    <label class="form-label fw-bold">

                        Format Surat Keluar

                    </label>

                    <input
                        type="text"
                        name="format_keluar"
                        class="form-control @error('format_keluar') is-invalid @enderror"
                        value="{{ old('format_keluar', $formatKeluar ?? 'SK/{nomor}/{bulan}/{tahun}') }}">

                    @error('format_keluar')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                    <small class="text-muted">

                        Contoh:
                        <br>

                        SK/{nomor}/{bulan}/{tahun}

                    </small>

                </div>

                {{-- Keterangan --}}
                <div class="alert alert-info">

                    <strong>Placeholder yang dapat digunakan:</strong>

                    <ul class="mb-0 mt-2">

                        <li>{nomor}</li>

                        <li>{bulan}</li>

                        <li>{tahun}</li>

                        <li>{tanggal}</li>

                        <li>{kode}</li>

                    </ul>

                </div>

                <hr>

                <div class="text-end">

                    <a href="{{ route('admin.settings.index') }}"
                       class="btn btn-secondary">

                        Batal

                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-save"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
@extends('layouts.admin')

@section('title', 'Pengaturan Nomor Surat')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <div>

            <h3 class="fw-bold text-primary mb-1">
                <i class="fas fa-file-signature me-2"></i>
                Pengaturan Nomor Surat
            </h3>

            <p class="text-muted mb-0">
                Atur format penomoran surat yang digunakan oleh sistem.
            </p>

        </div>

        <a href="{{ route('admin.settings.index') }}"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left me-2"></i>

            Kembali

        </a>

    </div>

    {{-- Alert --}}
    @if(session('success'))

        <div class="alert alert-success">

            <i class="fas fa-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="row">

        {{-- FORM --}}
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-info text-white">

                    <h5 class="mb-0">

                        <i class="fas fa-cogs me-2"></i>

                        Format Penomoran

                    </h5>

                </div>

                <div class="card-body">

                    <form action="#" method="POST">

                        @csrf

                        {{-- Surat Masuk --}}
                        <div class="mb-4">

                            <label class="form-label fw-bold">

                                Format Nomor Surat Masuk

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="surat_masuk"
                                value="SM/{nomor}/{bulan}/{tahun}">

                            <small class="text-muted">

                                Contoh:
                                <strong>SM/001/VII/2026</strong>

                            </small>

                        </div>

                        {{-- Surat Keluar --}}
                        <div class="mb-4">

                            <label class="form-label fw-bold">

                                Format Nomor Surat Keluar

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="surat_keluar"
                                value="SK/{nomor}/{bulan}/{tahun}">

                            <small class="text-muted">

                                Contoh:
                                <strong>SK/015/VII/2026</strong>

                            </small>

                        </div>

                        {{-- Disposisi --}}
                        <div class="mb-4">

                            <label class="form-label fw-bold">

                                Format Nomor Disposisi

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="disposisi"
                                value="DSP/{nomor}/{tahun}">

                            <small class="text-muted">

                                Contoh:
                                <strong>DSP/002/2026</strong>

                            </small>

                        </div>

                        {{-- Nomor Awal --}}
                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-bold">

                                    Nomor Awal Surat Masuk

                                </label>

                                <input
                                    type="number"
                                    class="form-control"
                                    name="awal_masuk"
                                    value="1">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-bold">

                                    Nomor Awal Surat Keluar

                                </label>

                                <input
                                    type="number"
                                    class="form-control"
                                    name="awal_keluar"
                                    value="1">

                            </div>

                        </div>

                        <hr>

                        <div class="text-end">

                            <button
                                type="submit"
                                class="btn btn-info text-white">

                                <i class="fas fa-save me-2"></i>

                                Simpan Pengaturan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        {{-- PANEL INFO --}}
        <div class="col-lg-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary text-white">

                    <h5 class="mb-0">

                        <i class="fas fa-lightbulb me-2"></i>

                        Variabel Format

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-bordered table-sm">

                        <thead class="table-light">

                            <tr>

                                <th>Variabel</th>

                                <th>Hasil</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>{nomor}</td>

                                <td>001</td>

                            </tr>

                            <tr>

                                <td>{bulan}</td>

                                <td>VII</td>

                            </tr>

                            <tr>

                                <td>{tahun}</td>

                                <td>2026</td>

                            </tr>

                            <tr>

                                <td>{tanggal}</td>

                                <td>07</td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="card shadow-sm border-0 mt-4">

                <div class="card-header bg-success text-white">

                    <h5 class="mb-0">

                        <i class="fas fa-eye me-2"></i>

                        Preview

                    </h5>

                </div>

                <div class="card-body">

                    <p class="mb-2">

                        <strong>Surat Masuk</strong>

                    </p>

                    <div class="alert alert-light border">

                        SM/001/VII/2026

                    </div>

                    <p class="mb-2">

                        <strong>Surat Keluar</strong>

                    </p>

                    <div class="alert alert-light border">

                        SK/001/VII/2026

                    </div>

                    <p class="mb-2">

                        <strong>Disposisi</strong>

                    </p>

                    <div class="alert alert-light border">

                        DSP/001/2026

                    </div>

                </div>

            </div>

            <div class="card shadow-sm border-0 mt-4">

                <div class="card-header bg-warning">

                    <h5 class="mb-0">

                        <i class="fas fa-info-circle me-2"></i>

                        Keterangan

                    </h5>

                </div>

                <div class="card-body">

                    <ul class="mb-0">

                        <li>Nomor surat bertambah otomatis.</li>

                        <li>Reset nomor dapat dilakukan setiap tahun.</li>

                        <li>Format dapat diubah sesuai kebutuhan instansi.</li>

                        <li>Perubahan akan berlaku untuk surat berikutnya.</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
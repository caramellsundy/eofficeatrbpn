@extends('layouts.admin')

@section('title', 'Backup & Restore Database')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <div>

            <h3 class="fw-bold text-primary mb-1">
                <i class="fas fa-database me-2"></i>
                Backup & Restore Database
            </h3>

            <p class="text-muted mb-0">
                Kelola backup database aplikasi Persuratan ATR/BPN.
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

    @if(session('error'))

        <div class="alert alert-danger">

            <i class="fas fa-times-circle me-2"></i>

            {{ session('error') }}

        </div>

    @endif

    <div class="row">

        {{-- Backup --}}
        <div class="col-lg-6 mb-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-header bg-success text-white">

                    <h5 class="mb-0">

                        <i class="fas fa-download me-2"></i>

                        Backup Database

                    </h5>

                </div>

                <div class="card-body">

                    <p class="text-muted">

                        Backup akan menyimpan seluruh data:

                    </p>

                    <ul>

                        <li>Data Pegawai</li>

                        <li>Data Jabatan</li>

                        <li>Data Unit Kerja</li>

                        <li>Surat Masuk</li>

                        <li>Surat Keluar</li>

                        <li>Disposisi</li>

                        <li>User Login</li>

                    </ul>

                    <hr>

                    <form action="{{ route('admin.settings.backup.download') }}"
                          method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-success">

                            <i class="fas fa-download me-2"></i>

                            Download Backup

                        </button>

                    </form>

                </div>

            </div>

        </div>

        {{-- Restore --}}
        <div class="col-lg-6 mb-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-header bg-warning">

                    <h5 class="mb-0 text-dark">

                        <i class="fas fa-upload me-2"></i>

                        Restore Database

                    </h5>

                </div>

                <div class="card-body">

                    <div class="alert alert-warning">

                        <strong>Peringatan!</strong>

                        Restore akan mengganti data yang ada.

                    </div>

                    <form action="{{ route('admin.settings.backup.restore') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label fw-bold">

                                File Backup (.sql)

                            </label>

                            <input
                                type="file"
                                name="backup_file"
                                class="form-control"
                                accept=".sql"
                                required>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-warning">

                            <i class="fas fa-upload me-2"></i>

                            Restore Database

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

    {{-- Riwayat --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                <i class="fas fa-history me-2"></i>

                Riwayat Backup

            </h5>

        </div>

        <div class="card-body p-0">

            <table class="table table-bordered table-hover mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="60">No</th>

                        <th>Nama File</th>

                        <th>Tanggal Backup</th>

                        <th>Ukuran</th>

                        <th width="180">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    {{-- Contoh Data --}}

                    <tr>

                        <td>1</td>

                        <td>backup_2026_07_07.sql</td>

                        <td>07 Juli 2026 14:00</td>

                        <td>3.4 MB</td>

                        <td>

                            <button
                                class="btn btn-sm btn-success">

                                <i class="fas fa-download"></i>

                            </button>

                            <button
                                class="btn btn-sm btn-danger">

                                <i class="fas fa-trash"></i>

                            </button>

                        </td>

                    </tr>

                    <tr>

                        <td colspan="5"
                            class="text-center text-muted">

                            Riwayat backup otomatis akan muncul di sini.

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

    {{-- Informasi --}}
    <div class="card shadow-sm border-0 mt-4">

        <div class="card-header bg-info text-white">

            <h5 class="mb-0">

                <i class="fas fa-info-circle me-2"></i>

                Informasi

            </h5>

        </div>

        <div class="card-body">

            <ul class="mb-0">

                <li>Backup disarankan dilakukan minimal satu kali setiap minggu.</li>

                <li>Simpan file backup di lokasi yang aman.</li>

                <li>Restore hanya dilakukan oleh Administrator.</li>

                <li>Pastikan database sudah dibackup sebelum melakukan restore.</li>

            </ul>

        </div>

    </div>

</div>

@endsection
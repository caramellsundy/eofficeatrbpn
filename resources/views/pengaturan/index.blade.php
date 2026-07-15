@extends('layouts.admin')

@section('title','Pengaturan Sistem')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-primary mb-0">Pengaturan Sistem</h3>
            <small class="text-muted">
                Kelola konfigurasi aplikasi E-Office ATR/BPN
            </small>
        </div>
    </div>

    {{-- CARD MENU --}}
    <div class="row g-4">

        {{-- ========================================================= --}}
        {{-- PROFIL ADMIN --}}
        {{-- ========================================================= --}}
        <div class="col-lg-6">

            <div class="card shadow border-0 h-100">

                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-person-circle"></i>
                        Profil Admin
                    </h5>
                </div>

                <div class="card-body">

                    <table class="table table-borderless">

                        <tr>
                            <th width="180">Nama</th>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>

                        <tr>
                            <th>Role</th>
                            <td>{{ ucfirst(auth()->user()->role) }}</td>
                        </tr>

                    </table>

                </div>

                <div class="card-footer bg-white">

                    <a href="{{ route('admin.settings.profile') }}"
                       class="btn btn-primary">

                        <i class="bi bi-pencil-square"></i>
                        Edit Profil

                    </a>

                </div>

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- KEAMANAN --}}
        {{-- ========================================================= --}}
        <div class="col-lg-6">

            <div class="card shadow border-0 h-100">

                <div class="card-header bg-warning">
                    <h5 class="mb-0">

                        <i class="bi bi-shield-lock"></i>

                        Keamanan

                    </h5>
                </div>

                <div class="card-body">

                    <p>Password digunakan untuk login ke sistem.</p>

                    <ul>

                        <li>Minimal 8 karakter</li>

                        <li>Gunakan kombinasi huruf & angka</li>

                        <li>Ganti password secara berkala</li>

                    </ul>

                </div>

                <div class="card-footer bg-white">

                    <a href="{{ route('admin.settings.security') }}"
                       class="btn btn-warning">

                        <i class="bi bi-key"></i>

                        Ganti Password

                    </a>

                </div>

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- INSTANSI --}}
        {{-- ========================================================= --}}
        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-success text-white">

                    <h5 class="mb-0">

                        <i class="bi bi-building"></i>

                        Informasi Instansi

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table">

                        <tr>

                            <th width="170">Nama Instansi</th>

                            <td>Kementerian ATR/BPN</td>

                        </tr>

                        <tr>

                            <th>Alamat</th>

                            <td>Jl. Sisingamangaraja No.2 Jakarta</td>

                        </tr>

                        <tr>

                            <th>Telepon</th>

                            <td>0811-1068-0000</td>

                        </tr>

                        <tr>

                            <th>Email</th>

                            <td>surat@atrbpn.go.id</td>

                        </tr>

                    </table>

                </div>

                <div class="card-footer bg-white">

                    <a href="{{ route('admin.settings.instansi') }}"
                       class="btn btn-success">

                        <i class="bi bi-pencil-square"></i>

                        Edit Instansi

                    </a>

                </div>

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- FORMAT SURAT --}}
        {{-- ========================================================= --}}
        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-info text-white">

                    <h5 class="mb-0">

                        <i class="bi bi-file-earmark-text"></i>

                        Format Nomor Surat

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-bordered">

                        <tr>

                            <th>Surat Masuk</th>

                            <td>

                                SM/{nomor}/{bulan}/{tahun}

                            </td>

                        </tr>

                        <tr>

                            <th>Surat Keluar</th>

                            <td>

                                SK/{nomor}/{bulan}/{tahun}

                            </td>

                        </tr>

                    </table>

                </div>

                <div class="card-footer bg-white">

                    <a href="{{ route('admin.settings.format') }}"
                       class="btn btn-info text-white">

                        <i class="bi bi-pencil-square"></i>

                        Edit Format Surat

                    </a>

                </div>

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- BACKUP --}}
        {{-- ========================================================= --}}
        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-secondary text-white">

                    <h5 class="mb-0">

                        <i class="bi bi-database-fill-down"></i>

                        Backup Database

                    </h5>

                </div>

                <div class="card-body">

                    <p>

                        Backup seluruh database aplikasi.

                    </p>

                </div>

                <div class="card-footer bg-white">

                    <a href="{{ route('admin.settings.backup') }}"
                       class="btn btn-secondary">

                        <i class="bi bi-download"></i>

                        Backup

                    </a>

                </div>

            </div>

        </div>

        {{-- ========================================================= --}}
        {{-- ABOUT --}}
        {{-- ========================================================= --}}
        <div class="col-lg-6">

            <div class="card shadow border-0">

                <div class="card-header bg-dark text-white">

                    <h5 class="mb-0">

                        <i class="bi bi-info-circle"></i>

                        Tentang Sistem

                    </h5>

                </div>

                <div class="card-body">

                    <p>

                        Sistem Informasi Persuratan ATR/BPN

                    </p>

                    <p>

                        Versi 1.0

                    </p>

                </div>

                <div class="card-footer bg-white">

                    <a href="{{ route('admin.settings.about') }}"
                       class="btn btn-dark">

                        Detail

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
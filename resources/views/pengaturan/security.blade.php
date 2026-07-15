@extends('layouts.admin')

@section('title', 'Keamanan Akun')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <div>
            <h3 class="fw-bold text-primary mb-1">
                <i class="fas fa-shield-alt me-2"></i>
                Keamanan Akun
            </h3>

            <p class="text-muted mb-0">
                Kelola keamanan akun administrator.
            </p>
        </div>

        <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali
        </a>

    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert Error --}}
    @if($errors->any())
        <div class="alert alert-danger shadow-sm">

            <strong>
                <i class="fas fa-exclamation-circle me-2"></i>
                Terjadi Kesalahan
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>
    @endif

    <div class="row">

        {{-- FORM PASSWORD --}}
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-warning">

                    <h5 class="mb-0 text-dark">
                        <i class="fas fa-key me-2"></i>
                        Ganti Password
                    </h5>

                </div>

                <div class="card-body">

                    <form action="{{ route('profile.password.update') }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label fw-bold">

                                Password Lama

                            </label>

                            <input
                                type="password"
                                name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                required>

                            @error('current_password')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-bold">

                                Password Baru

                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required>

                            @error('password')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-bold">

                                Konfirmasi Password Baru

                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required>

                        </div>

                        <hr>

                        <div class="text-end">

                            <button
                                type="submit"
                                class="btn btn-warning">

                                <i class="fas fa-save me-2"></i>

                                Update Password

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        {{-- INFO --}}
        <div class="col-lg-4">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary text-white">

                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Tips Keamanan
                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <i class="fas fa-check-circle text-success me-2"></i>

                        Gunakan minimal <strong>8 karakter</strong>.

                    </div>

                    <div class="mb-3">

                        <i class="fas fa-check-circle text-success me-2"></i>

                        Gunakan kombinasi huruf besar dan kecil.

                    </div>

                    <div class="mb-3">

                        <i class="fas fa-check-circle text-success me-2"></i>

                        Tambahkan angka.

                    </div>

                    <div class="mb-3">

                        <i class="fas fa-check-circle text-success me-2"></i>

                        Tambahkan simbol seperti <strong>@ # $ %</strong>.

                    </div>

                    <div class="mb-3">

                        <i class="fas fa-check-circle text-success me-2"></i>

                        Jangan menggunakan tanggal lahir.

                    </div>

                    <div class="mb-3">

                        <i class="fas fa-check-circle text-success me-2"></i>

                        Ganti password secara berkala.

                    </div>

                </div>

            </div>

            <div class="card shadow-sm border-0 mt-4">

                <div class="card-header bg-success text-white">

                    <h5 class="mb-0">

                        <i class="fas fa-user-lock me-2"></i>

                        Status Akun

                    </h5>

                </div>

                <div class="card-body">

                    <table class="table table-borderless mb-0">

                        <tr>

                            <th width="45%">

                                User

                            </th>

                            <td>

                                {{ auth()->user()->name }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Email

                            </th>

                            <td>

                                {{ auth()->user()->email }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Role

                            </th>

                            <td>

                                <span class="badge bg-success">

                                    {{ ucfirst(auth()->user()->role) }}

                                </span>

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Status

                            </th>

                            <td>

                                <span class="badge bg-primary">

                                    Aktif

                                </span>

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login | e-Office ATR/BPN</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>

<body>

<div class="login-wrapper">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-11">

                <div class="login-card">

                    <div class="row g-0">

                        <!-- ==========================
                             PANEL KIRI
                        =========================== -->

                        <div class="col-lg-5 d-none d-lg-block">

                            <div class="left-panel">

                                <div>

                                    <div class="logo-box">

                                        <img
                                            src="{{ asset('images/logo-atr.png') }}"
                                            class="logo-atr"
                                            alt="Logo ATR/BPN">

                                    </div>

                                    <h1 class="system-title">

                                        E-Office

                                    </h1>

                                    <h5 class="system-subtitle">

                                        Kementerian ATR/BPN

                                    </h5>

                                    <div class="divider-light"></div>

                                    <h3 class="welcome-title">

                                        Satu Platform untuk Semua Pengguna

                                    </h3>

                                    <p class="welcome-text">

                                        E-Office ATR/BPN menghadirkan layanan
                                        persuratan digital yang menghubungkan
                                        Administrator, Pegawai, dan Masyarakat
                                        dalam satu sistem yang modern,
                                        efisien, dan terpercaya.

                                    </p>

                                    <div class="feature-list">

                                        <div class="feature-item">

                                            <i class="bi bi-check-circle-fill"></i>

                                            <span>Administrasi Terpusat</span>

                                        </div>

                                        <div class="feature-item">

                                            <i class="bi bi-check-circle-fill"></i>

                                            <span>Pengelolaan Disposisi & Surat</span>

                                        </div>

                                        <div class="feature-item">

                                            <i class="bi bi-check-circle-fill"></i>

                                            <span>Layanan Surat untuk Masyarakat</span>

                                        </div>

                                        <div class="feature-item">

                                            <i class="bi bi-check-circle-fill"></i>

                                            <span>Arsip Digital Aman & Terintegrasi</span>

                                        </div>

                                    </div>

                                </div>

                                <div class="left-footer">

                                    © {{ date('Y') }}

                                    ATR/BPN

                                </div>

                            </div>

                        </div>

                        <!-- ==========================
                             PANEL KANAN
                        =========================== -->

                        <div class="col-lg-7">

                            <div class="right-panel">

                                <div class="login-header">

                                    <h2>

                                        Selamat Datang

                                    </h2>

                                    <p>

                                        Silakan login menggunakan akun Anda.

                                    </p>

                                </div>

                                @if(session('status'))

                                    <div class="alert alert-success">

                                        {{ session('status') }}

                                    </div>

                                @endif

                                @if($errors->any())

                                    <div class="alert alert-danger">

                                        {{ $errors->first() }}

                                    </div>

                                @endif

                                <form
                                    method="POST"
                                    action="{{ route('login') }}">

                                    @csrf

                                    {{-- ==========================
    PILIH ROLE
========================== --}}

<div class="mb-4">

    <label class="form-label fw-semibold">

        Login Sebagai

    </label>

    <input
        type="hidden"
        name="login_as"
        id="selected-role"
        value="{{ old('login_as','pegawai') }}">

    <div class="role-wrapper">

        <button
    type="button"
    id="btn-admin"
    class="role-btn admin"
    onclick="setRole('admin')">

            <i class="bi bi-shield-lock"></i>

            <span>Admin</span>

        </button>

        <button
    type="button"
    id="btn-pegawai"
    class="role-btn pegawai"
    onclick="setRole('pegawai')">

            <i class="bi bi-person-badge"></i>

            <span>Pegawai</span>

        </button>

        <button
    type="button"
    id="btn-umum"
    class="role-btn umum"
    onclick="setRole('umum')">
            <i class="bi bi-people"></i>

            <span>Umum</span>

        </button>

    </div>

</div>

{{-- ==========================
    EMAIL
========================== --}}

<div class="mb-3">

    <label class="form-label">

        Email

    </label>

    <div class="input-group modern-input">

        <span class="input-group-text">

            <i class="bi bi-envelope"></i>

        </span>

        <input
            type="email"
            name="email"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="Masukkan email"
            value="{{ old('email') }}"
            required
            autofocus>

    </div>

    @error('email')

        <small class="text-danger">

            {{ $message }}

        </small>

    @enderror

</div>

{{-- ==========================
    PASSWORD
========================== --}}

<div class="mb-4">

    <label class="form-label">

        Password

    </label>

    <div class="input-group modern-input">

        <span class="input-group-text">

            <i class="bi bi-lock"></i>

        </span>

        <input
            type="password"
            id="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="Masukkan password"
            required>

        <button
            type="button"
            id="togglePassword"
            class="btn btn-light border">

            <i
                id="toggleIcon"
                class="bi bi-eye">

            </i>

        </button>

    </div>

    @error('password')

        <small class="text-danger">

            {{ $message }}

        </small>

    @enderror

</div>

{{-- ==========================
    REMEMBER
========================== --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div class="form-check">

        <input
            class="form-check-input"
            type="checkbox"
            id="remember"
            name="remember">

        <label
            class="form-check-label"
            for="remember">

            Ingat Saya

        </label>

    </div>

    @if (Route::has('password.request'))

        <a
            href="{{ route('password.request') }}"
            class="forgot-link">

            Lupa Password?

        </a>

    @endif

</div>

{{-- ==========================
    LOGIN BUTTON
========================== --}}

<div class="d-grid mb-4">

    <button
        type="submit"
        class="btn btn-primary btn-login">

        <i class="bi bi-box-arrow-in-right me-2"></i>

        Masuk ke Sistem

    </button>

</div>

<div class="divider">

    <span>ATAU</span>

</div>

<div class="register-box">

    <p>

        Belum memiliki akun?

    </p>

    <a
        href="{{ route('register') }}"
        class="register-link">

        Daftar Sekarang

    </a>

</div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Login JS -->
<script src="{{ asset('js/login.js') }}"></script>

</body>

</html>
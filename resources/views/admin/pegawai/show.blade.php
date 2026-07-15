@extends('layouts.admin')

@section('title','Detail Pegawai')

@section('content')

{{-- ===================================================== --}}
{{-- PAGE HEADER --}}
{{-- ===================================================== --}}

<div class="page-header fade-up">

    <div>

        <h2>

            <i class="bi bi-person-vcard-fill text-primary"></i>

            Detail Pegawai

        </h2>

        <p class="text-muted mb-0">

            Informasi lengkap data pegawai.

        </p>

    </div>

    <div class="d-flex gap-2">

        <a
            href="{{ route('admin.pegawai.edit',$pegawai->id) }}"
            class="btn btn-warning">

            <i class="bi bi-pencil-square me-2"></i>

            Edit

        </a>

        <a
            href="{{ route('admin.pegawai.index') }}"
            class="btn btn-light border">

            <i class="bi bi-arrow-left-circle me-2"></i>

            Kembali

        </a>

    </div>

</div>

<div class="row">

    {{-- ====================================== --}}
    {{-- PROFILE CARD --}}
    {{-- ====================================== --}}

    <div class="col-lg-4">

        <div class="profile-card fade-up">

            <div class="profile-cover"></div>

            <div class="profile-body">

                <div class="profile-avatar">

                    {{ strtoupper(substr($pegawai->nama,0,1)) }}

                </div>

                <h3>

                    {{ $pegawai->nama }}

                </h3>

                <p class="text-muted">

                    {{ $pegawai->nip }}

                </p>

                <hr>

                <div class="profile-badge">

                    @if($pegawai->jabatan)

                        <span class="badge bg-primary">

                            {{ $pegawai->jabatan->nama }}

                        </span>

                    @endif

                    @if($pegawai->unitKerja)

                        <span class="badge bg-success">

                            {{ $pegawai->unitKerja->nama }}

                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>

    {{-- ====================================== --}}
    {{-- DETAIL --}}
    {{-- ====================================== --}}

    <div class="col-lg-8">

        <div class="form-card fade-up">

            <div class="card-header">

                <h4 class="mb-0">

                    Informasi Pegawai

                </h4>

            </div>

            <div class="card-body">

                <div class="row">

                                    {{-- ====================================== --}}
                    {{-- NIP --}}
                    {{-- ====================================== --}}

                    <div class="col-md-6 mb-4">

                        <label class="detail-label">

                            NIP

                        </label>

                        <div class="detail-value">

                            {{ $pegawai->nip }}

                        </div>

                    </div>

                    {{-- ====================================== --}}
                    {{-- NAMA --}}
                    {{-- ====================================== --}}

                    <div class="col-md-6 mb-4">

                        <label class="detail-label">

                            Nama Pegawai

                        </label>

                        <div class="detail-value">

                            {{ $pegawai->nama }}

                        </div>

                    </div>

                    {{-- ====================================== --}}
                    {{-- EMAIL --}}
                    {{-- ====================================== --}}

                    <div class="col-md-6 mb-4">

                        <label class="detail-label">

                            Email

                        </label>

                        <div class="detail-value">

                            {{ $pegawai->email ?: '-' }}

                        </div>

                    </div>

                    {{-- ====================================== --}}
                    {{-- NO HP --}}
                    {{-- ====================================== --}}

                    <div class="col-md-6 mb-4">

                        <label class="detail-label">

                            Nomor HP

                        </label>

                        <div class="detail-value">

                            {{ $pegawai->no_hp ?: '-' }}

                        </div>

                    </div>

                    {{-- ====================================== --}}
                    {{-- JABATAN --}}
                    {{-- ====================================== --}}

                    <div class="col-md-6 mb-4">

                        <label class="detail-label">

                            Jabatan

                        </label>

                        <div class="detail-value">

                            @if($pegawai->jabatan)

                                <span class="badge bg-primary">

                                    {{ $pegawai->jabatan->nama }}

                                </span>

                            @else

                                <span class="text-muted">

                                    Belum ditentukan

                                </span>

                            @endif

                        </div>

                    </div>

                    {{-- ====================================== --}}
                    {{-- UNIT KERJA --}}
                    {{-- ====================================== --}}

                    <div class="col-md-6 mb-4">

                        <label class="detail-label">

                            Unit Kerja

                        </label>

                        <div class="detail-value">

                            @if($pegawai->unitKerja)

                                <span class="badge bg-success">

                                    {{ $pegawai->unitKerja->nama }}

                                </span>

                            @else

                                <span class="text-muted">

                                    Belum ditentukan

                                </span>

                            @endif

                        </div>

                    </div>

                    {{-- ====================================== --}}
                    {{-- ALAMAT --}}
                    {{-- ====================================== --}}

                    <div class="col-12 mb-4">

                        <label class="detail-label">

                            Alamat

                        </label>

                        <div class="detail-value detail-address">

                            {{ $pegawai->alamat ?: '-' }}

                        </div>

                    </div>
                    {{-- ====================================== --}}
                    {{-- ACTION --}}
                    {{-- ====================================== --}}

                    <div class="col-12">

                        <hr>

                        <div class="form-action">

                            <a
                                href="{{ route('admin.pegawai.index') }}"
                                class="btn btn-light border">

                                <i class="bi bi-arrow-left-circle me-2"></i>

                                Kembali

                            </a>

                            <a
                                href="{{ route('admin.pegawai.edit',$pegawai->id) }}"
                                class="btn btn-primary">

                                <i class="bi bi-pencil-square me-2"></i>

                                Edit Pegawai

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('styles')

<style>

.profile-card{

    background:#fff;

    border-radius:20px;

    overflow:hidden;

    box-shadow:0 10px 30px rgba(15,76,129,.08);

}

.profile-cover{

    height:120px;

    background:linear-gradient(135deg,#0F4C81,#2F80ED);

}

.profile-body{

    padding:25px;

    text-align:center;

}

.profile-avatar{

    width:100px;

    height:100px;

    margin:-75px auto 20px;

    border-radius:50%;

    background:#fff;

    border:5px solid #fff;

    box-shadow:0 8px 20px rgba(0,0,0,.15);

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:38px;

    font-weight:700;

    color:#0F4C81;

}

.profile-body h3{

    font-weight:700;

    margin-bottom:5px;

}

.profile-badge{

    display:flex;

    justify-content:center;

    flex-wrap:wrap;

    gap:10px;

    margin-top:15px;

}

.form-card{

    background:#fff;

    border-radius:20px;

    overflow:hidden;

    box-shadow:0 10px 30px rgba(15,76,129,.08);

}

.form-card .card-header{

    background:#fff;

    padding:22px 30px;

    border-bottom:1px solid #edf2f7;

}

.form-card .card-body{

    padding:30

    }

.detail-label{

    display:block;

    font-size:13px;

    font-weight:600;

    color:#64748b;

    margin-bottom:8px;

    text-transform:uppercase;

    letter-spacing:.5px;

}

.detail-value{

    background:#f8fafc;

    border:1px solid #e2e8f0;

    border-radius:12px;

    padding:14px 16px;

    font-size:15px;

    font-weight:500;

    color:#1e293b;

    min-height:52px;

    display:flex;

    align-items:center;

}

.detail-address{

    min-height:110px;

    align-items:flex-start;

    white-space:pre-line;

}

.form-action{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-top:10px;

}

.form-action .btn{

    min-width:170px;

    border-radius:12px;

    padding:10px 18px;

}

.badge{

    padding:8px 12px;

    font-size:12px;

    border-radius:30px;

}

@media (max-width:992px){

    .profile-card{

        margin-bottom:25px;

    }

}

@media (max-width:768px){

    .form-card .card-body{

        padding:20px;

    }

    .form-action{

        flex-direction:column;

        gap:15px;

        align-items:stretch;

    }

    .form-action .btn{

        width:100%;

        min-width:unset;

    }

    .profile-avatar{

        width:90px;

        height:90px;

        font-size:34px;

    }

}

</style>

@endpush
                    
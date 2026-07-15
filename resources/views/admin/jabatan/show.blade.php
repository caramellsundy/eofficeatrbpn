@extends('layouts.admin')

@section('title','Detail Jabatan')

@section('content')

<div class="page-header fade-up">

    <div>

        <h2>

            <i class="bi bi-briefcase-fill text-primary"></i>

            Detail Jabatan

        </h2>

        <p class="text-muted mb-0">

            Informasi lengkap data jabatan.

        </p>

    </div>

    <div class="d-flex gap-2">

        <a
            href="{{ route('admin.jabatan.edit',$jabatan->id) }}"
            class="btn btn-warning text-white">

            <i class="bi bi-pencil-square me-2"></i>

            Edit

        </a>

        <a
            href="{{ route('admin.jabatan.index') }}"
            class="btn btn-light border">

            <i class="bi bi-arrow-left-circle me-2"></i>

            Kembali

        </a>

    </div>

</div>

<div class="detail-card fade-up">

    <div class="detail-header">

        <div class="detail-icon bg-primary-subtle text-primary">

            <i class="bi bi-briefcase-fill"></i>

        </div>

        <div>

            <h3>

                {{ $jabatan->nama }}

            </h3>

            <p class="mb-0 text-muted">

                Detail informasi jabatan

            </p>

        </div>

    </div>

    <div class="detail-body">

        <div class="row">

            {{-- Kode Jabatan --}}
            <div class="col-md-6 mb-4">

                <label class="detail-label">

                    Kode Jabatan

                </label>

                <div class="detail-value">

                    {{ $jabatan->kode }}

                </div>

            </div>

            {{-- Nama Jabatan --}}
            <div class="col-md-6 mb-4">

                <label class="detail-label">

                    Nama Jabatan

                </label>

                <div class="detail-value">

                    {{ $jabatan->nama }}

                </div>

            </div>

                        {{-- =========================================== --}}
            {{-- DESKRIPSI --}}
            {{-- =========================================== --}}

            <div class="col-12 mb-4">

                <label class="detail-label">

                    Deskripsi

                </label>

                <div class="detail-value detail-description">

                    {{ $jabatan->deskripsi ?: 'Tidak ada deskripsi.' }}

                </div>

            </div>

            {{-- =========================================== --}}
            {{-- DIBUAT --}}
            {{-- =========================================== --}}

            <div class="col-md-6 mb-4">

                <label class="detail-label">

                    Dibuat Pada

                </label>

                <div class="detail-value">

                    {{ $jabatan->created_at ? $jabatan->created_at->format('d F Y H:i') : '-' }}

                </div>

            </div>

            {{-- =========================================== --}}
            {{-- DIUPDATE --}}
            {{-- =========================================== --}}

            <div class="col-md-6 mb-4">

                <label class="detail-label">

                    Terakhir Diupdate

                </label>

                <div class="detail-value">

                    {{ $jabatan->updated_at ? $jabatan->updated_at->format('d F Y H:i') : '-' }}

                </div>

            </div>

        </div>

    </div>

    <div class="detail-footer">

        <a
            href="{{ route('admin.jabatan.index') }}"
            class="btn btn-light border">

            <i class="bi bi-arrow-left-circle me-2"></i>

            Kembali

        </a>

        <a
            href="{{ route('admin.jabatan.edit',$jabatan->id) }}"
            class="btn btn-warning text-white">

            <i class="bi bi-pencil-square me-2"></i>

            Edit Jabatan

        </a>

    </div>

</div>

@endsection

@push('styles')

<style>

.detail-card{
    background:#fff;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(15,76,129,.08);
}

.detail-header{
    display:flex;
    align-items:center;
    gap:20px;
    padding:30px;
    border-bottom:1px solid #edf2f7;
}

.detail-icon{
    width:72px;
    height:72px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
}

.detail-header h3{
    margin:0;
    font-size:24px;
    font-weight:700;
    color:#1e293b;
}

.detail-body{
    padding:30px;
}

.detail-label{
    display:block;
    margin-bottom:8px;
    font-size:13px;
    font-weight:700;
    color:#64748b;
    text-transform:uppercase;
    letter-spacing:.5px;
}

.detail-value{
    background:#f8fafc;
    border:1px solid #e2e8f0;
    border-radius:12px;
    padding:14px 16px;
    min-height:52px;
    display:flex;
    align-items:center;
    color:#1e293b;
}

.detail-description{
    min-height:120px;
    align-items:flex-start;
    white-space:pre-wrap;
}

.detail-footer{
    border-top:1px solid #edf2f7;
    padding:24px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.detail-footer .btn{
    min-width:170px;
    border-radius:12px;
}

@media(max-width:768px){

    .detail-header{
        flex-direction:column;
        text-align:center;
    }

    .detail-body{
        padding:20px;
    }

    .detail-footer{
        flex-direction:column;
        gap:15px;
    }

    .detail-footer .btn{
        width:100%;
    }

}

</style>

@endpush
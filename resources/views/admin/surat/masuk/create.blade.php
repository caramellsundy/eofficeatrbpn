@extends('layouts.admin')

@section('title','Tambah Surat Masuk')

@section('content')

<div class="page-header fade-up">

    <div>

        <h2>

            <i class="bi bi-envelope-plus-fill text-primary"></i>

            Tambah Surat Masuk

        </h2>

        <p class="text-muted mb-0">

            Tambahkan data surat masuk ke sistem.

        </p>

    </div>

    <a
        href="{{ route('admin.surat.masuk.index') }}"
        class="btn btn-light border">

        <i class="bi bi-arrow-left-circle me-2"></i>

        Kembali

    </a>

</div>

<div class="form-card fade-up">

    <div class="card-header">

        <h4>

            Form Surat Masuk

        </h4>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.surat.masuk.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="row">

                {{-- Nomor Surat --}}

                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Nomor Surat

                    </label>

                    <input
                        type="text"
                        name="nomor_surat"
                        class="form-control @error('nomor_surat') is-invalid @enderror"
                        value="{{ old('nomor_surat') }}">

                    @error('nomor_surat')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                {{-- Tanggal Surat --}}

                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Tanggal Surat

                    </label>

                    <input
                        type="date"
                        name="tanggal_surat"
                        class="form-control @error('tanggal_surat') is-invalid @enderror"
                        value="{{ old('tanggal_surat') }}">

                    @error('tanggal_surat')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                                {{-- =========================================== --}}
                {{-- PERIHAL --}}
                {{-- =========================================== --}}

                <div class="col-12 mb-4">

                    <label class="form-label">

                        Perihal

                    </label>

                    <input
                        type="text"
                        name="perihal"
                        class="form-control @error('perihal') is-invalid @enderror"
                        value="{{ old('perihal') }}"
                        placeholder="Masukkan perihal surat">

                    @error('perihal')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                {{-- =========================================== --}}
                {{-- ASAL SURAT --}}
                {{-- =========================================== --}}

                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Asal Surat

                    </label>

                    <input
                        type="text"
                        name="asal_surat"
                        class="form-control @error('asal_surat') is-invalid @enderror"
                        value="{{ old('asal_surat') }}"
                        placeholder="Instansi / Pengirim">

                    @error('asal_surat')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                {{-- =========================================== --}}
                {{-- NOMOR AGENDA --}}
                {{-- =========================================== --}}

                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Nomor Agenda

                    </label>

                    <input
                        type="text"
                        name="nomor_agenda"
                        class="form-control @error('nomor_agenda') is-invalid @enderror"
                        value="{{ old('nomor_agenda') }}"
                        placeholder="Nomor Agenda">

                    @error('nomor_agenda')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                {{-- =========================================== --}}
                {{-- METODE --}}
                {{-- =========================================== --}}

                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Metode Pengiriman

                    </label>

                    <select
                        name="metode"
                        class="form-select">

                        <option value="">

                            -- Pilih Metode --

                        </option>

                        <option value="Email"
                            {{ old('metode')=='Email' ? 'selected' : '' }}>

                            Email

                        </option>

                        <option value="Kurir"
                            {{ old('metode')=='Kurir' ? 'selected' : '' }}>

                            Kurir

                        </option>

                        <option value="Pos"
                            {{ old('metode')=='Pos' ? 'selected' : '' }}>

                            Pos

                        </option>

                        <option value="Langsung"
                            {{ old('metode')=='Langsung' ? 'selected' : '' }}>

                            Langsung

                        </option>

                    </select>

                </div>

                {{-- =========================================== --}}
                {{-- PRIORITAS --}}
                {{-- =========================================== --}}

                <div class="col-md-6 mb-4">

                    <label class="form-label d-block">

                        Prioritas

                    </label>

                    <div class="form-check form-switch mt-2">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="priority"
                            name="is_priority"
                            value="1"
                            {{ old('is_priority') ? 'checked' : '' }}>

                        <label
                            class="form-check-label"
                            for="priority">

                            Tandai sebagai surat prioritas

                        </label>

                    </div>

                </div>

                {{-- =========================================== --}}
                {{-- FILE SURAT --}}
                {{-- =========================================== --}}

                <div class="col-12 mb-4">

                    <label class="form-label">

                        Upload File Surat

                    </label>

                    <input
                        type="file"
                        name="file_path"
                        class="form-control @error('file_path') is-invalid @enderror">

                    <small class="text-muted">

                        Format PDF, DOC, DOCX, JPG, PNG.

                    </small>

                    @error('file_path')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                                {{-- =========================================== --}}
                {{-- DESKRIPSI --}}
                {{-- =========================================== --}}

                <div class="col-12 mb-4">

                    <label class="form-label">

                        Deskripsi

                    </label>

                    <textarea
                        name="deskripsi"
                        rows="5"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        placeholder="Tambahkan keterangan surat (opsional)">{{ old('deskripsi') }}</textarea>

                    @error('deskripsi')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                {{-- =========================================== --}}
                {{-- BUTTON --}}
                {{-- =========================================== --}}

                <div class="col-12">

                    <hr>

                    <div class="form-action">

                        <a
                            href="{{ route('admin.surat.masuk.index') }}"
                            class="btn btn-light border">

                            <i class="bi bi-arrow-left-circle me-2"></i>

                            Batal

                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            Simpan Surat

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection

@push('styles')

<style>

.form-card{

    background:#fff;

    border-radius:20px;

    overflow:hidden;

    box-shadow:0 10px 30px rgba(15,76,129,.08);

}

.form-card .card-header{

    background:#fff;

    border-bottom:1px solid #edf2f7;

    padding:24px 30px;

}

.form-card .card-header h4{

    margin:0;

    font-weight:700;

    color:#1e293b;

}

.form-card .card-body{

    padding:30px;

}

.form-label{

    font-weight:600;

    color:#334155;

    margin-bottom:8px;

}

.form-control,

.form-select{

    min-height:48px;

    border-radius:12px;

    border:1px solid #dbe2ea;

}

.form-control:focus,

.form-select:focus{

    border-color:#0F4C81;

    box-shadow:0 0 0 .2rem rgba(15,76,129,.15);

}

textarea.form-control{

    min-height:120px;

    resize:vertical;

}

.form-action{

    display:flex;

    justify-content:space-between;

    align-items:center;

    gap:15px;

}

.form-action .btn{

    min-width:170px;

    border-radius:12px;

    padding:10px 18px;

}

.form-check-input{

    width:48px;

    height:24px;

}

@media(max-width:768px){

    .form-card .card-body{

        padding:20px;

    }

    .form-action{

        flex-direction:column;

        align-items:stretch;

    }

    .form-action .btn{

        width:100%;

        min-width:unset;

    }

}

</style>

@endpush
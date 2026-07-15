@extends('layouts.admin')

@section('title','Edit Jabatan')

@section('content')

<div class="page-header fade-up">

    <div>

        <h2>

            <i class="bi bi-pencil-square text-warning"></i>

            Edit Jabatan

        </h2>

        <p class="text-muted mb-0">

            Perbarui data jabatan.

        </p>

    </div>

    <a
        href="{{ route('admin.jabatan.index') }}"
        class="btn btn-light border">

        <i class="bi bi-arrow-left-circle me-2"></i>

        Kembali

    </a>

</div>

<div class="form-card fade-up">

    <div class="card-header">

        <h4>

            Form Edit Jabatan

        </h4>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.jabatan.update',$jabatan->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                {{-- Nama Jabatan --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Nama Jabatan

                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama',$jabatan->nama) }}"
                        placeholder="Masukkan nama jabatan">

                    @error('nama')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

                {{-- Kode Jabatan --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label">

                        Kode Jabatan

                    </label>

                    <input
                        type="text"
                        name="kode"
                        class="form-control @error('kode') is-invalid @enderror"
                        value="{{ old('kode',$jabatan->kode) }}"
                        placeholder="Contoh: KABAG">

                    @error('kode')

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
                        placeholder="Masukkan deskripsi jabatan (opsional)">{{ old('deskripsi',$jabatan->deskripsi) }}</textarea>

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
                            href="{{ route('admin.jabatan.index') }}"
                            class="btn btn-light border">

                            <i class="bi bi-arrow-left-circle me-2"></i>

                            Batal

                        </a>

                        <button
                            type="submit"
                            class="btn btn-warning text-white">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            Update Jabatan

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
    font-size:22px;
    font-weight:700;
    color:#1e293b;
}

.form-card .card-body{
    padding:30px;
}

.form-label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#334155;
}

.form-control{
    min-height:48px;
    border:1px solid #dbe2ea;
    border-radius:12px;
}

.form-control:focus{
    border-color:#0F4C81;
    box-shadow:0 0 0 .2rem rgba(15,76,129,.15);
}

textarea.form-control{
    min-height:140px;
    resize:vertical;
}

.form-action{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:15px;
}

.form-action .btn{
    min-width:180px;
    border-radius:12px;
    padding:10px 18px;
    font-weight:600;
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
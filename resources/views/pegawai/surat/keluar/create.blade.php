@extends('layouts.pegawai')

@section('title','Tambah Surat Keluar')

@section('content')

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

{{-- Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

<style>

body{
    background:#f4f6f9;
}

.page-title{
    font-size:28px;
    font-weight:700;
    color:#0d6efd;
}

.card-custom{
    border:none;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 5px 18px rgba(0,0,0,.08);
}

.card-header-custom{
    background:#0d6efd;
    color:#fff;
    padding:18px 25px;
}

.card-header-custom h5{
    margin:0;
    font-weight:700;
}

.form-label{
    font-weight:600;
    color:#495057;
}

.form-control,
.form-select{
    border-radius:10px;
    min-height:46px;
}

textarea.form-control{
    min-height:140px;
}

.btn{
    border-radius:10px;
    font-weight:600;
    padding:10px 22px;
}

.required{
    color:red;
}

.select2-container--default .select2-selection--single{

    height:46px;

    border-radius:10px;

    border:1px solid #ced4da;

}

.select2-selection__rendered{

    line-height:44px !important;

}

.select2-selection__arrow{

    height:44px !important;

}

.select2-results__group{

    background:#0d6efd;

    color:#fff;

    padding:8px;

    font-weight:bold;

}

.file-preview{

    margin-top:10px;

    display:none;

}

</style>

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="page-title">

                <i class="bi bi-send-fill"></i>

                Tambah Surat Keluar

            </h2>

            <small class="text-muted">

                Input surat keluar dan kirim ke pegawai tujuan.

            </small>

        </div>

        <a href="{{ route('pegawai.surat.keluar') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left-circle"></i>

            Kembali

        </a>

    </div>

    {{-- Alert Error --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Terjadi Kesalahan</strong>

            <hr>

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="card card-custom">

        <div class="card-header-custom">

            <h5>

                <i class="bi bi-envelope-paper-fill"></i>

                FORM SURAT KELUAR

            </h5>

        </div>

        <div class="card-body p-4">

            <form
                action="{{ route('pegawai.surat.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <input
                    type="hidden"
                    name="jenis_surat"
                    value="keluar">

                <div class="row">

                    {{-- Nomor Surat --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Nomor Surat

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="nomor_surat"
                            class="form-control"
                            value="{{ old('nomor_surat') }}"
                            required>

                    </div>

                    {{-- Tanggal --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Tanggal Surat

                            <span class="required">*</span>

                        </label>

                        <input
                            type="date"
                            name="tanggal_surat"
                            class="form-control"
                            value="{{ old('tanggal_surat',date('Y-m-d')) }}"
                            required>

                    </div>

                                        {{-- Perihal --}}
                    <div class="col-md-12 mb-3">

                        <label class="form-label">

                            Perihal

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="perihal"
                            class="form-control"
                            value="{{ old('perihal') }}"
                            placeholder="Contoh : Permohonan Data"
                            required>

                    </div>

                    {{-- Judul Surat --}}
                    <div class="col-md-12 mb-3">

                        <label class="form-label">

                            Judul Surat

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="judul_surat"
                            class="form-control"
                            value="{{ old('judul_surat') }}"
                            placeholder="Masukkan judul surat"
                            required>

                    </div>

                    {{-- Tujuan Instansi --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Tujuan Instansi

                        </label>

                        <input
                            type="text"
                            name="tujuan_surat"
                            class="form-control"
                            value="{{ old('tujuan_surat') }}"
                            placeholder="Contoh : Kantor Pertanahan Kota Banda Aceh">

                    </div>

                    {{-- Nomor Agenda --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Nomor Agenda

                        </label>

                        <input
                            type="text"
                            name="nomor_agenda"
                            class="form-control"
                            value="{{ old('nomor_agenda') }}"
                            placeholder="Opsional">

                    </div>

                    {{-- Kode Surat --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Kode Surat

                        </label>

                        <input
                            type="text"
                            name="kode_surat"
                            class="form-control"
                            value="{{ old('kode_surat') }}"
                            placeholder="Contoh : 590">

                    </div>

                    {{-- Sifat Surat --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Sifat Surat

                        </label>

                        <select
                            name="is_priority"
                            class="form-select">

                            <option value="0">

                                Biasa

                            </option>

                            <option value="1"
                                {{ old('is_priority')=='1' ? 'selected' : '' }}>

                                Penting

                            </option>

                        </select>

                    </div>

                    {{-- Metode Pengiriman --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Metode Pengiriman

                        </label>

                        <select
                            name="metode"
                            class="form-select">

                            <option value="">

                                Pilih Metode

                            </option>

                            <option value="Email">

                                Email

                            </option>

                            <option value="Kurir">

                                Kurir

                            </option>

                            <option value="Pos">

                                Pos

                            </option>

                            <option value="Langsung">

                                Langsung

                            </option>

                        </select>

                    </div>

                    {{-- Status --}}
                    <div class="col-md-6 mb-3">

    <label class="form-label">
        Status Surat
    </label>

    <select
        name="status"
        class="form-select">

        <option value="menunggu" selected>
            Menunggu
        </option>

        <option value="diproses">
            Diproses
        </option>

        <option value="ditinjau">
            Ditinjau
        </option>

        <option value="selesai">
            Selesai
        </option>

    </select>

</div>

                    {{-- Deskripsi --}}
                    <div class="col-md-12 mb-4">

                        <label class="form-label">

                            Isi / Deskripsi Surat

                            <span class="required">*</span>

                        </label>

                        <textarea
                            name="deskripsi"
                            class="form-control"
                            rows="6"
                            placeholder="Tuliskan isi surat..."
                            required>{{ old('deskripsi') }}</textarea>

                    </div>

                    <hr class="my-4">

                    <h5 class="mb-4 text-primary">

                        <i class="bi bi-person-lines-fill"></i>

                        Tujuan Surat

                    </h5>

                    {{-- Kirim Kepada --}}
                    <div class="col-md-12 mb-4">

                        <label class="form-label">

                            Kirim Kepada Pegawai

                            <span class="required">*</span>

                        </label>

                        <select
                            name="pegawai_tujuan"
                            id="pegawai_tujuan"
                            class="form-select select-pegawai"
                            required>

                            <option value="">
                                Pilih Pegawai Tujuan
                            </option>

                            @foreach($unitKerja as $unit)

                                @if($unit->pegawai->count())

                                    <optgroup label="📂 {{ $unit->nama }}">

                                        @foreach($unit->pegawai->sortBy('nama') as $pegawai)

                                            <option
                                                value="{{ $pegawai->id }}"
                                                data-unit="{{ $unit->nama }}"
                                                data-jabatan="{{ $pegawai->jabatan->nama ?? '-' }}"
                                                {{ old('pegawai_tujuan')==$pegawai->id ? 'selected' : '' }}>

                                                {{ $pegawai->nama }}
                                                — {{ $pegawai->jabatan->nama ?? '-' }}

                                            </option>

                                        @endforeach

                                    </optgroup>

                                @endif

                            @endforeach

                        </select>

                        <small class="text-muted">

                            Cari berdasarkan nama pegawai atau pilih berdasarkan unit kerja.

                        </small>

                    </div>

                    {{-- Tembusan --}}
                    <div class="col-md-12 mb-4">

                        <label class="form-label">

                            Tembusan

                        </label>

                        <select
                            name="tembusan[]"
                            class="form-select select-pegawai"
                            multiple>

                            @foreach($unitKerja as $unit)

                                @if($unit->pegawai->count())

                                    <optgroup label="📂 {{ $unit->nama }}">

                                        @foreach($unit->pegawai->sortBy('nama') as $pegawai)

                                            <option
                                                value="{{ $pegawai->id }}">

                                                {{ $pegawai->nama }}
                                                — {{ $pegawai->jabatan->nama ?? '-' }}

                                            </option>

                                        @endforeach

                                    </optgroup>

                                @endif

                            @endforeach

                        </select>

                        <small class="text-muted">

                            Opsional. Pilih lebih dari satu pegawai sebagai tembusan.

                        </small>

                    </div>

                    {{-- Catatan --}}
                    <div class="col-md-12 mb-4">

                        <label class="form-label">

                            Catatan Tambahan

                        </label>

                        <textarea
                            name="catatan_admin"
                            rows="3"
                            class="form-control"
                            placeholder="Catatan untuk penerima surat...">{{ old('catatan_admin') }}</textarea>

                    </div>

                    {{-- Upload Dokumen --}}
                    <div class="col-md-12 mb-4">

                        <label class="form-label">

                            Upload Dokumen Surat

                        </label>

                        <input
                            type="file"
                            name="dokumen"
                            id="dokumen"
                            class="form-control"
                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">

                        <small class="text-muted">

                            Format: PDF, DOC, DOCX, JPG, PNG (Maks. 5 MB)

                        </small>

                        <div
                            id="preview-file"
                            class="alert alert-info mt-3 d-none">

                        </div>

                    </div>

                                        <hr>

                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('pegawai.surat.keluar') }}"
                           class="btn btn-secondary">

                            <i class="bi bi-arrow-left-circle"></i>

                            Kembali

                        </a>

                        <button
                            type="reset"
                            class="btn btn-warning text-white">

                            <i class="bi bi-arrow-counterclockwise"></i>

                            Reset

                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="bi bi-send-fill"></i>

                            Kirim Surat

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection

@push('scripts')

<script>

$(document).ready(function(){

    $('.select-pegawai').select2({

        width:'100%',

        placeholder:'Cari nama pegawai atau jabatan...',

        allowClear:true,

        closeOnSelect:true

    });

    $('#dokumen').on('change',function(){

        let file=this.files[0];

        if(file){

            $('#preview-file')
                .removeClass('d-none')
                .html(

                    '<i class="bi bi-file-earmark-text-fill text-primary"></i> '

                    +'<strong>'+file.name+'</strong>'

                    +'<br><small>Ukuran : '

                    +(file.size/1024/1024).toFixed(2)

                    +' MB</small>'

                );

        }else{

            $('#preview-file')

                .addClass('d-none')

                .html('');

        }

    });

});

</script>

@endpush


                

                   
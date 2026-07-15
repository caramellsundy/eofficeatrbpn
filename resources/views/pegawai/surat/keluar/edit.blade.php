@extends('layouts.pegawai')

@section('title','Edit Surat Keluar')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

.page-title{
    font-size:26px;
    font-weight:700;
    color:#0d6efd;
}

.card-custom{
    border:none;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
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
    min-height:46px;
    border-radius:10px;
}

textarea.form-control{
    min-height:140px;
}

.required{
    color:red;
}

.section-title{
    font-size:22px;
    font-weight:700;
    color:#0d6efd;
    margin-bottom:25px;
}

.info-box{
    background:#f8f9fa;
    border-left:4px solid #0d6efd;
    padding:15px;
    border-radius:8px;
    margin-bottom:20px;
}

</style>

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="page-title">

                <i class="bi bi-pencil-square"></i>

                Edit Surat Keluar

            </h2>

            <small class="text-muted">

                Perbarui data surat keluar beserta tujuan disposisinya.

            </small>

        </div>

        <a href="{{ route('pegawai.surat.keluar') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

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

                FORM EDIT SURAT KELUAR

            </h5>

        </div>

        <div class="card-body p-4">

            <form action="{{ route('pegawai.surat.update',$surat->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <input
                    type="hidden"
                    name="jenis_surat"
                    value="keluar">

                <div class="info-box">

                    <i class="bi bi-info-circle-fill text-primary"></i>

                    Silakan ubah data surat keluar di bawah ini. Semua perubahan akan langsung memperbarui data surat.

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Nomor Surat

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="nomor_surat"
                            class="form-control"
                            value="{{ old('nomor_surat',$surat->nomor_surat) }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Tanggal Surat

                            <span class="required">*</span>

                        </label>

                        <input
                            type="date"
                            name="tanggal_surat"
                            class="form-control"
                            value="{{ old('tanggal_surat', \Carbon\Carbon::parse($surat->tanggal_surat)->format('Y-m-d')) }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Tujuan Surat

                            <span class="required">*</span>

                        </label>

                        <input
                            type="text"
                            name="tujuan_surat"
                            class="form-control"
                            value="{{ old('tujuan_surat',$surat->tujuan_surat) }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Metode Pengiriman

                        </label>

                        <select
                            name="metode"
                            class="form-select">

                            <option value="">Pilih</option>

                            <option value="Email"
                            {{ old('metode',$surat->metode)=='Email' ? 'selected' : '' }}>
                                Email
                            </option>

                            <option value="Kurir"
                            {{ old('metode',$surat->metode)=='Kurir' ? 'selected' : '' }}>
                                Kurir
                            </option>

                            <option value="Loket"
                            {{ old('metode',$surat->metode)=='Loket' ? 'selected' : '' }}>
                                Loket
                            </option>

                        </select>

                    </div>

                                        <div class="col-md-12 mb-3">

                        <label class="form-label">
                            Judul Surat
                            <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="judul_surat"
                            class="form-control"
                            value="{{ old('judul_surat',$surat->judul_surat) }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Perihal

                        </label>

                        <input
                            type="text"
                            name="perihal"
                            class="form-control"
                            value="{{ old('perihal',$surat->perihal) }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Kode Surat

                        </label>

                        <input
                            type="text"
                            name="kode_surat"
                            class="form-control"
                            value="{{ old('kode_surat',$surat->kode_surat) }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Nomor Agenda

                        </label>

                        <input
                            type="text"
                            name="nomor_agenda"
                            class="form-control"
                            value="{{ old('nomor_agenda',$surat->nomor_agenda) }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Prioritas

                        </label>

                        <select
                            name="is_priority"
                            class="form-select">

                            <option value="0"
                                {{ old('is_priority',$surat->is_priority)==0 ? 'selected' : '' }}>
                                Normal
                            </option>

                            <option value="1"
                                {{ old('is_priority',$surat->is_priority)==1 ? 'selected' : '' }}>
                                Prioritas
                            </option>

                        </select>

                    </div>

                    <div class="col-md-12 mb-4">

                        <label class="form-label">

                            Deskripsi Surat

                        </label>

                        <textarea
                            name="deskripsi"
                            rows="5"
                            class="form-control"
                            placeholder="Masukkan isi atau deskripsi surat...">{{ old('deskripsi',$surat->deskripsi) }}</textarea>

                    </div>

                </div>

                <hr class="my-4">

                <h4 class="section-title">

                    <i class="bi bi-diagram-3-fill"></i>

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

@extends('layouts.pegawai')

@section('title','Registrasi Surat Masuk')

@section('content')

<div class="page-header fade-up">

    <div>

        <h2>

            <i class="bi bi-envelope-plus-fill text-primary me-2"></i>

            Registrasi Surat Masuk

        </h2>

        <p class="text-muted mb-0">

            Input surat yang diterima dari loket sebelum dikirim ke Admin.

        </p>

    </div>

    <a href="{{ route('pegawai.surat-masuk.index') }}"
       class="btn btn-light border">

        <i class="bi bi-arrow-left-circle me-2"></i>

        Kembali

    </a>

</div>


<form action="{{ route('pegawai.surat-masuk.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf


    {{-- ================= INFORMASI REGISTRASI ================= --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                <i class="bi bi-journal-text me-2"></i>

                Informasi Registrasi Surat

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                {{-- Nomor Surat --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">

                        Nomor Surat

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="nomor_surat"
                        class="form-control @error('nomor_surat') is-invalid @enderror"
                        value="{{ old('nomor_surat') }}"
                        placeholder="Contoh : B-123/ATR/VII/2026">

                    @error('nomor_surat')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- Tanggal Surat --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">

                        Tanggal Surat

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="date"
                        name="tanggal_surat"
                        class="form-control @error('tanggal_surat') is-invalid @enderror"
                        value="{{ old('tanggal_surat', date('Y-m-d')) }}">

                    @error('tanggal_surat')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- Nomor Agenda --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">

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



                {{-- Kode Surat --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">

                        Kode Surat

                    </label>

                    <input
                        type="text"
                        name="kode_surat"
                        class="form-control @error('kode_surat') is-invalid @enderror"
                        value="{{ old('kode_surat') }}"
                        placeholder="Contoh : KP.02.03">

                    @error('kode_surat')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>

    </div>

        {{-- ================= INFORMASI PENGIRIM ================= --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">

                <i class="bi bi-building me-2"></i>

                Informasi Pengirim

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                {{-- Asal Surat --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">

                        Asal Surat

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="asal_surat"
                        class="form-control @error('asal_surat') is-invalid @enderror"
                        value="{{ old('asal_surat') }}"
                        placeholder="Instansi / Perorangan">

                    @error('asal_surat')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- Tujuan Surat --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">

                        Tujuan Surat

                    </label>

                    <input
                        type="text"
                        name="tujuan_surat"
                        class="form-control @error('tujuan_surat') is-invalid @enderror"
                        value="{{ old('tujuan_surat') }}"
                        placeholder="Contoh : Kepala Kantor ATR/BPN">

                    @error('tujuan_surat')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- Penandatangan --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">

                        Penandatangan

                    </label>

                    <input
                        type="text"
                        name="penandatangan"
                        class="form-control @error('penandatangan') is-invalid @enderror"
                        value="{{ old('penandatangan') }}"
                        placeholder="Nama penandatangan surat">

                    @error('penandatangan')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>



                {{-- Lampiran --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">

                        Lampiran

                    </label>

                    <input
                        type="text"
                        name="lampiran"
                        class="form-control @error('lampiran') is-invalid @enderror"
                        value="{{ old('lampiran') }}"
                        placeholder="Contoh : 2 Berkas">

                    @error('lampiran')

                        <div class="invalid-feedback">

                            {{ $message }}

                        </div>

                    @enderror

                </div>

            </div>

        </div>

    </div>




    {{-- ================= ISI SURAT ================= --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-info text-white">

            <h5 class="mb-0">

                <i class="bi bi-file-earmark-text me-2"></i>

                Isi Surat

            </h5>

        </div>

        <div class="card-body">

            {{-- Judul Surat --}}

            <div class="mb-4">

                <label class="form-label fw-semibold">

                    Judul Surat

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="judul_surat"
                    class="form-control @error('judul_surat') is-invalid @enderror"
                    value="{{ old('judul_surat') }}"
                    placeholder="Masukkan judul surat">

                @error('judul_surat')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>



            {{-- Perihal --}}

            <div class="mb-4">

                <label class="form-label fw-semibold">

                    Perihal

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="perihal"
                    class="form-control @error('perihal') is-invalid @enderror"
                    value="{{ old('perihal') }}"
                    placeholder="Perihal surat">

                @error('perihal')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>



            {{-- Catatan Pegawai --}}

            <div class="mb-3">

                <label class="form-label fw-semibold">

                    Catatan Pegawai

                </label>

                <textarea
                    name="deskripsi"
                    rows="5"
                    class="form-control @error('deskripsi') is-invalid @enderror"
                    placeholder="Contoh:
- Surat diterima melalui loket.
- Lampiran lengkap.
- Perlu segera diproses.
- Kondisi fisik surat baik.">{{ old('deskripsi') }}</textarea>

                @error('deskripsi')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

        </div>

    </div>

        {{-- ================= INFORMASI PENERIMAAN ================= --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-warning">

            <h5 class="mb-0 text-dark">

                <i class="bi bi-inbox-fill me-2"></i>

                Informasi Penerimaan

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                {{-- Metode Penerimaan --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">

                        Metode Penerimaan

                    </label>

                    <select
                        name="metode"
                        class="form-select @error('metode') is-invalid @enderror">

                        <option value="">
                            -- Pilih Metode --
                        </option>

                        <option value="Loket"
                            {{ old('metode')=='Loket'?'selected':'' }}>
                            Loket
                        </option>

                        <option value="Email"
                            {{ old('metode')=='Email'?'selected':'' }}>
                            Email
                        </option>

                        <option value="Pos"
                            {{ old('metode')=='Pos'?'selected':'' }}>
                            Pos
                        </option>

                        <option value="Kurir"
                            {{ old('metode')=='Kurir'?'selected':'' }}>
                            Kurir
                        </option>

                        <option value="Ekspedisi"
                            {{ old('metode')=='Ekspedisi'?'selected':'' }}>
                            Ekspedisi
                        </option>

                        <option value="Lainnya"
                            {{ old('metode')=='Lainnya'?'selected':'' }}>
                            Lainnya
                        </option>

                    </select>

                    @error('metode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>



                {{-- Upload Scan --}}
                <div class="col-md-6 mb-4">

                    <label class="form-label fw-semibold">

                        Upload Scan Surat

                    </label>

                    <input
                        type="file"
                        name="file_path"
                        class="form-control @error('file_path') is-invalid @enderror">

                    <small class="text-muted">

                        PDF, DOC, DOCX, JPG, PNG (Maks 5 MB)

                    </small>

                    @error('file_path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>



    {{-- Status Draft --}}
    <input
        type="hidden"
        name="jenis_surat"
        value="masuk">

    <input
        type="hidden"
        name="status"
        value="Draft">



    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                                <a href="{{ route('pegawai.surat-masuk.index') }}"
                   class="btn btn-light border px-4">

                    <i class="bi bi-arrow-left-circle me-2"></i>

                    Batal

                </a>


                <div class="d-flex gap-2">

                    {{-- Simpan Draft --}}
                    <button
                        type="submit"
                        name="aksi"
                        value="draft"
                        class="btn btn-secondary px-4">

                        <i class="bi bi-save-fill me-2"></i>

                        Simpan Draft

                    </button>


                    {{-- Kirim ke Admin --}}
                    <button
                        type="submit"
                        name="aksi"
                        value="kirim"
                        class="btn btn-primary px-4">

                        <i class="bi bi-send-fill me-2"></i>

                        Kirim ke Admin

                    </button>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection


@push('styles')

<style>

.page-header{

    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;

}

.card{

    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(15,76,129,.08);

}

.card-header{

    padding:18px 25px;
    font-weight:700;

}

.card-body{

    padding:30px;

}

.form-label{

    font-weight:600;
    color:#334155;
    margin-bottom:8px;

}

.form-control,
.form-select{

    min-height:50px;
    border-radius:12px;
    border:1px solid #d9e2ec;

}

.form-control:focus,
.form-select:focus{

    border-color:#0F4C81;
    box-shadow:0 0 0 .2rem rgba(15,76,129,.15);

}

textarea.form-control{

    min-height:140px;
    resize:vertical;

}

.btn{

    border-radius:12px;
    padding:11px 22px;

}

.btn-primary{

    background:#0F4C81;
    border-color:#0F4C81;

}

.btn-primary:hover{

    background:#0b3c65;
    border-color:#0b3c65;

}

.btn-secondary{

    background:#64748b;
    border-color:#64748b;

}

.btn-secondary:hover{

    background:#475569;
    border-color:#475569;

}

@media(max-width:768px){

.page-header{

flex-direction:column;
align-items:flex-start;
gap:15px;

}

.card-body{

padding:20px;

}

.d-flex.justify-content-between{

flex-direction:column;
gap:15px;

}

.d-flex.gap-2{

width:100%;
flex-direction:column;

}

.d-flex.gap-2 .btn{

width:100%;

}

}

</style>

@endpush
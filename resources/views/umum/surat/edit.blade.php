@extends('layouts.umum')

@section('title', 'Ubah Surat')

@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Ubah Surat</h4>
            <p class="text-muted mb-0">Perbarui data surat sebelum diproses.</p>
        </div>
        <a href="{{ route('umum.surat.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
    </div>

    <form action="{{ route('umum.surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data" class="card shadow-sm border-0">
        @csrf
        @method('PUT')
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Nomor Surat</label><input type="text" name="nomor_surat" value="{{ old('nomor_surat', $surat->nomor_surat) }}" class="form-control @error('nomor_surat') is-invalid @enderror" required>@error('nomor_surat')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                <div class="col-md-6"><label class="form-label">Tanggal Surat</label><input type="date" name="tanggal_surat" value="{{ old('tanggal_surat', optional($surat->tanggal_surat)->format('Y-m-d')) }}" class="form-control @error('tanggal_surat') is-invalid @enderror" required>@error('tanggal_surat')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                <div class="col-md-6"><label class="form-label">Kode Surat</label><input type="text" name="kode_surat" value="{{ old('kode_surat', $surat->kode_surat) }}" class="form-control"></div>
                <div class="col-md-6"><label class="form-label">Judul Surat</label><input type="text" name="judul_surat" value="{{ old('judul_surat', $surat->judul_surat) }}" class="form-control"></div>
                <div class="col-12"><label class="form-label">Perihal</label><input type="text" name="perihal" value="{{ old('perihal', $surat->perihal) }}" class="form-control @error('perihal') is-invalid @enderror" required>@error('perihal')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                <div class="col-md-6"><label class="form-label">Asal Surat</label><input type="text" name="asal_surat" value="{{ old('asal_surat', $surat->asal_surat) }}" class="form-control"></div>
                <div class="col-md-6"><label class="form-label">Tujuan Surat</label><input type="text" name="tujuan_surat" value="{{ old('tujuan_surat', $surat->tujuan_surat) }}" class="form-control"></div>
                <div class="col-md-6"><label class="form-label">Penandatangan</label><input type="text" name="penandatangan" value="{{ old('penandatangan', $surat->penandatangan) }}" class="form-control"></div>
                <div class="col-md-6"><label class="form-label">Metode Pengiriman</label><input type="text" name="metode" value="{{ old('metode', $surat->metode) }}" class="form-control"></div>
                <div class="col-12"><label class="form-label">Deskripsi</label><textarea name="deskripsi" rows="5" class="form-control">{{ old('deskripsi', $surat->deskripsi) }}</textarea></div>
                <div class="col-12"><label class="form-label">Ganti Lampiran</label><input type="file" name="file_path" class="form-control" accept=".pdf,.doc,.docx"><small class="text-muted">Kosongkan bila lampiran tidak diubah.</small></div>
            </div>
        </div>
        <div class="card-footer bg-white text-end"><button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Perubahan</button></div>
    </form>
</div>
@endsection

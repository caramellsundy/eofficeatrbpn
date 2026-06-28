@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">Pratinjau Surat: {{ $surat->nomor_surat }}</div>
                <div class="card-body p-0">
                    @if($surat->file_surat)
                        <embed src="{{ asset('storage/' . $surat->file_surat) }}" width="100%" height="700px" type="application/pdf">
                    @else
                        <div class="text-center py-5">File surat tidak tersedia.</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Detail Surat</div>
                <div class="card-body">
                    <p><strong>Perihal:</strong> {{ $surat->judul_surat }}</p>
                    <p><strong>Asal:</strong> {{ $surat->asal_instansi }}</p>
                    <p><strong>Tanggal:</strong> {{ $surat->tanggal_surat }}</p>
                    <hr>
                    <p><strong>Ringkasan:</strong><br>{{ $surat->ringkasan_isi }}</p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">Form Disposisi</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('disposisi.store', $surat->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Kepada Petugas/Unit:</label>
                            <input type="text" name="kepada_petugas" class="form-control" required placeholder="Contoh: Sekretaris/Bagian Umum">
                        </div>
                        <div class="mb-3">
                            <label>Instruksi Pimpinan:</label>
                            <textarea name="instruksi" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Batas Waktu:</label>
                            <input type="date" name="batas_waktu" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Kirim Disposisi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
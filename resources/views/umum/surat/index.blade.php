@extends('layouts.umum')

@section('title', 'Surat Saya')

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Surat Saya</h4>
            <p class="text-muted mb-0">Pantau pengajuan surat yang Anda buat.</p>
        </div>
        <a href="{{ route('umum.surat.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Buat Surat
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Nomor Surat</th>
                        <th>Jenis</th>
                        <th>Perihal</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surats as $surat)
                        <tr>
                            <td class="ps-3 fw-semibold">{{ $surat->nomor_surat }}</td>
                            <td>{{ ucfirst($surat->jenis_surat) }}</td>
                            <td>{{ $surat->perihal }}</td>
                            <td>{{ optional($surat->tanggal_surat)->format('d-m-Y') }}</td>
                            <td><span class="badge text-bg-{{ $surat->status_badge }}">{{ $surat->status_label }}</span></td>
                            <td class="text-end pe-3">
                                <a href="{{ route('umum.surat.show', $surat->id) }}" class="btn btn-sm btn-outline-primary" title="Lihat surat"><i class="bi bi-eye"></i></a>
                                @if($surat->status === 'menunggu')
                                    <a href="{{ route('umum.surat.edit', $surat->id) }}" class="btn btn-sm btn-outline-secondary" title="Ubah surat"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('umum.surat.destroy', $surat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus surat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus surat"><i class="bi bi-trash"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-5">Belum ada surat yang diajukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $surats->links() }}</div>
</div>
@endsection

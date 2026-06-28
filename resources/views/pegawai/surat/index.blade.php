<x-app-layout>
    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .card-header-custom { background-color: #0d6efd; color: white; padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; }
        .stats-card { background: #fff; border-radius: 8px; padding: 15px; border-left: 5px solid #0d6efd; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .table thead th { background-color: #f8f9fa; color: #495057; font-weight: 700; text-transform: uppercase; font-size: 0.70rem; }
        .action-btn { border: none; background: #f8f9fa; padding: 6px 10px; border-radius: 4px; transition: 0.2s; }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- 0. NOTIFIKASI SUKSES (Tambahan Baru) --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- 1. BAGIAN STATISTIK --}}
            <div class="row g-3 mb-4">
                @php
                    $boxes = [
                        ['label' => 'Loket Hari Ini', 'val' => $stats['loket_hari_ini'] ?? 0],
                        ['label' => 'Email Hari Ini', 'val' => $stats['email_hari_ini'] ?? 0],
                        ['label' => 'Total Hari Ini', 'val' => $stats['total_hari_ini'] ?? 0],
                        ['label' => 'Total Bulan Ini', 'val' => $stats['total_bulan_ini'] ?? 0],
                        ['label' => 'Total Tahun Ini', 'val' => $stats['total_tahun_ini'] ?? 0],
                    ];
                @endphp
                @foreach($boxes as $box)
                <div class="col-md col-sm-6">
                    <div class="stats-card">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 0.65rem">{{ $box['label'] }}</small>
                        <h4 class="fw-bold mb-0 mt-1">{{ $box['val'] }}</h4>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- 2. PANEL FILTER --}}
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('pegawai.surat.index') }}" method="GET" class="row g-3">
                        <input type="hidden" name="type" value="{{ $type }}">
                        <div class="col-md-4"><input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}"></div>
                        <div class="col-md-2">
                            <select name="metode" class="form-select">
                                <option value="">Semua Metode</option>
                                <option value="Email" {{ request('metode') == 'Email' ? 'selected' : '' }}>Email</option>
                                <option value="Kurir" {{ request('metode') == 'Kurir' ? 'selected' : '' }}>Kurir</option>
                                <option value="Loket" {{ request('metode') == 'Loket' ? 'selected' : '' }}>Loket</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                            <a href="{{ route('pegawai.surat.index', ['type' => $type]) }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- 3. TABEL DATA --}}
            <div class="card shadow-sm border-0">
                <div class="card-header-custom">
                    <h5 class="mb-0 fw-bold">{{ $type == 'disposisi' ? 'PENCETAKAN LEMBAR DISPOSISI' : 'DAFTAR SURAT ' . strtoupper($type) }}</h5>
                    <a href="{{ route('pegawai.surat.create', ['type' => $type]) }}" class="btn btn-sm btn-light text-primary fw-bold"><i class="bi bi-plus-lg"></i> Tambah Baru</a>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Tanggal</th>
                                    <th>{{ $type == 'disposisi' ? 'No. Agenda' : 'Kode Surat' }}</th>
                                    <th>{{ $type == 'disposisi' ? 'Perihal' : 'Pengirim' }}</th>
                                    <th>Metode</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($surats as $surat)
                                <tr>
                                    <td class="ps-4 text-muted">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d/m/Y') }}</td>
                                    <td class="fw-bold">{{ $type == 'disposisi' ? $surat->nomor_agenda : $surat->kode_surat }}</td>
                                    <td>{{ $type == 'disposisi' ? $surat->perihal : $surat->asal_surat }}</td>
                                    <td><span class="badge bg-light text-dark border">{{ $surat->metode ?? '-' }}</span></td>
                                    <td class="text-center">
                                        @if($type == 'disposisi')
                                            <a href="{{ route('pegawai.surat.cetak.disposisi', $surat->id) }}" target="_blank" class="btn btn-sm btn-outline-danger"><i class="bi bi-printer"></i></a>
                                        @else
                                            <a href="{{ route('pegawai.surat.edit', $surat->id) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                            {{-- TOMBOL HAPUS DENGAN KONFIRMASI --}}
                                            <form action="{{ route('pegawai.surat.destroy', $surat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini? Data yang dihapus tidak dapat dikembalikan.');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="text-center py-4">Data tidak ditemukan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white">{{ $surats->appends(request()->query())->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
{{-- ===========================================================
    RIWAYAT SURAT
=========================================================== --}}

<section class="dashboard-section mt-5">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white d-flex justify-content-between align-items-center">

            <div>

                <h4 class="mb-1 fw-bold">
                    <i class="bi bi-clock-history text-primary me-2"></i>
                    Riwayat Surat
                </h4>

                <small class="text-muted">
                    Riwayat seluruh surat yang pernah Anda ajukan.
                </small>

            </div>

            <a href="{{ route('umum.surat.index') }}"
               class="btn btn-primary rounded-pill">

                <i class="bi bi-envelope-paper"></i>
                Semua Surat

            </a>

        </div>

        <div class="card-body p-0">

            @if(isset($surats) && $surats->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                        <tr>

                            <th width="70">No</th>

                            <th>Nomor Surat</th>

                            <th>Perihal</th>

                            <th>Jenis</th>

                            <th>Tanggal</th>

                            <th>Status</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($surats as $surat)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>

                                    <strong>

                                        {{ $surat->nomor_surat ?? '-' }}

                                    </strong>

                                </td>

                                <td>

                                    {{ $surat->perihal ?? '-' }}

                                </td>

                                <td>

                                    @if($surat->jenis_surat == 'masuk')

                                        <span class="badge bg-primary">

                                            Surat Masuk

                                        </span>

                                    @elseif($surat->jenis_surat == 'keluar')

                                        <span class="badge bg-success">

                                            Surat Keluar

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            {{ ucfirst($surat->jenis_surat ?? '-') }}

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($surat->tanggal_surat)

                                        {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d M Y') }}

                                    @else

                                        -

                                    @endif

                                </td>

                                <td>

                                    @php

                                        $badge = match($surat->status){

                                            'menunggu' => 'warning',

                                            'diproses' => 'info',

                                            'selesai' => 'success',

                                            'ditolak' => 'danger',

                                            default => 'secondary'

                                        };

                                    @endphp

                                    <span class="badge bg-{{ $badge }}">

                                        {{ ucfirst($surat->status ?? '-') }}

                                    </span>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <i class="bi bi-inbox display-1 text-secondary opacity-50"></i>

                    <h4 class="mt-4">

                        Belum Ada Riwayat Surat

                    </h4>

                    <p class="text-muted mb-4">

                        Anda belum pernah mengirim surat melalui sistem E-Office ATR/BPN.

                    </p>

                    <a href="{{ route('umum.surat.index') }}"
                       class="btn btn-primary rounded-pill px-4">

                        <i class="bi bi-plus-circle"></i>

                        Buat Surat

                    </a>

                </div>

            @endif

        </div>

    </div>

</section>



{{-- ===========================================================
    RINGKASAN
=========================================================== --}}

<section class="dashboard-section mt-4">

    <div class="row g-4">

        <div class="col-lg-3 col-md-6">

            <div class="card shadow-sm border-0 text-center h-100">

                <div class="card-body">

                    <i class="bi bi-envelope-paper-fill display-5 text-primary"></i>

                    <h3 class="fw-bold mt-3">

                        {{ $totalSurat ?? 0 }}

                    </h3>

                    <p class="text-muted mb-0">

                        Total Surat

                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card shadow-sm border-0 text-center h-100">

                <div class="card-body">

                    <i class="bi bi-hourglass-split display-5 text-warning"></i>

                    <h3 class="fw-bold mt-3">

                        {{ $diproses ?? 0 }}

                    </h3>

                    <p class="text-muted mb-0">

                        Diproses

                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card shadow-sm border-0 text-center h-100">

                <div class="card-body">

                    <i class="bi bi-check-circle-fill display-5 text-success"></i>

                    <h3 class="fw-bold mt-3">

                        {{ $selesai ?? 0 }}

                    </h3>

                    <p class="text-muted mb-0">

                        Selesai

                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card shadow-sm border-0 text-center h-100">

                <div class="card-body">

                    <i class="bi bi-x-circle-fill display-5 text-danger"></i>

                    <h3 class="fw-bold mt-3">

                        {{ $ditolak ?? 0 }}

                    </h3>

                    <p class="text-muted mb-0">

                        Ditolak

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
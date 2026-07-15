<x-app-layout>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body{
            background:#f4f6f9;
        }

        .page-title{
            font-size:24px;
            font-weight:700;
            color:#0d6efd;
        }

        .card-custom{
            border:none;
            border-radius:12px;
            overflow:hidden;
            box-shadow:0 5px 15px rgba(0,0,0,.08);
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

        .table td{
            vertical-align:top;
            padding:12px;
        }

        .label{
            width:220px;
            font-weight:600;
            color:#495057;
            background:#f8f9fa;
        }

        .btn{
            border-radius:8px;
            padding:10px 20px;
            font-weight:600;
        }

        iframe{
            border-radius:10px;
            border:1px solid #dee2e6;
        }
    </style>

<div class="container-fluid py-4">

    <div class="mb-4">

        <h2 class="page-title">

            <i class="bi bi-eye-fill"></i>

            Detail Surat {{ ucfirst($surat->jenis_surat) }}

        </h2>

    </div>

    <div class="card card-custom">

        <div class="card-header-custom">

            <h5>

                <i class="bi bi-file-earmark-text-fill"></i>

                INFORMASI SURAT

            </h5>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <td class="label">Nomor Surat</td>
                    <td>{{ $surat->nomor_surat }}</td>
                </tr>

                <tr>
                    <td class="label">Tanggal Surat</td>
                    <td>
                        {{ $surat->tanggal_surat
                            ? \Carbon\Carbon::parse($surat->tanggal_surat)->format('d-m-Y')
                            : '-' }}
                    </td>
                </tr>

                <tr>
                    <td class="label">Jenis Surat</td>
                    <td>
                        <span class="badge bg-primary">
                            {{ strtoupper($surat->jenis_surat) }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <td class="label">Asal Surat</td>
                    <td>{{ $surat->asal_surat ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="label">Tujuan Surat</td>
                    <td>{{ $surat->tujuan_surat ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="label">Judul Surat</td>
                    <td>{{ $surat->judul_surat ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="label">Kode Surat</td>
                    <td>{{ $surat->kode_surat ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="label">Nomor Agenda</td>
                    <td>{{ $surat->nomor_agenda ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="label">Metode Pengiriman</td>
                    <td>{{ $surat->metode ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="label">Status</td>
                    <td>

                        @if($surat->status=='menunggu')
                            <span class="badge bg-warning text-dark">
                                Menunggu
                            </span>

                        @elseif($surat->status=='diproses')

                            <span class="badge bg-info">
                                Diproses
                            </span>

                        @elseif($surat->status=='selesai')

                            <span class="badge bg-success">
                                Selesai
                            </span>

                        @else

                            <span class="badge bg-secondary">

                                {{ ucfirst($surat->status) }}

                            </span>

                        @endif

                    </td>

                </tr>

                <tr>

                    <td class="label">

                        Deskripsi

                    </td>

                    <td>

                        {!! nl2br(e($surat->deskripsi)) !!}

                    </td>

                </tr>

            </table>

        </div>

    </div>

    @if($surat->file_path)

    <div class="card card-custom mt-4">

        <div class="card-header-custom">

            <h5>

                <i class="bi bi-file-earmark-pdf-fill"></i>

                DOKUMEN SURAT

            </h5>

        </div>

        <div class="card-body">

            <iframe
                src="{{ asset('storage/'.$surat->file_path) }}"
                width="100%"
                height="700">
            </iframe>

            <div class="mt-3">

                <a href="{{ asset('storage/'.$surat->file_path) }}"
                   target="_blank"
                   class="btn btn-success">

                    <i class="bi bi-download"></i>

                    Download Dokumen

                </a>

            </div>

        </div>

    </div>

    @endif

    <div class="mt-4 d-flex justify-content-end gap-2">

        <a href="{{ route('pegawai.surat.index') }}"
           class="btn btn-secondary">

            <i class="bi bi-arrow-left-circle"></i>

            Kembali

        </a>

        

    </div>

</div>

</x-app-layout>
@extends('layouts.umum')

@section('title','Detail Surat')

@section('content')

<div class="container py-4">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">

                Detail Surat

            </h4>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th width="220">Nomor Surat</th>

                    <td>{{ $surat->nomor_surat }}</td>

                </tr>

                <tr>

                    <th>Jenis Surat</th>

                    <td>{{ ucfirst($surat->jenis_surat) }}</td>

                </tr>

                <tr>

                    <th>Tanggal Surat</th>

                    <td>

                        {{ $surat->tanggal_surat?->format('d-m-Y') }}

                    </td>

                </tr>

                <tr>

                    <th>Perihal</th>

                    <td>{{ $surat->perihal }}</td>

                </tr>

                <tr>

                    <th>Deskripsi</th>

                    <td>{{ $surat->deskripsi }}</td>

                </tr>

                <tr>

                    <th>Status</th>

                    <td>

                        @if($surat->status=='menunggu')

                            <span class="badge bg-warning">

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

                        @elseif($surat->status=='ditolak')

                            <span class="badge bg-danger">

                                Ditolak

                            </span>

                        @endif

                    </td>

                </tr>

                @if($surat->file_path)

                <tr>

                    <th>File Surat</th>

                    <td>

                        <a href="{{ asset('storage/'.$surat->file_path) }}"
                           target="_blank"
                           class="btn btn-success btn-sm">

                            Download File

                        </a>

                    </td>

                </tr>

                @endif

            </table>

        </div>

    </div>

    <div class="card shadow-sm mt-4">

        <div class="card-header">

            <h5 class="mb-0">

                Tracking Aktivitas Surat

            </h5>

        </div>

        <div class="card-body">

            @forelse($surat->logs as $log)

                <div class="border-start border-4 border-primary ps-3 mb-4">

                    <h6 class="fw-bold">

                        {{ $log->action }}

                    </h6>

                    <p class="mb-1">

                        {{ $log->description }}

                    </p>

                    <small class="text-muted">

                        {{ $log->created_at->format('d M Y H:i') }}

                    </small>

                </div>

            @empty

                <div class="alert alert-secondary mb-0">

                    Belum ada aktivitas pada surat ini.

                </div>

            @endforelse

        </div>

    </div>

    <div class="mt-3">

        <a href="{{ route('umum.surat.index') }}"
           class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>

@endsection
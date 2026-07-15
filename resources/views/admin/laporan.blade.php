@extends('layouts.admin')

@section('title', 'Laporan Surat')

@section('content')

<div class="container-fluid">

    <div class="card shadow">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                <i class="fas fa-file-alt"></i>
                Laporan Surat
            </h4>

            <a href="#" class="btn btn-light">
                <i class="fas fa-print"></i>
                Cetak PDF
            </a>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead class="table-light">

                        <tr>
                            <th>No Surat</th>
                            <th>Perihal</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Pengirim</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td>SRT/2026/001</td>
                            <td>Permohonan Sertifikat Tanah</td>
                            <td>26/06/2026</td>
                            <td>28/06/2026</td>
                            <td>Budi Santoso</td>
                            <td>
                                <span class="badge bg-success">
                                    Selesai
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>SRT/2026/002</td>
                            <td>Pengajuan Balik Nama</td>
                            <td>25/06/2026</td>
                            <td>27/06/2026</td>
                            <td>Siti Aminah</td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    Proses
                                </span>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
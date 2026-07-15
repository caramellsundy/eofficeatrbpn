@extends('layouts.umum')

@section('title','Surat Saya')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between mb-4">

        <h3>Surat Saya</h3>

        <a href="{{ route('umum.surat.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Buat Surat

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="card shadow-sm">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead>

                <tr>

                    <th>No</th>
                    <th>Nomor</th>
                    <th>Perihal</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

                </thead>

                <tbody>

                @forelse($surats as $surat)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $surat->nomor_surat }}</td>

                        <td>{{ $surat->perihal }}</td>

                        <td>

                            <span class="badge bg-info">

                                {{ ucfirst($surat->status) }}

                            </span>

                        </td>

                        <td>

                            <a href="{{ route('umum.surat.show',$surat->id) }}"
                               class="btn btn-sm btn-primary">

                                Detail

                            </a>

                            @if($surat->status=='menunggu')

                            <a href="{{ route('umum.surat.edit',$surat->id) }}"
                               class="btn btn-sm btn-warning">

                                Edit

                            </a>

                            <form
                                action="{{ route('umum.surat.destroy',$surat->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Hapus surat?')"
                                    class="btn btn-sm btn-danger">

                                    Hapus

                                </button>

                            </form>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">

                            Belum ada surat.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
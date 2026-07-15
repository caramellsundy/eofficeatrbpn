@extends('layouts.umum')

@section('title','Buat Surat')

@section('content')

<div class="container py-4">

<div class="card">

<div class="card-header">

Buat Surat

</div>

<div class="card-body">

<form
action="{{ route('umum.surat.store') }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="mb-3">

<label>Jenis Surat</label>

<select
name="jenis_surat"
class="form-control">

<option value="masuk">Masuk</option>
<option value="keluar">Keluar</option>

</select>

</div>

<div class="mb-3">

<label>Nomor Surat</label>

<input
type="text"
name="nomor_surat"
class="form-control">

</div>

<div class="mb-3">

<label>Tanggal</label>

<input
type="date"
name="tanggal_surat"
class="form-control">

</div>

<div class="mb-3">

<label>Perihal</label>

<input
type="text"
name="perihal"
class="form-control">

</div>

<div class="mb-3">

<label>Deskripsi</label>

<textarea
name="deskripsi"
class="form-control"></textarea>

</div>

<div class="mb-3">

<label>Upload File</label>

<input
type="file"
name="file_path"
class="form-control">

</div>

<button class="btn btn-primary">

Simpan

</button>

</form>

</div>

</div>

</div>

@endsection
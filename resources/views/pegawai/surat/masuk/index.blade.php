@extends('layouts.pegawai')

@section('title','Surat Saya')

@section('content')

<div class="page-header fade-up">

    <div>
        <h2>
            <i class="bi bi-envelope-paper-fill text-primary me-2"></i>
            Surat Saya
        </h2>

        <p class="text-muted mb-0">
            Kelola surat yang telah Anda buat dan kirim.
        </p>
    </div>


    <a href="{{ route('pegawai.surat-masuk.create') }}"
       class="btn btn-primary">

        <i class="bi bi-send-plus-fill me-2"></i>
        Kirim Surat

    </a>

</div>



{{-- ================= STATISTIK ================= --}}

<div class="dashboard-grid mb-4">


<div class="stat-card">

<div>
<span>Total Surat</span>
<h3>{{ $surat->total() }}</h3>
</div>

<div class="stat-icon primary">
<i class="bi bi-envelope-fill"></i>
</div>

</div>



<div class="stat-card">

<div>
<span>Menunggu</span>
<h3>
{{ $surat->where('status','Menunggu')->count() }}
</h3>
</div>

<div class="stat-icon warning">
<i class="bi bi-hourglass-split"></i>
</div>

</div>



<div class="stat-card">

<div>
<span>Diproses</span>
<h3>
{{ $surat->where('status','Diproses')->count() }}
</h3>
</div>

<div class="stat-icon info">
<i class="bi bi-arrow-repeat"></i>
</div>

</div>



<div class="stat-card">

<div>
<span>Selesai</span>
<h3>
{{ $surat->where('status','Selesai')->count() }}
</h3>
</div>

<div class="stat-icon success">
<i class="bi bi-check-circle-fill"></i>
</div>

</div>


</div>




{{-- ================= TABLE ================= --}}


<div class="table-card fade-up">


<div class="table-header">

<h4>
<i class="bi bi-list-ul text-primary me-2"></i>
Daftar Surat Saya
</h4>


<span class="badge bg-primary">
{{ $surat->total() }} Surat
</span>


</div>




<div class="table-toolbar">


<form action="{{ route('pegawai.surat.index') }}"
      method="GET"
      class="table-search">


<i class="bi bi-search"></i>


<input type="text"
       name="keyword"
       value="{{ request('keyword') }}"
       placeholder="Cari nomor surat atau perihal...">


</form>


</div>





<div class="table-responsive">


<table class="table align-middle">


<thead>

<tr>

<th width="60">
No
</th>


<th>
Surat
</th>


<th>
Tanggal
</th>


<th>
Status
</th>


<th width="160">
Aksi
</th>


</tr>


</thead>



<tbody>



@forelse($surat as $item)


<tr>


<td>
{{ $surat->firstItem()+$loop->index }}
</td>



<td>


<div class="table-avatar">


<div class="avatar">

<i class="bi bi-envelope-fill"></i>

</div>



<div>


<strong>
{{ $item->nomor_surat }}
</strong>


<br>


<small>
{{ $item->perihal }}
</small>


</div>


</div>


</td>





<td>

@if($item->tanggal_surat)

{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d M Y') }}

@else

-

@endif


</td>




<td>


@switch($item->status)


@case('Menunggu')

<span class="badge bg-warning text-dark">
<i class="bi bi-hourglass me-1"></i>
Menunggu
</span>

@break



@case('Diproses')


<span class="badge bg-info">
<i class="bi bi-arrow-repeat me-1"></i>
Diproses
</span>


@break



@case('Selesai')


<span class="badge bg-success">

<i class="bi bi-check-circle me-1"></i>
Selesai

</span>


@break



@default

<span class="badge bg-secondary">

{{ $item->status }}

</span>


@endswitch


</td>




<td>


<div class="table-action">


<a href="{{ route('pegawai.surat.show',$item->id) }}"
class="btn-view">

<i class="bi bi-eye"></i>

</a>




</div>


</td>



</tr>


@empty


<tr>

<td colspan="5">


<div class="table-empty">


<i class="bi bi-inbox"></i>


<h5>
Belum Ada Surat
</h5>


<p>
Anda belum membuat surat.
</p>


</div>


</td>


</tr>


@endforelse



</tbody>


</table>


</div>





<div class="table-footer">


<div>

Menampilkan

<strong>
{{ $surat->firstItem() ?? 0 }}
</strong>

-

<strong>
{{ $surat->lastItem() ?? 0 }}
</strong>

dari

<strong>
{{ $surat->total() }}
</strong>

surat


</div>


<div>

{{ $surat->withQueryString()->links() }}

</div>


</div>



</div>


@endsection





@push('styles')


<style>


.page-header{

display:flex;
justify-content:space-between;
align-items:center;
margin-top:25px;
margin-bottom:30px;

}



.dashboard-grid{

display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;

}



.stat-card{

background:white;
border-radius:20px;
padding:25px;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 10px 25px rgba(0,0,0,.05);

}



.stat-card span{

color:#64748b;

}


.stat-card h3{

font-size:32px;
font-weight:700;
margin:5px 0;

}



.stat-icon{

width:65px;
height:65px;
border-radius:18px;
display:flex;
align-items:center;
justify-content:center;
font-size:25px;

}



.primary{

background:#dbeafe;
color:#2563eb;

}


.warning{

background:#fef3c7;
color:#d97706;

}


.info{

background:#cffafe;
color:#0891b2;

}


.success{

background:#dcfce7;
color:#16a34a;

}



.table-avatar{

display:flex;
align-items:center;
gap:15px;

}



.avatar{

width:45px;
height:45px;
border-radius:12px;
background:#2563eb;
color:white;
display:flex;
align-items:center;
justify-content:center;

}



.table-action{

display:flex;
gap:8px;

}



.table-action a,
.table-action button{

width:36px;
height:36px;
border-radius:10px;
border:0;
display:flex;
align-items:center;
justify-content:center;

}



.btn-view{

background:#e0f2fe;
color:#0284c7;

}



.btn-edit{

background:#fef3c7;
color:#d97706;

}



.btn-delete{

background:#fee2e2;
color:#dc2626;

}



.table-empty{

padding:60px;
text-align:center;

}



.table-empty i{

font-size:60px;
color:#cbd5e1;

}



.table-footer{

display:flex;
justify-content:space-between;
padding:20px;
background:#fafafa;

}



@media(max-width:900px){

.dashboard-grid{

grid-template-columns:1fr 1fr;

}

}


@media(max-width:600px){

.dashboard-grid{

grid-template-columns:1fr;

}


.page-header{

flex-direction:column;
align-items:flex-start;
gap:15px;

}


}


</style>


@endpush
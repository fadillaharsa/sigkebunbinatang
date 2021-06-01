@extends('layouts.app')

@section('title')
    <title>Terima Kasih - SIG Kebun Binatang Bandung</title>
@endsection

@section('content')
<div >
    <div class="text-center">
    <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid mb-3 mt-5" style="width: 200px">
    <h1><b>TERIMA KASIH<br>TELAH MEMBERI ULASAN FASILITAS/KANDANG</b></h1>
    <p>Semoga ulasan Anda bisa berguna untuk perbaikan dan pengembangan Kebun Binatang Bandung di masa mendatang.</p>
    <a href="{{route('lihatfasilitas',$facility_id)}}" class="mb-3 btn btn-success text-white btn-block d-flex justify-content-between align-items-center">
        <span></span>
        <span class="ml-2">Kembali</span>
        <i class="fas fa-chevron-right"></i>
    </a>
    </div>
   
</div>

@endsection

@push('script')

@endpush
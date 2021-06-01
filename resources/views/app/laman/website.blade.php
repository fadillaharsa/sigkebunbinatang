@extends('layouts.app')

@section('title')
    <title>Tentang - SIG Kebun Binatang Bandung</title>
@endsection

@section('content')
<div >
    <div class="d-flex justify-content-between align-items-center mb-3 text-center">
        <a href="{{ url()->previous() }}" class="btn btn-success text-white rounded-circle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <H1 class="mr-2"><b>WEBSITE UTAMA KEBUN BINATANG BANDUNG</b></H1>
        <span></span>
    </div>
    <img src="{{ asset('assets/images/kebunbinatang2.png') }}" class="img-fluid mb-3" style="width: 100%">
    <p>Kunjungi website utama Kebun Binatang Bandung untuk mendapatkan informasi terupdate seputar informasi tiket dan kontak person.</p>
    <a href="https://www.bandung-zoo.com/" target="_blank" class="mb-3 btn btn-success text-white btn-block d-flex justify-content-between align-items-center">
        <span></span>
        <span class="ml-2">Website Utama</span>
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
@endsection
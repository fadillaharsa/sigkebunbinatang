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
        <H1 class="mr-2"><b>TIKET MASUK</b></H1>
        <span></span>
    </div>
    <img src="{{ asset('assets/images/ticket.jpg') }}" class="img-fluid mb-3" style="width: 100%">
    <p>Harga tiket masuk Rp. 50.000 Dewasa dan anak2x sama. Berlaku setiap hari. Anak dengan tinggi badan 80cm sudah dikenakan biaya normal.</p>
    <p>Harga tiket rombongan umum (travel, lansia, keluarga, dll) Rp. 45.000 min & Harga tiket rombongan sekolah Rp. 40.000 min. 30 orng free 1 orng berlaku kelipatan. Tiket rombongan tidak berlaku di hari Minggu dan libur nasional.</p>
    <p><b>Cara Pembelian Tiket:</b></p>
    <ol><li>Kunjungi Loket Tiket di Gerbang Utama.</li>
    <li>Antri pada lokasi antrian.</li>
    <li>Beli tiket dengan menggunakan uang tunai, debit, ataupun QRIS.</li></ol>
    <p>Kunjungi instagram Kebun Binatang Bandung untuk mendapatkan informasi terupdate seputar informasi tiket dan kontak person.</p>
    <a href="https://www.instagram.com/bandung_zoological/" target="_blank" class="mb-3 btn btn-success text-white btn-block d-flex justify-content-between align-items-center">
        <span></span>
        <span class="ml-2">Instagram</span>
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
@endsection
@extends('layouts.app')

@section('title')
    <title>Tentang - SIG Kebun Binatang Bandung</title>
@endsection

@section('content')
<div>
    <div class="d-flex justify-content-between align-items-center mb-3 text-center">
        <a href="{{ url()->previous() }}" class="btn btn-success text-white rounded-circle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <H1 class="mr-2"><b>JASA TOUR GUIDE</b></H1>
        <span></span>
    </div>
    <p>Kami menyediakan Zoo Educator (Pemandu) sesuai permintaan dan terbatas. Silakan hubugi kami.</p>
    <ul class="pl-3">
        <li><b>Instagram:</b> BANDUNG_ZOOLOGICAL</li>
        <li><b>Facebook:</b> OFFICIALBANDUNGZOO</li>
        <li><b>Twitter:</b> BANDUNG_ZOO</li>
        <li><b>Alamat:</b> Jalan Kebun Binatang No.6, Lebak Siliwangi, Coblong, Kota Bandung, Jawa Barat</li>
    </ul>
    <p>Informasi kontak telepon dan WA admin dapat dilihat di deskripsi pada media sosial Instagram.</p>
    <a href="https://www.instagram.com/bandung_zoological/" target="_blank" class="mb-3 btn btn-success text-white btn-block d-flex justify-content-between align-items-center">
        <span></span>
        <span class="ml-2">Kontak Kami</span>
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
@endsection
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
        <H1 class="mr-2"><b>TENTANG KEBUN BINATANG BANDUNG</b></H1>
        <span></span>
    </div>
    <img src="{{ asset('assets/images/kebunbinatang1.jpg') }}" class="img-fluid mb-3" style="width: 100%">
    <p>Selamat datang di kawasan rekreasi terbaik di Jawa Barat. Sebuah kawasan dengan luas hampir 14 hektar. Inilah Kebun Binatang Bandung yang terdapat di jantung Kota Bandung, dengan koleksi satwa yang menarik dan lingkungan hijau nan asri.</p>
    <p>Dengan koleksi satwa lebih dari 800 individu dari kelas mamalia, aves, reptil & ikan. Kebun Binatang Bandung sudah sejak lama menjadi tujuan wisata favorit warga Bandung & Jawa Barat. Selain berfungsi untuk tempat rekreasi, lengkapnya koleksi satwa Kebun Binatang Bandung, juga menjadi lokasi pendidikan dan penelitian.</p>
    <p>Pengunjung yang ingin berinterkasi dengan koleksi satwa di Kebun Binatang Bandung, disediakan kesempatan berfoto bersama satwa pada area tertentu. Selain itu, pengunjung juga dapat merasakan sensasi menunggangi satwa di Kebun Binatang Bandung, Wahana Unta Tunggang, Gajah Tunggang & Kuda Tunggang siap melayani pengunjung.</p>
    <p>Interaksi satwa dengan zookeeper di Kebun Binatang Bandung tidak sebatas pada pemberian pakan dan perawatan kesehatannya, namun juga pada pertunjukkan satwa. Burung kakatua koki, burung macaw biru kuning, burung rangkong badak, binturong, anjing pudel dan marmut menjadi bintang pada pertujukkan satwa.</p>
</div>
@endsection
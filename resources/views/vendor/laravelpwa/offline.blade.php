@extends('layouts.app')

@section('content')

<div class="text-center pt-4">
    <span style="font-size: 120px">!</span><br>
    <h1><b>KONEKSI TERPUTUS</b></h1>
    <h2>Anda tidak terhubung ke internet. Pastikan perangkat Anda telah terkoneksi internet dengan baik.</h2>
    <button class="mt-3 btn btn-success text-white" onClick="window.location.reload();">Refresh Halaman</button>
</div>

@endsection
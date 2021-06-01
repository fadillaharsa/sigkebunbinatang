@extends('layouts.app')

@section('title')
    <title>Tentang - SIG Kebun Binatang Bandung</title>
@endsection

@section('content')
<div style="margin-bottom:80px">
    <div class="d-flex justify-content-between align-items-center text-center">
        <a href="{{ url()->previous() }}" class="btn btn-success text-white rounded-circle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <H1 class="mr-2"><b>{{$destinasi->order}} DARI {{$jumlah}} FASILITAS TELAH DIKUNJUNGI</b></H1>
        <span></span>
    </div>
    <p class="text-center">Sekarang Anda harus berada di:<br><b>{{$destinasi->facility->title}}</b></p>
    <img src="{{asset('storage/'.$destinasi->facility->photo)}}" class="img-fluid mb-3" style="width: 100%">
    <p>{{$destinasi->facility->description}}</p>
    <H1 class="mb-3"><b>PETA</b></H1>
    <div style="height:500px" id="mapContainer"></div>  
    {{-- <div class="card mb-3">
        <div class="card-body">
            <h3>{{ $space->title }}</h3>
            <span>{{ $space->address }}</span>
            <p>{{ $space->description }}</p>
            <div id="summary"></div>
        </div>
    </div>  --}}
    <div style="margin-bottom:90px" class="px-3 fixed-bottom">
        <a @if($destinasi->order<$jumlah) onclick="openDirection({{$routelist->facility->latitude}}, {{$routelist->facility->longitude}}, {{ $routelist->route_id }}, {{$routelist->order}})" @else href={{route('ruteselesai')}} @endif class="btn btn-success text-white btn-block d-flex justify-content-between align-items-center">
            <span></span>
            <span class="ml-2">@if($destinasi->order<$jumlah) Lanjutkan Perjalanan @else Perjalanan Selesai @endif</span>
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
</div>
@endsection


@push('script')
    <script>
        window.action = "direction"
        window.facilityIcon = "{{$fasilitas->icon}}"
    </script>
    <script>
        window.hereApiKey = "{{env('HERE_API_KEY')}}"
    </script>
    <script src="{{ asset('js/here.js') }}"></script>
@endpush
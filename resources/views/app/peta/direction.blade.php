@extends('layouts.app')

@section('title')
    <title>Tentang - SIG Kebun Binatang Bandung</title>
@endsection

@section('content')
<div class="text-center">
    <div class="d-flex justify-content-between align-items-center text-center">
        <a href="{{ url()->previous() }}" class="btn btn-success text-white rounded-circle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <H1 class="mr-2"><b>PETUNJUK JALAN</b></H1>
        <span></span>
    </div>
    <p>Menuju {{$fasilitas->title}}</p>
    <div style="height:340px" class="mb-3" id="mapContainer"></div>  
    <a href="{{route('lihatfasilitas',$fasilitas->id)}}" class="mb-3 btn btn-success text-white btn-block d-flex justify-content-between align-items-center">
        <span></span>
        <span class="ml-2">Lihat Informasi Fasilitas</span>
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
@endsection

@push('script')
    <script>
        window.action = "direction"
        window.facilityIcon = "{{$fasilitas->icon}}"
        window.hereApiKey = "{{env('HERE_API_KEY')}}"
    </script>
    <script src="{{ asset('js/here.js') }}"></script>
@endpush
@extends('layouts.app')

@section('title')
    <title>Rute - SIG Kebun Binatang Bandung</title>
@endsection

@section('content')
<div class="text-center">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-success text-white rounded-circle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <H1 class="mr-5"><b>RUTE PERJALANAN</b></H1>
        <span></span>
    </div>
    <p>Fitur ini dapat membantu Anda melakukan tour perjalanan mengelilingi Kebun Binatang Bandung.</p>
</div>

@foreach($rute as $rute)
<a href="#" @if($routelist->count()==$rute->count()) onclick="openDirection({{$routelist[$loop->index]->facility->latitude}}, {{$routelist[$loop->index]->facility->longitude}}, {{ $rute->id }},1)" @endif class="card mb-2" style="color:black">
    <div class="card-body row">
        <div class="col-10">
            <h2><b>{{$rute->name}}</b></h2>
            <p class="mb-1">{{$rute->description}}
            </p>
            <p class="mb-0 text-info">Estimasi waktu: {{$rute->duration}}
            </p>
        </div>
        <div class="col-2 d-flex justify-content-between align-items-center">
            <i class="fas fa-chevron-right"></i>
        </div>
    </div>
</a>
@endforeach
<a href="https://www.instagram.com/bandung_zoological/" target="_blank" class="card mb-2" style="color:black">
    <div class="card-body row">
        <div class="col-10">
            <h2><b>Jasa Tour Guide</b></h2>
            <p class="mb-1">Kami menyediakan Zoo Educator (Pemandu) sesuai permintaan dan terbatas.
            </p>
            <p class="mb-0 text-info">Silakan hubungi kami
            </p>
        </div>
        <div class="col-2 d-flex justify-content-between align-items-center">
            <i class="fas fa-chevron-right"></i>
        </div>
    </div>
</a>

@endsection

@push('script')
<script>
    window.hereApiKey = "{{env('HERE_API_KEY')}}"
</script>
<script src="{{ asset('js/here.js') }}"></script>
@endpush
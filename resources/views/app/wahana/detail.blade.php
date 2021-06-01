@extends('layouts.app')

@section('title')
    <title>{{$wahana->facility->title}} - SIG Kebun Binatang Bandung</title>
@endsection

@section('content')
<div >
    <div class="d-flex justify-content-between align-items-center text-center">
        <a href="{{ url()->previous() }}" class="btn btn-success text-white rounded-circle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <H1 class="mr-3"><b>{{$wahana->facility->title}}</b></H1>
        <span></span>
    </div>
    <p class=" text-center @if($wahana->category=='Tunggangan') text-primary @endif @if($wahana->category=='Foto Bersama Satwa') text-info @endif @if($wahana->category=='Feeding') text-danger @endif">{{$wahana->category}}</p>
    <img src="{{asset('storage/'.$wahana->facility->photo)}}" class="img-fluid mb-3" style="width: 100%">    
    <a href="#" onclick="openDirectionPage({{$wahana->facility->latitude}}, {{$wahana->facility->longitude}}, {{ $wahana->facility->id }})" class="mb-3 btn btn-success text-white btn-block d-flex justify-content-between align-items-center">
        <span></span>
        <span class="ml-2">Petunjuk Jalan</span>
        <i class="fas fa-route"></i>
    </a>
    <p>{!!$wahana->description!!}</p>
    <p><b>Harga: @if($wahana->price=='0') Seikhlasnya @else Rp{{$wahana->price}} @endif</b></p>
   
</div>
@endsection

@push('script')
<script>
    window.hereApiKey = "{{env('HERE_API_KEY')}}"
</script>
<script src="{{ asset('js/here.js') }}"></script>
@endpush
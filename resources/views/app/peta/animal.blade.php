@extends('layouts.app')

@section('title')
    <title>{{$satwa->name}} - SIG Kebun Binatang Bandung</title>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center text-center">
        <a href="{{ url()->previous() }}" class="btn btn-success text-white rounded-circle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <H1 class="mr-3"><b>{{$satwa->name}}</b></H1>
        <span></span>
    </div>
    <p class="text-center">{{$satwa->latin}}</p>
    <div id="carouselAnimal" class="carousel slide mb-3" data-ride="carousel">
        <div class="carousel-inner">
        @foreach($satwa->photos as $key=>$foto)
            <div class="carousel-item {{$key==0 ? 'active' : ''}}">
                <img class="d-block w-100" src="{{asset('storage/'.$foto->path)}}" alt="First slide">
            </div>
        @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselAnimal" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselAnimal" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <a href="" class="mb-3 btn btn-success text-white btn-block d-flex justify-content-between align-items-center">
        <span></span>
        <span class="ml-2">Petunjuk Jalan</span>
        <i class="fas fa-route"></i>
    </a>
    <p>{{$satwa->description}}</p>

@endsection

@push('script')

@endpush
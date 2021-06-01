@extends('layouts.app')

@section('title')
    <title>{{$fasilitas->title}} - SIG Kebun Binatang Bandung</title>
@endsection

@push('scriptTop')
<style>
    .card {
        flex-direction: row;
        align-items: center;
    }
    .card-title {
        font-weight: bold;
    }
    .card img {
        width: 30%;
        border-top-right-radius: 0;
        border-bottom-left-radius: calc(0.25rem - 1px);
        object-fit: cover;
        height:150px
    }

    @media only screen and (max-width: 768px) {
        a {
            display: none;
        }
        .card-body {
            padding: 0.5em 1.2em;
        }
        .card-body .card-text {
            margin: 0;
        }
        .card img {
            width: 20%;
            object-fit: cover;
        }
    }
    @media only screen and (max-width: 1200px) {
        .card img {
            width: 30%;
            object-fit: cover;
            height:100px
        }
    }
</style>
@endpush

@section('content')
<div >
    <div class="d-flex justify-content-between align-items-center mb-3 text-center">
        <a href="{{ url()->previous() }}" class="btn btn-success text-white rounded-circle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <H1 class="mr-3"><b>{{strtoupper($fasilitas->title)}}</b></H1>
        <span></span>
    </div>
    <img src="{{asset('storage/'.$fasilitas->photo)}}" class="img-fluid mb-3" style="width: 100%">
    <a href="#" onclick="openDirectionPage({{$fasilitas->latitude}}, {{$fasilitas->longitude}}, {{ $fasilitas->id }})" class="mb-3 btn btn-success text-white btn-block d-flex justify-content-between align-items-center">
        <span></span>
        <span class="ml-2">Petunjuk Jalan</span>
        <i class="fas fa-route"></i>
    </a>
    <p>{{$fasilitas->description}}</p>
    <H1 class="mt-4"><b>SATWA</b></H1>
    @if($fasilitas->animal=='[]')
    <p>Tidak ada satwa di fasilitas ini.</p>
        @else
        @foreach($fasilitas->animal as $satwa)
        <a href="{{route('lihatsatwa',$satwa->id)}}" class="card mb-2" style="color:black">
            <img src="{{asset('storage/'.$satwa->photos[0]->path)}}" class="card-img-top" />
            <div class="card-body row">
                <div class="col-10">
                    <h2 class="mt-1"><b>{{$satwa->name}}</b></h2>
                    <p class="mb-0">{{$satwa->latin}}</p>
                </div>
                <div class="col-2 d-flex justify-content-between align-items-center">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </a>
    @endforeach
            
    @endif
    <H1 class="mt-4"><b>ULASAN</b></H1>
    @if($ulasan=='[]')
        <p>Belum ada ulasan untuk fasilitas ini.</p>
    @else
        @for ($i = 0; $i < 4; $i++)
            <i class="fas fa-star text-warning" style="font-size: 30px"></i>
        @endfor 
        <ul class="mt-2 pl-3">
        @foreach($ulasan as $ulasan)
            <li><i>"{{$ulasan->review}}"</i></li>
        @endforeach
        </ul>
    @endif
    <a href="{{route('ulasan',$fasilitas->id)}}" class="mb-3 btn btn-success text-white btn-block d-flex justify-content-between align-items-center">
        <span></span>
        <span class="ml-2">Beri Ulasan</span>
        <i class="fas fa-chevron-right"></i>
    </a>
</div>

@endsection

@push('script')
<script>
    window.hereApiKey = "{{env('HERE_API_KEY')}}"
</script>
<script src="{{ asset('js/here.js') }}"></script>
@endpush
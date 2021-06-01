@extends('layouts.app')

@section('title')
    <title>Berita - SIG Kebun Binatang Bandung</title>
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
            object-fit: cover
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
        <H1 class="mr-3"><b>BERITA</b></H1>
        <span></span>
    </div>
    @foreach($berita as $beritakbb)
    <a href="{{route('lihatberita',$beritakbb->id)}}" class="card mb-2" style="color:black">
        <img src="{{asset('storage/'.$beritakbb->image)}}" />
        <div class="card-body">
        <h3 class="card-title">{{$beritakbb->title}}</h3>
        </div>
    </a>
    @endforeach
    <div class="row justify-content-center">
        {{ $berita->links() }}
    </div>
   
</div>

@endsection

@push('script')

@endpush
@extends('layouts.app')

@section('title')
    <title>Wahana - SIG Kebun Binatang Bandung</title>
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
<div class="text-center">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-success text-white rounded-circle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <H1 class="mr-3"><b>WAHANA: FEEDING, TUNGGANGAN, & FOTO SATWA</b></H1>
        <span></span>
    </div>
    <a href="" class="mb-3 btn btn-success text-white btn-block d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#filterModal">
        <span></span>
        <span class="ml-2">Filter</span>
        <i class="fas fa-tasks"></i>
    </a>
    @if(isset($filter))
    <p class="text-info">
    Filter Aktif:
        @foreach($filter as $filter)
            {{$filter}}@if($loop->remaining>0),@endif
        @endforeach
    </p>
    @endif
</div>
@foreach($wahana as $wahana)
<a href="{{route('lihatwahana',$wahana->id)}}" class="card mb-2" style="color:black">
    <img src="{{asset('storage/'.$wahana->facility->photo)}}" class="card-img-top" />
    <div class="card-body">
        <span class="@if($wahana->category=='Tunggangan') text-primary @endif @if($wahana->category=='Foto Bersama Satwa') text-info @endif @if($wahana->category=='Feeding') text-danger @endif">{{$wahana->category}}</span>
        <h2 class="mt-1"><b>{{$wahana->facility->title}}</b></h2>
        <span>@if($wahana->price=='0') Seikhlasnya @else Rp{{$wahana->price}} @endif</span>
    </div>
</a>
@endforeach

<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLabel"><b>Filter Fasilitas</b></h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <form action="{{route('filterwahana')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h2><b>Ceklist</b></h2>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="category[]" value="Feeding" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                        Tempat Feeding
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="category[]" value="Tunggangan" id="defaultCheck2">
                        <label class="form-check-label" for="defaultCheck2">
                        Tempat Tunggangan
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="category[]" value="Foto Bersama Satwa" id="defaultCheck3">
                        <label class="form-check-label" for="defaultCheck3">
                        Tempat Foto
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
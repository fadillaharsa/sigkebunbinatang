@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <a href="{{route('facility.index')}}" class="text-dark"><img src="{{ asset('assets/images/dashboard1.png') }}" class="img-fluid mb-1">
            <p>Fasilitas dan Kandang</p></a>
        </div>
        <div class="col-sm-4">
            <a href="{{route('animal.index')}}" class="text-dark"><img src="{{ asset('assets/images/dashboard2.png') }}" class="img-fluid mb-1">
            <p>Satwa</p></a>
        </div>
        <div class="col-sm-4">
            <a href="{{route('route.index')}}" class="text-dark"><img src="{{ asset('assets/images/dashboard3.png') }}" class="img-fluid mb-1">
            <p>Rute</p></a>
        </div>
        <div class="col-sm-4">
            <a href="{{route('review.index')}}" class="text-dark"><img src="{{ asset('assets/images/dashboard4.png') }}" class="img-fluid mb-1">
            <p>Ulasan</p></a>
        </div>
        <div class="col-sm-4">
            <a href="{{route('news.index')}}" class="text-dark"><img src="{{ asset('assets/images/dashboard5.png') }}" class="img-fluid mb-1">
            <p>Berita</p></a>
        </div>
    </div>
</div>
@endsection

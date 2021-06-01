@extends('layouts.admin')

@push('scriptTop')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endpush

@section('content')
<div class="container">
    {{-- <x-navigation></x-navigation> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <H1 class="mb-4"><b>LIHAT ULASAN</b></H1>
            <a href="{{route('review.index')}}" class="btn btn-success text-white"><i class="fas fa-angle-left"></i> Kembali</a>
            
            <div class="mt-4">
                <div class="card card-body mb-3">
                <p><b>Isi Review:</b></p>
                <p class="mb-0"><i>"{{$review->review}}"</i></p>
                </div>
                <div class="card card-body mb-3">
                <p><b>Nama:</b></p>
                <p class="mb-0">{{$review->name}}</p>
                </div>
                <div class="card card-body mb-3">
                <p><b>Lokasi Fasilitas:</b></p>
                <p class="mb-0">{{$review->facility->title}}</p>
                </div>
                <div class="card card-body mb-3">
                <p><b>Jumlah Bintang:</b></p>
                <p class="mb-0">{{$review->rating}}</p>
                </div>             
            </div>
        </div>

    </div>
</div>
@endsection

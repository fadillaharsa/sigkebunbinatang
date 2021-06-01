@extends('layouts.app')

@section('title')
    <title>{{$berita->title}} - SIG Kebun Binatang Bandung</title>
@endsection

@section('content')
<div >
    <div class="d-flex justify-content-between align-items-center mb-3 text-center">
        <a href="{{ url()->previous() }}" class="btn btn-success text-white rounded-circle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <H1 class="mr-3"><b>{{$berita->title}}</b></H1>
        <span></span>
    </div>
    <img src="{{asset('storage/'.$berita->image)}}" class="img-fluid mb-3" style="width: 100%">
    <p class="text-info">{{$berita->user->name}} | {{date('d M Y', strtotime($berita->created_at))}}</p>
    <p>{!!$berita->content!!}</p>
   
</div>

@endsection

@push('script')

@endpush
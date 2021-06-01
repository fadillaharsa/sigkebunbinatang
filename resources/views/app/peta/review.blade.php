@extends('layouts.app')

@section('title')
    <title>Ulasan - SIG Kebun Binatang Bandung</title>
@endsection

@push('scriptTop')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
<style>  
    .starrating > input {display: none;}  /* Remove radio buttons */
    .starrating > label:before { 
        content: "\f005"; /* Star */
        margin-right: 5px;
        font-size: 2em;
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        display: inline-block; 
        }
    .starrating > label {
        color: #222222;
    }
    .starrating > input:checked ~ label {
        color: #ffca08 ; }
    .starrating > input:hover ~ label {
        color: #ffca08 ;  }
</style>
@endpush

@section('content')
<div >
    <div class="d-flex justify-content-between align-items-center text-center">
        <a href="{{ url()->previous() }}" class="btn btn-success text-white rounded-circle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <H1 class="mr-3"><b>ULASAN FASILITAS/KANDANG</b></H1>
        <span></span>
    </div>
    <p class="mt-0 text-center">Fasilitas: {{$fasilitas->title}}</p>
    <div class="mt-4">
        {!! Form::open(['route'=>['ulasan', $fasilitas->id], 'method'=>'post', 'files'=>true])!!}
            <div class="row">

                <input type="hidden" name="facility_id" value="{{$fasilitas->id}}">

                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Nama</label>
                        {!! Form::text('name',null,['class'=>$errors->has('name') ? 'form-control is-invalid' : 'form-control'])!!}
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Ulasan</label>
                        {!! Form::textarea('review',null,[
                            'class'=>$errors->has('review') ? 'form-control is-invalid' : 'form-control',
                            'cols'=>"10",
                            'rows'=>"3",
                            'placeholder'=>'Tulis ulasanmu di sini.'
                        ])!!}
                    </div>
                    @error('review')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-sm-12">
                    <label for="">Rating</label>
                </div>
                <div class="starrating d-flex flex-row-reverse ml-3">
                    <input type="radio" id="star5" name="rating" value="5" checked {{ old('rating') == "5" ? "checked": ""}} required><label for="star5" title="5 Bintang"></label>
                    <input type="radio" id="star4" name="rating" value="4" {{ old('rating') == "4" ? "checked": ""}} required><label for="star4" title="4 Bintang"></label>
                    <input type="radio" id="star3" name="rating" value="3" {{ old('rating') == "3" ? "checked": ""}} required><label for="star3" title="3 Bintang"></label>
                    <input type="radio" id="star2" name="rating" value="2" {{ old('rating') == "2" ? "checked": ""}} required><label for="star2" title="2 Bintang"></label>
                    <input type="radio" id="star1" name="rating" value="1" {{ old('rating') == "1" ? "checked": ""}} required><label for="star1" title="1 Bintang"></label>
                </div>
                @if ($errors->has('rating'))
                    <div class="invalid-feedback">
                        {{$errors->first('rating')}}
                    </div>
                @endif 
                
                <div class="col-sm-12 mt-3">
                    <button type="submit" class="mb-3 btn btn-success text-white btn-block d-flex justify-content-between align-items-center">
                        <span></span>
                        <span class="ml-2">Kirim Ulasan</span>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
   
</div>

@endsection

@push('script')

@endpush
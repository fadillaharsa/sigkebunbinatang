@extends('layouts.admin')

@section('content')
<div class="container">
    {{-- <x-navigation></x-navigation> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <H1 class="mb-4"><b>TAMBAH ULASAN</b></H1>
            <a href="{{route('review.index')}}" class="btn btn-success text-white"><i class="fas fa-angle-left"></i> Kembali</a>
            
            <div class="mt-4">

                {!! Form::open(['route'=>'review.store', 'method'=>'post', 'files'=>true])!!}
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Facility ID</label>
                                {!! Form::text('facility_id','1',['class'=>$errors->has('facility_id') ? 'form-control is-invalid' : 'form-control'])!!}
                            </div>
                            @error('facility_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
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

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">rating</label>
                                {!! Form::number('rating',null,['class'=>$errors->has('rating') ? 'form-control is-invalid' : 'form-control'])!!}
                            </div>
                            @error('rating')
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
                                    'rows'=>"3"
                                ])!!}
                            </div>
                            @error('review')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>

    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="container">
    {{-- <x-navigation></x-navigation> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <H1 class="mb-4"><b>TAMBAH RUTE</b></H1>
            <a href="{{route('route.index')}}" class="btn btn-success text-white"><i class="fas fa-angle-left"></i> Kembali</a>
            
            <div class="mt-4">

                {!! Form::open(['route'=>'route.store', 'method'=>'post', 'files'=>true])!!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nama Rute</label>
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
                                <label for="">Durasi</label>
                                {!! Form::text('duration',null,['class'=>$errors->has('duration') ? 'form-control is-invalid' : 'form-control'])!!}
                            </div>
                            @error('duration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                {!! Form::textarea('description',null,[
                                    'class'=>$errors->has('description') ? 'form-control is-invalid' : 'form-control',
                                    'cols'=>"10",
                                    'rows'=>"3"
                                ])!!}
                            </div>
                            @error('description')
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
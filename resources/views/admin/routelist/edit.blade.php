@extends('layouts.admin')

@section('content')
<div class="container">
    {{-- <x-navigation></x-navigation> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <H1 class="mb-4"><b>EDIT LIST RUTE</b></H1>
            <a href="{{route('routelist.show',$route_id)}}" class="btn btn-success text-white"><i class="fas fa-angle-left"></i> Kembali</a>
            
            <div class="mt-4">

                {!! Form::model($routelist,['route'=>['routelist.update',$routelist->id], 'method'=>'put', 'files'=>true])!!}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">ID Rute</label>
                            {!! Form::text('route_id',$route_id,['readonly' => 'true','class'=>$errors->has('route_id') ? 'form-control is-invalid' : 'form-control'])!!}
                        </div>
                        @error('route_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Fasilitas</label>
                            {!! Form::select('facility_id', $select, null, ['class'=>'form-control','placeholder' => 'Pilih lokasi fasilitas']) !!}
                        </div>
                        @if ($errors->has('facility_id'))
                            <ul class="alert alert-danger">
                                @foreach ($errors->get('facility_id') as $error)
                                    <span>{{ $error }}</span>
                                @endforeach
                            </ul>
                        @endif
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
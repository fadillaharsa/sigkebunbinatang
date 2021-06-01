@extends('layouts.admin')

@section('content')
<div class="container">
    {{-- <x-navigation></x-navigation> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <H1 class="mb-4"><b>EDIT SATWA</b></H1>
            <a href="{{route('animal.index')}}" class="btn btn-success text-white"><i class="fas fa-angle-left"></i> Kembali</a>
            
            <div class="mt-4">

                {!! Form::model($animal,['route'=>['animal.update',$animal->id], 'method'=>'put', 'files'=>true])!!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Nama Satwa</label>
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
                                <label for="">Nama Latin</label>
                                {!! Form::text('latin',null,['class'=>$errors->has('latin') ? 'form-control is-invalid' : 'form-control'])!!}
                            </div>
                            @error('latin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Lokasi Fasilitas</label>
                                {!! Form::select('facility_id', $select, $animal->facility_id, ['class'=>'form-control','placeholder' => 'Pilih lokasi fasilitas']) !!}
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
                            
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <button class="btn btn-sm btn-success" type="button" data-toggle="collapse" data-target="#collapsePhoto" aria-expanded="false" aria-controls="collapsePhoto">
                                        <i class="fas fa-exchange-alt"></i> Ganti Semua Foto
                                    </button>
                                    <ul>
                                        @foreach($animal->photos as $animalPhoto)
                                        <li>{{$animalPhoto->path}}</li>
                                        @endforeach   
                                    </ul>                             
                                </div>
                            
                           
                            <div class="collapse" id="collapsePhoto">
                                <div class="form-group increment">
                                    <div class="input-group">
                                        <input type="file" name="photo[]" class="form-control">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-primary btn-add"><i class="fas fa-plus-square"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('photo'))
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->get('photo') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="clone invisible">
                                    <div class="input-group mt-2">
                                        <input type="file" name="photo[]" class="form-control">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-danger btn-remove"><i class="fas fa-minus-square"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>

    </div>
</div>
@endsection

@push('script')
    <script>
        window.action = "submit"
    </script>
    <script>
        window.action = "submit"
        jQuery(document).ready(function () {
            jQuery(".btn-add").click(function () {
                let markup = jQuery(".invisible").html();
                jQuery(".increment").append(markup);
            });
            jQuery("body").on("click", ".btn-remove", function () {
                jQuery(this).parents(".input-group").remove();
            })
        })
    </script>
@endpush
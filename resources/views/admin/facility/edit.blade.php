@extends('layouts.admin')

@section('content')
<div class="container">
    {{-- <x-navigation></x-navigation> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <H1 class="mb-4"><b>EDIT FASILITAS ATAU KANDANG SATWA</b></H1>
            <a href="{{route('facility.index')}}" class="btn btn-success text-white"><i class="fas fa-angle-left"></i> Kembali</a>
            
            <div class="mt-4">

                {!! Form::model($facility,['route'=>['facility.update',$facility->id], 'method'=>'put', 'files'=>true])!!}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nama Fasilitas</label>
                                {!! Form::text('title',null,['class'=>$errors->has('title') ? 'form-control is-invalid' : 'form-control'])!!}
                            </div>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Kode Fasilitas</label>
                                {!! Form::text('code',null,['class'=>$errors->has('code') ? 'form-control is-invalid' : 'form-control'])!!}
                            </div>
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Kategori Fasilitas</label>
                                {{Form::select('category', ['Kandang Satwa' => 'Kandang Satwa', 'Fasilitas Isoma' => 'Fasilitas Isoma', 'Fasilitas Bermain' => 'Fasilitas Bermain','Toilet' => 'Toilet','Gerbang' => 'Gerbang'], null, ['class'=>'form-control','placeholder' => 'Pilih kategori fasilitas'])}}
                            </div>
                            @if ($errors->has('category'))
                                <ul class="alert alert-danger">
                                    @foreach ($errors->get('category') as $error)
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

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Foto</label>
                                <br>{{$facility->photo}}
                                <button class="btn btn-sm btn-success" type="button" data-toggle="collapse" data-target="#collapsePhoto" aria-expanded="false" aria-controls="collapsePhoto">
                                    <i class="fas fa-exchange-alt"></i> Ganti Foto
                                </button>
                                <div class="collapse" id="collapsePhoto">
                                  <div class="card card-body">
                                    <div class="input-group">
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                  </div>
                                </div>
                            </div>
                            @if ($errors->has('photo'))
                                <ul class="alert alert-danger">
                                    @foreach ($errors->get('photo') as $error)
                                        <span>{{ $error }}</span>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Icon</label>
                                <br>{{$facility->icon}}
                                <button class="btn btn-sm btn-success" type="button" data-toggle="collapse" data-target="#collapseIcon" aria-expanded="false" aria-controls="collapseIcon">
                                    <i class="fas fa-exchange-alt"></i> Ganti Icon
                                </button>
                                <div class="collapse" id="collapseIcon">
                                  <div class="card card-body">
                                    <div class="input-group">
                                        <input type="file" name="icon" class="form-control">
                                    </div>
                                  </div>
                                </div>
                            </div>
                            @if ($errors->has('icon'))
                                <ul class="alert alert-danger">
                                    @foreach ($errors->get('icon') as $error)
                                        <span>{{ $error }}</span>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="col-sm-12">
                            <div id="here-maps" class="mb-3">
                                <label for="">Pin Lokasi</label>
                                <div style="height:500px" id="mapContainer"></div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Latitude</label>
                                {!! Form::text('latitude',null,['class'=>$errors->has('latitude') ? 'form-control is-invalid' : 'form-control', 'id' => 'lat'])!!}
                            </div>
                            @error('latitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Longitude</label>
                                {!! Form::text('longitude',null,['class'=>$errors->has('longitude') ? 'form-control is-invalid' : 'form-control', 'id' => 'lng'])!!}
                            </div>
                            @error('longitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        @isset ($feed)
                            <div class="col-sm-12 mb-3">
                                <h1><b>INFORMASI WAHANA: FEEDING, TUNGGANGAN, ATAU FOTO SATWA</b></h1>
                            </div>
                            <input type="hidden" name="isFeed" value="1">
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="">Kategori Fasilitas</label>
                                    {{Form::select('categoryFeed', ['Feeding' => 'Feeding', 'Tunggangan' => 'Tunggangan', 'Foto Bersama Satwa' => 'Foto Bersama Satwa'], $feed->category, ['class'=>'form-control','placeholder' => 'Pilih kategori wahana'])}}
                                </div>
                                @if ($errors->has('categoryFeed'))
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->get('categoryFeed') as $error)
                                            <span>{{ $error }}</span>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="">Harga Wahana</label>
                                    {!! Form::number('price',$feed->price,['class'=>$errors->has('price') ? 'form-control is-invalid' : 'form-control'])!!}
                                </div>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Deskripsi Wahana</label>
                                    {!! Form::textarea('descriptionFeed',$feed->description,[
                                        'class'=>$errors->has('descriptionFeed') ? 'form-control is-invalid' : 'form-control',
                                        'cols'=>"10",
                                        'rows'=>"3"
                                    ])!!}
                                </div>
                                @error('descriptionFeed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endif

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
@endpush
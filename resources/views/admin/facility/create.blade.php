@extends('layouts.admin')

@section('content')
<div class="container">
    {{-- <x-navigation></x-navigation> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <H1 class="mb-4"><b>TAMBAH FASILITAS ATAU KANDANG SATWA</b></H1>
            <a href="{{route('facility.index')}}" class="btn btn-success text-white"><i class="fas fa-angle-left"></i> Kembali</a>
            
            <div class="mt-4">

                {!! Form::open(['route'=>'facility.store', 'method'=>'post', 'files'=>true])!!}
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
                                <label for="">Photo</label>
                                <div class="input-group">
                                    <input type="file" name="photo" class="form-control">
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
                                <div class="input-group">
                                    <input type="file" name="icon" class="form-control">
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

                        <div class="col-sm-12">
                            <div class="alert alert-danger mb-3" role="alert">
                                <input type="checkbox" name="isFeed" id="mycheckbox" value="1" /> Ceklist Di Sini dan Isi Data Di Bawah Apabila Termasuk Fasilitas Feeding, Tunggangan, atau Foto Bersama Satwa.
                            </div>
                            
                            <div id="mycheckboxdiv" style="display:none" class="card card-body alert-danger mb-4">
                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <h1><b>INFORMASI WAHANA: FEEDING, TUNGGANGAN, ATAU FOTO SATWA</b></h1>
                                        Keterangan: Tidak perlu isi bagian merah ini jika tidak termasuk fasilitas feeding, tunggangan, atau foto satwa.
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label for="">Kategori Wahana</label>
                                            {{Form::select('categoryFeed', ['Feeding' => 'Feeding', 'Tunggangan' => 'Tunggangan', 'Foto Bersama Satwa' => 'Foto Bersama Satwa'], null, ['class'=>'form-control','placeholder' => 'Pilih kategori wahana'])}}
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
                                            {!! Form::number('price',null,['class'=>$errors->has('price') ? 'form-control is-invalid' : 'form-control'])!!}
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
                                            {!! Form::textarea('descriptionFeed',null,[
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
                                </div>
                               
                            </div>
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

@push('script')
    <script>
        window.action = "submit"
    </script>
    <script type="text/javascript">
        document.getElementById('mycheckbox').addEventListener('change', function () {
            var style = this.value == 1 ? 'block' : 'none';
            document.getElementById('mycheckboxdiv').style.display = style;
        });
    </script>
@endpush
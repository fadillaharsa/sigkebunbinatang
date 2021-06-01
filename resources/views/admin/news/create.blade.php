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
            <H1 class="mb-4"><b>TAMBAH BERITA</b></H1>
            <a href="{{route('news.index')}}" class="btn btn-success text-white"><i class="fas fa-angle-left"></i> Kembali</a>
            
            <div class="mt-4">

                {!! Form::open(['route'=>'news.store', 'method'=>'post', 'files'=>true])!!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Judul Berita</label>
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
                                <label for="">Gambar</label>
                                <div class="input-group">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            @if ($errors->has('image'))
                                <ul class="alert alert-danger">
                                    @foreach ($errors->get('image') as $error)
                                        <span>{{ $error }}</span>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Konten Berita</label>
                                {!! Form::textarea('content',null,[
                                    'class'=>$errors->has('content') ? 'form-control is-invalid' : 'form-control',
                                    'id'=>'summernote'
                                ])!!}
                            </div>
                            @error('content')
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

@push('script')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $('#summernote').summernote({
            height: 400
        });
    </script>
@endpush
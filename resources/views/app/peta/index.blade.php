@extends('layouts.app')

@section('title')
    <title>Peta - SIG Kebun Binatang Bandung</title>
@endsection

@push('scriptTop')
<script>
    let category = {!! json_encode($category, JSON_HEX_TAG) !!};
</script>
@endpush

@section('content')
<div class="text-center">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ url()->previous() }}" class="btn btn-success text-white rounded-circle">
            <i class="fas fa-arrow-left"></i>
        </a>
        <H1 class="mr-5"><b>PETA</b></H1>
        <span></span>
    </div>
    <a href="" class="mb-3 btn btn-success text-white btn-block d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#filterModal">
        <span></span>
        <span class="ml-2">Filter</span>
        <i class="fas fa-tasks"></i>
    </a>
    @if($normal==false)
        <p>Filter Aktif: @foreach($category as $category)
                {{$category}}@if($loop->remaining>0),@endif
                @endforeach
                <a href="{{route('peta')}}" class="text-danger">(Reset)</a></p>
    @endif 
    <p>Cara Penggunaan: <br> Ketuk Gambar Ikon untuk Melihat Detil</p>  
</div>
<span class="text-info mb-1">Terdekat: <span id="terdekat"></span> (Refresh untuk Update)</span><br>
<img src="{{ asset('assets/images/Coord.png') }}" class="img-fluid mb-2" style="height:15px"> <span class="text-info">Lokasi Sekarang Realtime</span>
<div style="height:500px" id="mapContainer"></div> 

<div style="margin-bottom:90px"class="px-3 fixed-bottom row">
    <div class="col-6 d-flex justify-content-start">
        <a onClick="window.location.reload();"  class="btn btn-warning btn-circle btn-sm ">
            <i class="fas fa-sync-alt"></i> Refresh
        </a>
    </div>
    <div class="col-6 d-flex justify-content-end">
        <a href="#app" class="btn btn-warning btn-circle btn-sm ">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
</div>
<div style="margin-bottom:130px"class="px-3 fixed-bottom row">
    <div class="col-6 d-flex justify-content-start">
        <a onClick="speakFunction();"  class="btn btn-info btn-circle">
            <i class="fas fa-volume-up"></i>
        </a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLabel"><b>Filter Peta</b></h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <form action="{{route('filterpeta')}}" method="post">
            @csrf
                <div class="modal-body">
                    <h2><b>Ceklist</b></h2>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="category[]" value="Kandang Satwa" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                        Kandang Satwa
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="category[]" value="Fasilitas Isoma" id="defaultCheck2">
                        <label class="form-check-label" for="defaultCheck2">
                        Fasilitas Isoma
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="category[]" value="Fasilitas Bermain" id="defaultCheck3">
                        <label class="form-check-label" for="defaultCheck3">
                        Fasilitas Bermain
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="category[]" value="Toilet" id="defaultCheck4">
                        <label class="form-check-label" for="defaultCheck4">
                        Toilet
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="category[]" value="Gerbang" id="defaultCheck5">
                        <label class="form-check-label" for="defaultCheck5">
                        Gerbang
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Filter</button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection

@push('script')
    <script>
        window.action = "browse"
        function speakFunction() {
            let nearest = sessionStorage.getItem('nearest');
            let speak = new SpeechSynthesisUtterance();
            speak.lang = "id-ID";
            speak.text=`"Kamu sedang berada di"${nearest}`;
            window.speechSynthesis.speak(speak);
        }
    </script>
    <script>
        window.appURL = "{{env('APP_URL')}}"
        let options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge:10000
        };
        function success(pos) {}
        function error(err) {
            window.location =  `${window.appURL}/galat`;
        }
            navigator.geolocation.watchPosition(position => {
                localCoord = position.coords;
                objAsalCoord = {
                    lat: localCoord.latitude,
                    lng: localCoord.longitude
                }
            },error,options
            )
    </script>
    <script>
        window.hereApiKey = "{{env('HERE_API_KEY')}}"
    </script>
    <script src="{{ asset('js/here.js') }}"></script>
@endpush
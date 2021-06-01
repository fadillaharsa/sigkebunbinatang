@extends('layouts.admin')

@section('title')
    <title>Pengelolaan Satwa - SIG Kebun Binatang Bandung</title>
@endsection

@section('content')
<div class="container">
    {{-- <x-facility></x-facility> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <H1 class="mb-4"><b>PENGELOLAAN FASILITAS DAN KANDANG</b></H1>
            <a href="{{route('facility.create')}}" class="btn btn-success text-white"><i class="fas fa-plus-circle"></i> Tambah</a>
            @if (session('status'))
                <div class="alert alert-success mt-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="mt-4">
                <table id="table-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Fasilitas</th>
                            <th>Kode</th>
                            <th>Kelola</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama Fasilitas</th>
                            <th>Kode</th>
                            <th>Kelola</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($facilities as $facility)
                            <tr>
                                <td>{{ $loop->index + 1}}</td>
                                <td>{{$facility->title}}
                                    @isset($facility->feed)
                                    <span class="badge badge-success">Wahana</span>
                                    @endisset
                                </td>
                                <td>{{$facility->code}}</td>
                                <td>
                                    <a href="{{route('lihatfasilitas',$facility->id)}}" target="_blank" class="btn btn-sm btn-secondary text-white"><i class="fas fa-globe"></i> Lihat</a>
                                    <a href="{{route('facility.edit',$facility->id)}}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="" class="btn btn-sm btn-danger text-white addAttr" data-id={{$facility->id}} data-number={{ $loop->index + 1}} data-title={{$facility->title}} data-toggle="modal" data-target="#deleteModal">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
{{-- 
            <form action="#">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger float-right">Delete</button>
                <a href="#" class="btn btn-sm btn-info float-right text-white">Edit</a>
            </form> --}}
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <form action="{{ route('facility.destroy', 'id') }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" id="id" name="id" value="">
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data nomor <b><span id="addNumber"></span></b> yaitu fasilitas <b><span id="addTitle"></span></b>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $('.addAttr').click(function() {
    var id = $(this).data('id');
    $('#id').val(id);
    } );
</script>
<script>
    $('.addAttr').click(function() {
    var number = $(this).data('number');
    var title = $(this).data('title');
    document.getElementById("addNumber").innerHTML = number;
    document.getElementById("addTitle").innerHTML = title;
    } );
</script>
<script>
    $(document).ready(function(){
        $('#table-data').DataTable();
    });
</script>
@endpush
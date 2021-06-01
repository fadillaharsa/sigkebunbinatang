@extends('layouts.admin')

@section('title')
    <title>Pengelolaan Berita - SIG Kebun Binatang Bandung</title>
@endsection

@section('content')
<div class="container">
    {{-- <x-facility></x-facility> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <H1 class="mb-4"><b>PENGELOLAAN ULASAN</b></H1>
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
                            <th>Ulasan</th>
                            <th>Bintang</th>
                            <th>Status</th>
                            <th>Kelola</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Ulasan</th>
                            <th>Bintang</th>
                            <th>Status</th>
                            <th>Kelola</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($reviews as $ulasan)
                            <tr>
                                <td>{{ $loop->index + 1}}</td>
                                <td>{{ \Illuminate\Support\Str::limit($ulasan->review, 40, $end='...') }}</td>
                                <td>@for($i = 1; $i <= $ulasan->rating; $i++)
                                        <i class="fas fa-star text-warning"></i>
                                    @endfor
                                </td>
                                <td>@if ($ulasan->status==1) Dipublikasikan @else Disembunyikan @endif</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-secondary text-white"><i class="fas fa-globe"></i> Lihat</a>
                                    @if ($ulasan->status==1)
                                        <a href="{{route('review.edit',$ulasan->id)}}" class="btn btn-sm btn-info text-white"><i class="fas fa-eye-slash"></i> Sembunyikan</a>
                                    @else
                                        <a href="{{route('review.edit',$ulasan->id)}}" class="btn btn-sm btn-info text-white"><i class="fas fa-eye"></i> Publikasikan</a>
                                    @endif
                                    <a href="" class="btn btn-sm btn-danger text-white addAttr" data-id={{$ulasan->id}} data-number={{ $loop->index + 1}} data-toggle="modal" data-target="#deleteModal">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
            <form action="{{ route('review.destroy', 'id') }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" id="id" name="id" value="">
                <div class="modal-body">
                    Apakah anda yakin akan menghapus data nomor <b><span id="addNumber"></span></b>?
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
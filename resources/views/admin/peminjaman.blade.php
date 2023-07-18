@extends('layout.layout')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Peminjaman</h4>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate"><i class="fa fa-plus"></i> Tambah Data</button>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Judul Buku</th>
                                        <th>Tgl. Pinjam</th>
                                        <th>Tgl. Kembali</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($peminjaman as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->buku['judul_buku']}}</td>
                                    <td>{{$item->tgl_pinjam}}</td>
                                    <td>{{$item->tgl_kembali}}</td>
                                    <td class="text-center">
                                        <a href="#" data-target="#modalEdit{{$item->id}}" data-toggle="modal" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="{{asset('admin/delete-peminjaman/'.$item->id)}}" type="button" class="btn btn-danger" onclick="return confirm('Yakin akan menghapus data ini?')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>

<!-- Modal Tambah-->
<div class="modal fade" id="modalCreate">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="create-peminjaman" method="POST">
            @csrf
            <div class="modal-body">
                <label>Nama</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan nama">
                </div>
                <label>Judul Buku</label>
                <div class="form-group">
                    <select class="form-control" name="id_buku">
                        @foreach($buku as $row)
                        <option value="<?= $row->id ?>">
                            <?= $row->judul_buku ?>
                        </option>
                        @endforeach
                </select>
                </div>
                <label>Tanggal Pinjam</label>
                <div class="form-group">
                    <input type="date" class="form-control" name="tgl_pinjam" placeholder="Masukkan tanggal pinjam">
                </div>
                <label>Tanggal Kembali</label>
                <div class="form-group">
                    <input type="date" class="form-control" name="tgl_kembali" placeholder="Masukkan tanggal kembali">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit-->
@foreach ($peminjaman as $item)
<div class="modal fade" id="modalEdit{{$item->id}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="edit-peminjaman" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" class="form-control" id="id" name="id" value="{{$item->id}}">
                <label>Nama</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="nama" value="{{$item->nama}}" placeholder="Masukkan nama">
                </div>
                <label>Judul Buku</label>
                <div class="form-group">
                    <select class="form-control" name="id_buku">
                        @foreach($buku as $row)
                        @if ($row->id == $item->id_buku)
                            {{$ses = "selected"}}
                        @else
                            {{$ses = ""}}
                        @endif
                        <option value="<?= $row->id ?>" <?= $ses ?>>
                            <?= $row->judul_buku ?>
                        </option>
                        @endforeach
                </select>
                </div>
                <label>Tanggal Pinjam</label>
                <div class="form-group">
                    <input type="date" class="form-control" name="tgl_pinjam" value="{{$item->tgl_pinjam}}" placeholder="Masukkan tanggal pinjam">
                </div>
                <label>Tanggal Kembali</label>
                <div class="form-group">
                    <input type="date" class="form-control" name="tgl_kembali" value="{{$item->tgl_kembali}}" placeholder="Masukkan tanggal kembali">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
@if (Session::has('success'))
    toastr.success("{{Session::get('success')}}")
@endif
</script>
@endsection

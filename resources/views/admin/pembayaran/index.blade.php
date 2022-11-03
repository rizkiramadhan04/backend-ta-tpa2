@extends('layouts.admin')
@section('title', 'Pembayaran')
@section('content')
    <div class="container">

        @if (Session::has('error'))
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block" style="width: 100%;display: block;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
        @endif
        @if (Session::has('success'))
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block" style="width: 100%;display: block;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
        @endif

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pembayaran</h1>
            <a href="{{ route('admin.export-pembayaran') }}" class="btn btn-sm btn-success shadow-sm" data-toggle="modal"
                data-target="#pembayaran">
               <i class="fa-solid fa-download"></i> Export Excel Pembayaran
            </a>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('admin.pembayaran-create-page') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-plus"></i> Buat Pembayaran
            </a>
        </div>
        <div class="row">
            <div class="table-responsive text-center">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Murid</th>
                            <th>No Rekening</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($item as $obj)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $obj->nama_murid }}</td>
                                <td>{{ $obj->no_rek }}</td>
                                <td>{{ $obj->jumlah }}</td>
                                <td>
                                    <?php if ($obj->status == 0) { ?>
                                    <span class="badge badge-primary">Belum dilihat</span>
                                    <?php } else { ?>
                                    <span class="badge badge-success">Diterima</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="{{ route('admin.pembayaran-detail', $obj->id) }}" class="btn btn-success">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <form action="{{ route('admin.pembayaran-delete', $obj->id) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            @empty
                            <tr>
                                <td colspan="8">Data Masih Kosong !!</td>
                            </tr>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="pembayaran" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Export Data Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6><b>Data Pembayaran</b></h6>
                        <form action="{{ route('admin.export-pembayaran') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="tanggal_awal">Tanggal Awal</label>
                                <input type="date" class="form-control" id="tanggal_awal">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_akhir">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tanggal_akhir">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Export Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{ $item->links() }}
    </div>
@endsection

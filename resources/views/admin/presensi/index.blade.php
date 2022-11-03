@extends('layouts.admin')
@section('title', 'Data Murid')
@section('content')
    <div class="text-center">

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
            <h1 class="h3 mb-0 text-gray-800">Data Presensi</h1>
            <a href="{{ route('admin.murid-create-page') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-download"></i> Export Excel
            </a>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Status Sebagai</th>
                            <th>Tingkatan</th>
                            <th>Tanggal Masuk</th>
                            <th>Waktu Presensi</th>
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
                                <td>{{ $obj->name }}</td>
                                <td>
                                    <?php if ($obj->status_user == 0) { ?>
                                    <b>Murid</b>
                                    <?php } else { ?>
                                    <b>Guru</b>
                                    <?php } ?>
                                </td>
                                <td>{{ $obj->tingkatan }}</td>
                                <td>{{ date('d-m-Y', strtotime($obj->tanggal_masuk)) }}</td>
                                <td>{{ date('H:i', strtotime($obj->tanggal_masuk)) }}</td>
                                <td>
                                    <a href="{{ route('admin.murid-detail', $obj->id) }}" class="btn btn-success">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <form action="{{ route('admin.murid-delete', $obj->id) }}" method="post"
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
        {{ $item->links() }}
    </div>
@endsection

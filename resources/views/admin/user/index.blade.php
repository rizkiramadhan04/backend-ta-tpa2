@extends('layouts.admin')
@section('title', 'Data User')
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
            <h1 class="h3 mb-0 text-gray-800">User</h1>
            <a href="{{ route('admin.user-create-page') }}" class="btn btn-sm btn-success shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah User Baru
            </a>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status Sebagai</th>
                            <th>Tanggal Lahir</th>
                            <th>Nomor Handphone</th>
                            <th>Tingkatan</th>
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
                                <td>{{ $obj->email }}</td>
                                <td>
                                    <?php if ($obj->status == 0) { ?>
                                    <b>Murid</b>
                                    <?php } else { ?>
                                    <b>Guru</b>
                                    <?php } ?>
                                </td>
                                <td>{{ date('d-m-Y', strtotime($obj->tgl_lahir)) }}</td>
                                <td>{{ $obj->no_hp }}</td>
                                <td>{{ $obj->tingkatan }}</td>
                                <td>
                                    <a href="{{ route('admin.user-update-page', $obj->id) }}" class="btn btn-success">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    <form action="{{ route('admin.user-delete', $obj->id) }}" method="post"
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

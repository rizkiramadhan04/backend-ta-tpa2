@extends('layouts.admin')
@section('title', 'Data Presensi')
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
            <h1 class="h3 mb-0 text-gray-800">Jadwal Presensi</h1>
            <a href="{{ route('admin.presensi-create-page') }}" class="btn btn-sm btn-success shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Jadwal Baru
            </a>
        </div>
        <div class="row ">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>BarCode</th>
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
                                <td>{{ $obj->nama_kegiatan }}</td>
                                <td>{{ date('d-m-Y H:i', strtotime($obj->tanggal_awal)) }}</td>
                                <td>{{ date('d-m-Y H:i', strtotime($obj->tanggal_akhir)) }}</td>
                                <td width="20">{!! DNS2D::getBarcodeHTML(base64_decode($obj->kode_presensi), 'QRCODE') !!}</td>
                                <td>
                                    <a href="#" class="btn btn-success">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <form action="{{ route('admin.presensi-delete', $obj->id) }}" method="post"
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

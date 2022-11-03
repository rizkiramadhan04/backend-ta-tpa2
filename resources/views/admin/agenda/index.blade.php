@extends('layouts.admin')
@section('title', 'Data Agenda')
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
            <h1 class="h3 mb-0 text-gray-800">Agenda</h1>
            <a href="{{ route('admin.agenda-create-page') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-plus"></i> Buat Agenda Baru
            </a>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Agenda</th>
                            <th>Tanggal Agenda</th>
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
                                <td>{{ $obj->nama_agenda }}</td>
                                <td>{{ $obj->tanggal_agenda }}</td>
                                <td>
                                    <a href="{{ route('admin.agenda-detail', $obj->id) }}" class="btn btn-success">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.agenda-update-page', $obj->id) }}" class="btn btn-success">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    <form action="{{ route('admin.agenda-delete', $obj->id) }}" method="POST"
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
        <br />

        <div class="justify-content-center">
            {{ $item->links() }}
        </div>

        <br />
    </div>
@endsection

@extends('layouts.admin')
@section('title', 'Tambah Agenda')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Agenda</h1>
        </div>

        @if(Session::has('error'))
		    @if ($message = Session::get('error'))
		    <div class="alert alert-danger alert-block" style="width: 100%;display: block;">
		    <button type="button" class="close" data-dismiss="alert">×</button> 
			    <strong>{{ $message }}</strong>
		    </div>
		    @endif
	    @endif
        @if(Session::has('success'))
		    @if ($message = Session::get('success'))
		    <div class="alert alert-success alert-block" style="width: 100%;display: block;">
		    <button type="button" class="close" data-dismiss="alert">×</button> 
			    <strong>{{ $message }}</strong>
		    </div>
		    @endif
	    @endif

        <form action="{{ route('admin.agenda-create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-xl-6 col-md-4">
                <label for="">Nama Agenda</label>
                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="name_agenda"
                    aria-describedby="nama_agenda" name="nama_agenda" value="{{ old('nama_agenda') }}">
                @error('nama_agenda')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="deskripsi_agenda">Deskripsi Agenda</label>
                <textarea type="textarea" class="form-control @error('deskripsi_agenda') is-invalid @enderror" id="deskripsi_agenda"
                    name="deskripsi_agenda">{{ old('deskripsi_agenda') }}</textarea>
                @error('deskripsi_agenda')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="tanggal_agenda">Tanggal Agenda</label>
                <input type="date" class="form-control @error('tanggal_agenda') is-invalid @enderror" id="tanggal_agenda"
                    name="tanggal_agenda" value="{{ old('tanggal_agenda') }}">
                @error('tanggal_agenda')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="gambar">Gambar Agenda</label>
                <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                    name="gambar" value="{{ old('gambar') }}" accept="image/*">
                @error('gambar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <button type="submit" class="btn btn-primary"> Simpan </button>
        </form>

    </div>
@endsection

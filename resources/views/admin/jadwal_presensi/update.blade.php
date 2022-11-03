@extends('layouts.admin')
@section('title', 'Update Data Presensi')
@section('content')
    <div class="container-fluid">

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

        <div class="d-sm-flex justify-content-between mb-4 text-center">
            <h1 class="h3 mb-0 text-gray-800">Tambah Jadwal Presensi</h1>
        </div>
        <form action="#" method="POST">
            @csrf
            <div class="form-group col-xl-6 col-md-4">
                <label for="nama_kegiatan">Nama Kegiatan</label>
                <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="nama_kegiatan"
                    aria-describedby="nama_kegiatan" name="nama_kegiatan" placeholder="Nama Kegiatan">
                @error('nama_kegiatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="tanggal_awal">Tanggal Mulai</label>
                <input type="datetime-local" class="form-control @error('tanggal_presensi') is-invalid @enderror" id="tanggal_presensi"
                    name="tanggal_awal">
                @error('tanggal_awal')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="tanggal_akhir">Tanggal Akhir</label>
                <input type="datetime-local" class="form-control @error('tanggal_akhir') is-invalid @enderror" id="tanggal_akhir"
                    name="tanggal_akhir">
                @error('tanggal_akhir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary"> Simpan </button>
        </form>
    </div>
@endsection

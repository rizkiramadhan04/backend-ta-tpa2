@extends('layouts.admin')
@section('title', 'Tambah Murid')
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
            <h1 class="h3 mb-0 text-gray-800">Tambah Murid</h1>
        </div>
        <form action="{{ route('admin.user-create') }}" method="POST">
            @csrf
            <div class="form-group col-xl-6 col-md-4">
                <label for="name">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    aria-describedby="name" name="name" placeholder="Nama">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="emaipassword">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="status">Status Sebagai </label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                    <option value="0">Murid</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                    name="tgl_lahir">
                @error('tgl_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="no_hp">Nomor Handphone</label>
                <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                    name="no_hp" placeholder="0812*******">
                @error('no_hp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="alamat">Alamat</label>
                <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                    name="alamat" placeholder="Jl. Gotong Royong ..."></textarea>
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4 tingkatan">
                <label for="tingkatan">Tingkatan </label>
                <select class="form-control @error('tingkatan') is-invalid @enderror" id="tingkatan" name="tingkatan">
                    <option value="">-- Pilih Tingkatan --</option>
                    <option value="Awal">Awal</option>
                    <option value="Lanjut">Lanjut</option>
                    <option value="Lancar">Lancar</option>
                </select>
                @error('tingkatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-3"> Simpan </button>
        </form>
    </div>
@endsection

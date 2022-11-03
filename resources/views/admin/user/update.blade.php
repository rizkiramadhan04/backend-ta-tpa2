@extends('layouts.admin')
@section('title', 'Edit User')
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
            <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
        </div>
        <form action="{{ route('admin.user-update', $user->id) }}" method="POST">
            @csrf

            <div class="form-group col-xl-6 col-md-4">
                <label for="name">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    aria-describedby="name" name="name" placeholder="Nama" value="{{ $user->name }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="emaipassword">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ $user->email }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="status">Status </label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                    <?php if ($user->status == 0) { ?>
                    <option value="0">Murid</option>
                    <option value="1">Guru</option>
                    <?php } else { ?>
                    <option value="1">Guru</option>
                    <option value="0">Murid</option>
                    <?php } ?>
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
                    name="tgl_lahir" value="{{ $user->tgl_lahir }}">
                @error('tgl_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="no_hp">Nomor Handphone</label>
                <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                    name="no_hp" placeholder="0812*******" value="{{ $user->no_hp }}">
                @error('no_hp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4 tingkatan">
                <label for="tingkatan">Tingkatan </label>
                <select class="form-control @error('tingkatan') is-invalid @enderror" id="tingkatan" name="tingkatan">
                    <?php if ($user->tingkatan != '') { ?>
                    <option value="Awal">Awal</option>
                    <option value="Lanjut">Lanjut</option>
                    <option value="Lancar">Lancar</option>
                    <?php } else { ?>
                    <option value="">-- Pilih Tingkatan --</option>
                    <option value="Awal">Awal</option>
                    <option value="Lanjut">Lanjut</option>
                    <option value="Lancar">Lancar</option>
                    <?php } ?>
                </select>
                @error('tingkatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Edit Data</button>
        </form>
    </div>
@endsection

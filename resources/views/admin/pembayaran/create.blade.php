@extends('layouts.admin')
@section('title', 'Pembayaran')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Pembayaran</h1>
        </div>

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

        <form action="{{ route('admin.pembayaran-create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-xl-6 col-md-4">
                <label for="nama_murid">Nama Murid</label>
                <select class="form-control @error('murid_id') is-invalid @enderror" id="murid_id" name="murid_id">
                    <option>-- Pilih Murid --</option>
                    @foreach ($murid as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('murid_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="jenis_pembayaran">Jenis Pembayaran</label>
                <select class="form-control @error('jenis_pembayaran') is-invalid @enderror" id="jenis_pembayaran"
                    name="jenis_pembayaran">
                    <option value="">-- Pilih Jenis Pembayaran --</option>
                    <option value="Bayaran Bulanan">Bayaran Bulanan</option>
                    <option value="Sumbangan Untuk Agenda">Sumbangan Untuk Agenda</option>
                </select>
                @error('jenis_pembayaran')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="jumlah">Jumlah <span style="color: red;">*</span>Rp. </label>
                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                    name="jumlah">
                @error('jumlah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="no_rek">Nomor Rekening</label>
                <input type="number" class="form-control @error('no_rek') is-invalid @enderror" id="no_rek"
                    name="no_rek">
                @error('no_rek')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="no_hp">Nomor Handphone</label>
                <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                    name="no_hp">
                @error('no_hp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-xl-6 col-md-4">
                <label for="gambar">Bukti Pembayaran</label>
                <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                    name="gambar">
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

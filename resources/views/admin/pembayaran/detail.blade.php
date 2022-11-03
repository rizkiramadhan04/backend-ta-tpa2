@extends('layouts.admin')
@section('title', 'Pembayaran')
@section('content')
    <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Pembayaran</h1>
        </div>
        <div class="row mb-5">
            <div class="content col-lg-6 col-md-6">

                <h6>Nama Murid</h6>
                <h6><b>{{ $data->nama_murid }}</b></h6>

                <hr>
                <br>

                <h6>Nomor Rekening</h6>
                <p>{{ $data->no_rek }}</p>

                <hr>
                <br>

                <h6>Nomor Handphone</h6>
                <p>{{ $data->no_hp }}</p>

                <hr>
                <br>
                <h6>Jumlah</h6>
                <p>{{ $data->jumlah }}</p>

                <hr>
                <br>
                <h6>Jenis Pembayaram</h6>
                <p>{{ $data->jenis_pembayaran }}</p>

                <hr>
                <br>

                <h6>Tanggal Pembayaran</h6>
                <h6><b>{{ date('d-m-Y H:i:s', strtotime($data->created_at)) }}</b></h6>

            </div>
            <div class="gambar col-lg-6 col-md-6">
                <h6>Bukti Pembayaran</h6>
                <img src="{{ asset('storage') . '/pembayaran/' . base64_decode($data->gambar) }}" alt=""
                    class="img-thumbnail img-responsive mt-2" style="width: 60%">
            </div>
        </div>

        @if ($data->status == 0)
            <form action="{{ route('admin.pembayaran-update-status', $data->id) }}" method="post" class="mb-5">
                @csrf
                <button type="submit" class="btn btn-primary"> Sudah Diterima </button>
            </form>
        @else
            <form action="{{ route('admin.pembayaran-update-status', $data->id) }}" method="post" class=" d-none mb-5">
                @csrf
                <button type="submit" class="btn btn-primary"> Sudah Diterima </button>
            </form>
        @endif

    </div>
@endsection

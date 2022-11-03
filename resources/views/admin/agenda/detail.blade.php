@extends('layouts.admin')
@section('title', 'Data Agenda')
@section('content')
    <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Agenda</h1>
        </div>
        <div class="row">
            <div class="content col-lg-6 col-md-6">
                    
                <h6>Nama Agenda</h6>
                <h6><b>{{ $data->nama_agenda }}</b></h6>

                <hr>
                <br>

                <h6>Deskripsi Agenda</h6>
                <p>{{ $data->deskripsi_agenda }}</p>

                <hr>
                <br>

                <h6>Tanggal Agenda</h6>
                <h6><b>{{ $data->tanggal_agenda }}</b></h6>
                
            </div>
            <div class="gambar col-lg-6 col-md-6">
                <h6>Gambar</h6>
                <img src="{{ asset("storage")."/agenda/".base64_decode($data->gambar) }}" alt="" class="img-thumbnail img-responsive" style="width: 60%">
            </div>
        </div>
    </div>
@endsection

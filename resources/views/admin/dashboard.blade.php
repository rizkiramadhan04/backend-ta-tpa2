@extends('layouts.admin')
@section('title', 'Dashboard Admin')

@section('content')
    <!-- Begin Page Content -->

    <div class="text-center mt-5">
        @if (Auth::user()->roles != 'admin')
            <h5 class="mt-3 text-danger"><b>*Mohon maaf anda bukan admin silahkan keluar !</b></h5>
        @else
            <h3>Selamat datang di dashboard !</h3>
        @endif
    </div>


    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        {{-- <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Pesanan Hari ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Produk Terlaris</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Produk Stok Sedikit
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Content Row -->

    {{-- <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4 mr-5">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Produk dengan penjualan terbaik</h6>
                </div>


                <div class="card-body">
                    <h4 class="small font-weight-bold"> <span class="float-right"> Pcs</span>
                    </h4>
                    <div class="progress mb-2">
                        <div class="progress-bar bg-success" role="progressbar" style="width:100%" aria-valuenow=""
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-lg-5 mb-4 mr-5">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Produk dengan penjualan menurun</h6>
                </div>

                <div class="card-body">
                    <h4 class="small font-weight-bold"> <span class="float-right"> Pcs</span>
                    </h4>
                    <div class="progress mb-2">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: %" aria-valuenow=""
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

            </div>

        </div>
    </div> --}}

    <!-- /.container-fluid -->
@endsection

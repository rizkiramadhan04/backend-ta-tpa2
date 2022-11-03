@extends('layouts.admin')
@section('title', 'Data Detail Murid')
@section('content')
    <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Murid</h1>
        </div>
        <div class="row">
            <div class="content col-lg-6 col-md-6">

                <h6>Nama Murid</h6>
                <h6><b>{{ $data->name }}</b></h6>

                <hr>
                <br>

                <h6>Email</h6>
                <p><b>{{ $data->email }}</b></p>

                <hr>
                <br>

                <h6>Tanggal Lahir</h6>
                <h6><b>{{ $data->tgl_lahir }}</b></h6>

                <hr>
                <br>

                <h6>Alamat</h6>
                <h6>{{ $data->alamat }}</h6>

                <hr>
                <br>

                <h6>Tingkatan</h6>
                <h6><b>{{ $data->tingkatan }}</b></h6>

            </div>

        </div>

        <hr>
        <br>

        <h5 style="text-align: center; font-weight: bold;">Persentase presensi dan mengaji murid</h5>

        <div class="row mt-5 mb-5">

            <div class="col-6">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Presensi</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Menu : </div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#presensi">
                                    Export Excel Presensi
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">Januari <span class="float-right">{{ $dataPresensi['januari'] }}
                                Hari</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar"
                                style="width: {{ ($dataPresensi['januari'] / 30) * 100 }}%" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax=""></div>
                        </div>
                        <h4 class="small font-weight-bold">Februari <span
                                class="float-right">{{ $dataPresensi['februari'] }} Hari</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ ($dataPresensi['februari'] / 30) * 100 }}%" aria-valuenow="40"
                                aria-valuemin="0" aria-valuemax=""></div>
                        </div>
                        <h4 class="small font-weight-bold">Maret <span class="float-right">{{ $dataPresensi['maret'] }}
                                Hari</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar"
                                style="width: {{ ($dataPresensi['maret'] / 30) * 100 }}%" aria-valuenow="60"
                                aria-valuemin="0" aria-valuemax=""></div>
                        </div>
                        <h4 class="small font-weight-bold">April <span class="float-right">{{ $dataPresensi['april'] }}
                                Hari</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar"
                                style="width: {{ ($dataPresensi['april'] / 30) * 100 }}%" aria-valuenow="80"
                                aria-valuemin="0" aria-valuemax=""></div>
                        </div>
                        <h4 class="small font-weight-bold">Mei <span class="float-right">{{ $dataPresensi['mei'] }}
                                Hari</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar"
                                style="width: {{ ($dataPresensi['mei'] / 30) * 100 }}%" aria-valuenow="80"
                                aria-valuemin="0" aria-valuemax=""></div>
                        </div>
                        <h4 class="small font-weight-bold">Juni <span class="float-right">{{ $dataPresensi['juni'] }}
                                Hari</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ ($dataPresensi['juni'] / 30) * 100 }}%" aria-valuenow="" aria-valuemin="0"
                                aria-valuemax=""></div>
                        </div>
                        <h4 class="small font-weight-bold">Juli <span class="float-right">{{ $dataPresensi['juli'] }}
                                Hari</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ ($dataPresensi['juli'] / 30) * 100 }}%" aria-valuenow="" aria-valuemin="0"
                                aria-valuemax=""></div>
                        </div>
                        <h4 class="small font-weight-bold">Agustus <span class="float-right">{{ $dataPresensi['agustus'] }}
                                Hari</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ ($dataPresensi['agustus'] / 30) * 100 }}%" aria-valuenow=""
                                aria-valuemin="0" aria-valuemax=""></div>
                        </div>
                        <h4 class="small font-weight-bold">September <span
                                class="float-right">{{ $dataPresensi['september'] }} Hari</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ ($dataPresensi['september'] / 30) * 100 }}%" aria-valuenow=""
                                aria-valuemin="0" aria-valuemax=""></div>
                        </div>
                        <h4 class="small font-weight-bold">Oktober <span
                                class="float-right">{{ $dataPresensi['oktober'] }} Hari</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ ($dataPresensi['oktober'] / 30) * 100 }}%" aria-valuenow=""
                                aria-valuemin="0" aria-valuemax=""></div>
                        </div>
                        <h4 class="small font-weight-bold">November <span
                                class="float-right">{{ $dataPresensi['november'] }} Hari</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ ($dataPresensi['november'] / 30) * 100 }}%" aria-valuenow=""
                                aria-valuemin="0" aria-valuemax=""></div>
                        </div>
                        <h4 class="small font-weight-bold">Desember <span
                                class="float-right">{{ $dataPresensi['desember'] }} Hari</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ ($dataPresensi['desember'] / 30) * 100 }}%" aria-valuenow="10"
                                aria-valuemin="0" aria-valuemax="30"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-6">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Mengaji</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Menu : </div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#mengaji">
                                    Export Excel Mengaji
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h4 class="small font-weight-bold">Ulang <span
                                class="float-right">{{ $data_mengaji['data_mengaji_ulang'] }}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar"
                                style="width: {{ $data_mengaji['data_mengaji_ulang'] }}%"
                                aria-valuenow="{{ $data_mengaji['data_mengaji_ulang'] }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Cukup <span
                                class="float-right">{{ $data_mengaji['data_mengaji_cukup'] }}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $data_mengaji['data_mengaji_cukup'] }}%"
                                aria-valuenow="{{ $data_mengaji['data_mengaji_cukup'] }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Lanjut <span
                                class="float-right">{{ $data_mengaji['data_mengaji_lanjut'] }}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $data_mengaji['data_mengaji_lanjut'] }}%"
                                aria-valuenow="{{ $data_mengaji['data_mengaji_cukup'] }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Menghafal</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Menu : </div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hafalan">
                                    Export Excel Hafalan
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h4 class="small font-weight-bold">Bacaan Solat <span
                                class="float-right">{{ $data_hafalan['data_hafalan_1'] }}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar"
                                style="width: {{ $data_hafalan['data_hafalan_1'] }}%"
                                aria-valuenow="{{ $data_hafalan['data_hafalan_1'] }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Do'a Sehari-hari <span
                                class="float-right">{{ $data_hafalan['data_hafalan_2'] }}%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $data_hafalan['data_hafalan_2'] }}%"
                                aria-valuenow="{{ $data_hafalan['data_hafalan_2'] }}" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="hafalan" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Export Data Hafalan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6><b>Data {{ $data->name }}</b></h6>
                        <form action="{{ route('admin.export-hafalan', $data->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="tanggal_awal">Tanggal Awal</label>
                                <input type="date" class="form-control" id="tanggal_awal">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_akhir">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tanggal_akhir">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Export Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="mengaji" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Export Data Mengaji</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6><b>Data {{ $data->name }}</b></h6>
                        <form action="{{ route('admin.export-pencatatan', $data->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="tanggal_awal">Tanggal Awal</label>
                                <input type="date" class="form-control" id="tanggal_awal">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_akhir">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tanggal_akhir">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Export Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="presensi" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Export Data Presensi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6><b>Data {{ $data->name }}</b></h6>
                        <form action="{{ route('admin.export-presensi', $data->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="tanggal_awal">Tanggal Awal</label>
                                <input type="date" class="form-control" id="tanggal_awal">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_akhir">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tanggal_akhir">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Export Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

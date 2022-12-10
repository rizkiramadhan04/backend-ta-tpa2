<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Presensi PDF</title>
</head>

<body>
    <div class="container text-center">
        <div class="header text-center">
            <p><b>Taman Pendidikan Agama (TPA) Al - Muhibbin</b></p>
            <p>Jl. Saidi Guru II, Kebayoran Baru - Jakarta Selatan</p>
        </div>
        <hr />

        <br />
        <br />
        <h1><b>QR Code untuk presensi</b></h1>
        <h3><b>Tanggal :</b></h3>
        <h3><b>{{ date('d-m-Y H:i', strtotime($data->tanggal_awal)) . ' s/d ' . date('d-m-Y H:i', strtotime($data->tanggal_akhir)) }}</b>
        </h3>
        <br />
        <br />
        <br />

        <div class="qr_code text-center justify-content-md-center" align="center"
            style="text-align:center; margin:0 auto;">
            <div class="col-md-2 col-md-offset-5" style="self-align:center; margin-left: 24%;">
                {!! DNS2D::getBarcodeHTML(base64_decode($data->kode_presensi), 'QRCODE') !!}
            </div>
        </div>

        <br />
        <br />
        <br />
        <h5 class="h5"><b>Silahkan Scan QR Code menggunakan aplikasi TPA untuk melakukan presensi</b></h5>
    </div>

</body>

</html>

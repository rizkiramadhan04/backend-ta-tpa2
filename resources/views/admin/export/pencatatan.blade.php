<!DOCTYPE html>
<html>

<head>
    <title>TPA Al Muhibbin - Data Mengaji</title>
</head>

<body>

    <div class="container">
        <table border="2">
            <thead style="background:#d1d1d1;">
                <tr>
                    <th>No</th>
                    <th>Nama Murid</th>
                    <th>Nama Surah</th>
                    <th>Ayat</th>
                    <th>Nomor Iqro</th>
                    <th>Jilid</th>
                    <th>Halaman</th>
                    <th>Nama Guru</th>
                    <th>Hasil / Keterangan</th>
                    <th>Tanggal</th>
                    <th>Jenis Kitab</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($model as $value)
                    <?php
                    $get_data = \App\Models\User::where('id', $value->guru_id)->first();
                    $get_nama_surah = \App\Models\Alquran::where('no_surah', $value->no_surah)->first();
                    if ($get_data && $get_nama_surah) {
                        $nama_guru = $get_data->name;
                        $nama_surah = $get_nama_surah->nama_surah;
                    }
                    ?>
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ ucwords($value->nama) }}</td>
                        <td>{{ ucwords($nama_surah) }}</td>
                        <td>{{ $value->no_ayat }}</td>
                        <td>{{ $value->no_iqro }}</td>
                        <td>{{ $value->jilid }}</td>
                        <td>{{ $value->halaman }}</td>
                        <td>{{ ucwords($nama_guru) }}</td>
                        <td>
                            <?php if ($value->status == 0) { ?>
                            <b>Mengulang</b>
                            <?php } else if($value->status == 1) { ?>
                            <b>Cukup</b>
                            <?php } else { ?>
                            <b>Lanjut</b>
                            <?php }?>
                        </td>
                        <td>{{ date('d-m-Y', strtotime($value->tanggal)) }}</td>
                        <td>{{ $value->jenis_kitab }}</td>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>

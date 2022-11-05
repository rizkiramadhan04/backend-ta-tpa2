<!DOCTYPE html>
<html>

<head>
    <title>TPA Al Muhibbin - Data Hafalan</title>
</head>

<body>

    <div class="container">
        <table border="2" style="text-align: center">
            <thead style="background:#d1d1d1;">
                <tr>
                    <th>No</th>
                    <th>Nama Murid</th>
                    <th>Materi Hafalan</th>
                    <th>Type</th>
                    <th>Tanggal Hafalan</th>
                    <th>Nilai</th>
                    <th>Nama Penyimak</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach ($model as $value)
                    <?php
                    $get_data = \App\Models\User::where('id', $value->guru_id)->first();
                    if ($get_data) {
                        $nama_guru = $get_data->name;
                    }
                    ?>
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ ucwords($value->nama) }}</td>
                        <td>{{ $value->materi_hafalan }}</td>
                        <td>
                            <?php if ($value->jenis == 1) { ?>
                            <b>Hafalan Harian</b>
                            <?php } else if($value->jenis == 2) { ?>
                            <b>Halafan Pokok</b>
                            <?php } ?>
                        </td>
                        <td>{{ date('d-m-Y', strtotime($value->tanggal_hafalan)) }}</td>
                        <td>{{ $value->nilai }}</td>
                        <td>{{ $nama_guru }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>

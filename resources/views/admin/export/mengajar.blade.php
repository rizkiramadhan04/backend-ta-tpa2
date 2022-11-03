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
                         <th>Nama Guru</th>
                         <th>Nama Murid</th>
                         <th>Tingkatan Murid</th>
                         <th>Hasil / Keterangan</th>
                         <th>Tanggal</th>
                         <th>Jenis Kitab</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($model as $value)
                <?php
                    $get_data = \App\Models\User::where('id', $value->guru_id)->first();
                    if ($get_data) {
                        $nama_guru = $get_data->name;
                    }
                ?>
				<tr>
					     <td>{{ $i++ }}</td>
                         <td>{{ ucwords($nama_guru) }}</td>
					     <td>{{ ucwords($value->nama) }}</td>
					     <td>{{ $value->tingkatan }}</td>
                         <td>{{ $value->keterangan }}</td>
                         <td>{{ date('d-m-Y', strtotime($value->tanggal)) }}</td>
                         <td>{{ $value->jenis_kitab }}</td>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>
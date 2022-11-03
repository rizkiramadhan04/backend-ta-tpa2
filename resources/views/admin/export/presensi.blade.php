<!DOCTYPE html>
<html>
<head>
	<title>TPA Al Muhibbin - Data Presensi</title>
</head>
<body>

	<div class="container">
		<table border="2" class="text-center">
			<thead style="background:#d1d1d1;">
				<tr>
                         <th>No</th>
                         <th>Nama</th>
                         <th>Status Sebagai</th>
                         <th>Status Presensi</th>
                         <th>Tanggal Presensi</th>
                         <th>Tanggal Izin</th>
                         <th>Alasan Izin</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($model as $value)
				<tr>
					     <td>{{ $i++ }}</td>
					     <td>{{ ucwords($value->nama) }}</td>
                         <td>
							<?php if ($value->status_user == 0) { ?>
                            <b>Murid</b>
                            <?php } else { ?>
                            <b>Guru</b>
                    		<?php } ?>
						 </td>
                         <td>
							<?php if ($value->status_presensi != 0) { ?>
                            <b>Masuk</b>
                            <?php } else { ?>
                            <b>Gagal Scan</b>
                    		<?php } ?>
						</td>
                         <td>{{ date('d-m-Y H:i', strtotime($value->tanggal_masuk)) }}</td>
                         <td>
							<?php if ($value->tanggal_izin != "") { ?>
                            {{ date('d-m-Y', strtotime($value->tanggal_izin)) }}
                            <?php } else { ?>
                            <span></span>
                    		<?php } ?>
						</td>
						<td>{{ $value->alasan_izin }}</td>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>
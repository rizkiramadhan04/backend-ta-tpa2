<!DOCTYPE html>
<html>
<head>
	<title>TPA Al Muhibbin Data Pembayaran</title>
</head>
<body>

	<div class="container">
		<table border="2">
			<thead style="background:#d1d1d1;">
				<tr>
                         <th>No</th>
                         <th>Nama Murid</th>
                         <th>Nomor HP</th>
                         <th>Jumlah</th>
                         <th>Nomor Rekening</th>
                         <th>Pembayaran Untuk</th>
                         <th>Status</th>
						 <th>Tanggal Konfirmasi</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($model as $value)
				<tr>
					     <td>{{ $i++ }}</td>
					     <td>{{ ucwords($value->nama) }}</td>
                         <td>{{ $value->no_hp }}</td>
                         <td>{{ number_format($value->jumlah,2,',','.');  }}</td>
                         <td>{{ $value->no_rek }}</td>
                         <td>{{ $value->jenis_pembayaran }}</td>
                         <td>
							<?php if ($value->status == 0) { ?>
                            <b>Belum Dilihat</b>
                            <?php } else { ?>
                            <b>Sudah Diterima</b>
                    		<?php } ?>
						 </td>
                         <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>
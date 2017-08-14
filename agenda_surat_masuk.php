<html>
<head>
<style type="text/css" media="print">
	table {border: solid 1px #000; border-collapse: collapse; width: 100%}
	tr { border: solid 1px #000; page-break-inside: avoid;}
	td { padding: 7px 5px; font-size: 10px}
	th {
		font-family:Arial;
		color:black;
		font-size: 11px;
		background-color:lightgrey;
	}
	thead {
		display:table-header-group;
	}
	tbody {
		display:table-row-group;
	}
	h3 { margin-bottom: -17px }
	h2 { margin-bottom: 0px }
</style>
<style type="text/css" media="screen">
	table {border: solid 1px #000; border-collapse: collapse; width: 100%}
	tr { border: solid 1px #000}
	th {
		font-family:Arial;
		color:black;
		font-size: 11px;
		background-color: #999;
		padding: 8px 0;
	}
	td { padding: 7px 5px;font-size: 10px}
	h3 { margin-bottom: -17px }
	h2 { margin-bottom: 0px }
</style>
<title>Cetak Agenda Surat Masuk</title>
</head>

<body onload="window.print()">
	<center><b style="font-size: 20px">AGENDA SURAT MASUK</b><br>
	Dari tanggal <b><?php echo tgl_jam_sql($tgl_start)."</b> sampai dengan tanggal <b>".tgl_jam_sql($tgl_end)."</b>"; ?>
	</center><br>
	
	<table>
		<thead>
			<tr>
				<th width=auto>No</td>
				<th width=auto>No. Agenda</td>
				<th width=auto>Perihal</td>
				<th width=auto>Dari</td>
				<th width=auto>Nomor Surat</td>
				<th width=auto>Tgl. Surat</td>
				<th width=auto>Tgl Diterima</td>
				<th width=auto>Petugas</td>
				<th width=auto>Ket</td>
			</tr>
		</thead>
		<tbody>
			<?php 
			if (!empty($data)) {
				$no = 0;
				foreach ($data as $d) {
					$no++;
			?>
			<tr>
				<td><center><?php echo $no; ?></td>
				<td><center><?php echo $d->no_agenda; ?></td>
				<td><?php echo $d->perihal; ?></td>
				<td><?php echo $d->dari; ?></td>
				<td><?php echo $d->no_surat; ?></td>
				<td><center><?php echo tgl_jam_sql($d->tgl_surat); ?></td>
				<td><center><?php echo tgl_jam_sql($d->tgl_diterima); ?></td>
				<td><?php echo gval("t_admin", "id", "nama", $d->pengolah); ?></td>
				<td><?php echo $d->keterangan; ?></td>
			</tr>
			<?php 
				}
			} else {
				echo "<tr><td style='text-align: center'>Tidak ada data</td></tr>";
			}
			?>
		</tbody>
	</table>
</body>
</html>


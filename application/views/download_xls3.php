<?php 
// header("Content-type: application/vnd.ms-excel");
// header("Content-disposition: attachment; filename=\"$filename\"");

$count_ukuran = count($list_ukuran);
?>

<table>
	<tr>
		<th style="text-align:center;" colspan="11">SITUASI KONTAINER DAN REALISASI DOKUMEN IP TPKB GEDE BAGE</th>
	</tr>
	<tr>
		<th style="text-align:center;" colspan="11"><?=date('d M Y', strtotime($tglx));?></th>
	</tr>
	<tr><td>&nbsp;</td></tr>
</table>


<table border="1">
	<tr>
		<th style="text-align:center;" rowspan="2">No.</th>
		<th style="text-align:center;" rowspan="2" colspan="2">Nama Importir</th>
		<th style="text-align:center;" rowspan="2">Ukuran</th>
		<th style="text-align:center;" colspan="7">Situasi Kontainer</th>
	</tr>
	<tr>
		<th style="text-align:center;">Jumlah Lalu</th>
		<th style="text-align:center;">Sisa Lalu</th>
		<th style="text-align:center;">Masuk Hari Ini</th>
		<th style="text-align:center;">IP</th>
		<th style="text-align:center;">SPPB</th>
		<th style="text-align:center;">Sisa</th>
		<th style="text-align:center;">Jumlah</th>
	</tr>

	<?php
	$i = 0;
	foreach($rows as $row){
		$nama = $row['nama'];
		$kode = $row['kode'];

		$first = true;
		foreach($list_ukuran as $ukuran){
			extract($ukuran);
			++$i;
			echo "<tr>";
			if($first) echo "<td rowspan='$count_ukuran'>$i</td>";
			if($first) echo "<td rowspan='$count_ukuran'>$nama</td>";
			if($first) echo "<td rowspan='$count_ukuran'>$kode</td>";
			echo "<td>$ukuran</td>";
			echo "<td>".$rekap[$kode][$ukuran]['jml_lalu']."</td>";
			echo "<td>".$rekap[$kode][$ukuran]['sisa_lalu']."</td>";
			echo "<td>".$rekap[$kode][$ukuran]['masuk_hari_ini']."</td>";
			echo "<td>".$rekap[$kode][$ukuran]['ip']."</td>";
			echo "<td>".$rekap[$kode][$ukuran]['sppb']."</td>";
			echo "<td>".$rekap[$kode][$ukuran]['sisa']."</td>";
			echo "<td>".$rekap[$kode][$ukuran]['jumlah']."</td>";
			echo "</tr>";
			$first = false;
		}
	}
	?>
</table>



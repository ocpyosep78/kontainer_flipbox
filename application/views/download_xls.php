<?php 
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=\"$filename\"");

if($flag < 3) $count_ukuran = count($list_ukuran);
?>

<table border="1">
	<?php if($flag == 1){ ?>
		<tr>
			<th style="text-align:center;" rowspan="2">No.</th>
			<th style="text-align:center;" rowspan="2">Tanggal</th>
			<th style="text-align:center;" rowspan="2">Perusahaan</th>
			<th style="text-align:center;" colspan="2" rowspan="2">Nomor Kontainer</th>
			<th style="text-align:center;" colspan="<?=$count_ukuran?>">Ukuran</th>
			<th style="text-align:center;" rowspan="2">Uraian Barang</th>
			<th style="text-align:center;" rowspan="2">Tanggal IP</th>
			<th style="text-align:center;" rowspan="2">Tanggal SPPB</th>
		</tr>
		<tr>
			<?php
			foreach($list_ukuran as $ukuran){
				extract($ukuran);
				echo "<th style='text-align:center;'>$ukuran</th>";
			}
			?>
		</tr>
	<?php }elseif($flag == 2){ ?>
		<tr>
			<th style="text-align:center;" rowspan="2">No.</th>
			<th style="text-align:center;" rowspan="2">Tanggal</th>
			<th style="text-align:center;" rowspan="2">Perusahaan</th>
			<th style="text-align:center;" rowspan="2">No. PIB</th>
			<th style="text-align:center;" rowspan="2">Tanggal PIB</th>
			<th style="text-align:center;" colspan="2" rowspan="2">Nomor Kontainer</th>
			<th style="text-align:center;" colspan="<?=$count_ukuran?>">Ukuran</th>
			<th style="text-align:center;" rowspan="2">Jam IP</th>
			<th style="text-align:center;" colspan="2">Jam Periksa</th>
			<th style="text-align:center;" rowspan="2">Uraian Barang</th>
			<th style="text-align:center;" rowspan="2">Pemeriksa</th>
			<th style="text-align:center;" rowspan="2">Tanggal SPPB</th>
		</tr>
		<tr>
			<?php
			foreach($list_ukuran as $ukuran){
				extract($ukuran);
				echo "<th style='text-align:center;'>$ukuran</th>";
			}
			?>
			<th style='text-align:center;'>Mulai</th>
			<th style='text-align:center;'>Selesai</th>
		</tr>
	<?php }elseif($flag == 3){ ?>
		<tr>
			<th style="text-align:center;">No.</th>
			<th style="text-align:center;">Nama Owner</th>
			<th style="text-align:center;">Nama Perusahaan</th>
			<th style="text-align:center;">Kode Perusahaan</th>
			<th style="text-align:center;">Jumlah Kontainer</th>
		</tr>
	<?php } ?>

	<?php
	foreach($rows as $row){
		echo "<tr>";
		foreach($row_keys as $row_key){
			$cell = $row[$row_key];
			if($row_key == "ukuran"){
				foreach($list_ukuran as $ukuran){
					extract($ukuran);
					if($cell == $ukuran) echo "<td style='text-align:center;'>".str_replace("\"", "", $cell)."</td>";
					else echo "<td style='text-align:center;'>0</td>";
				}
			}else{
				if($row_key == "tanggal" || $row_key == "tgl_pib" || $row_key == "tgl_sppb" || $row_key == "tgl_ip"){
					$cell = str_replace("-", "/", $cell);
				}
				if($row_key == "jam_ip" || $row_key == "jam_periksa_st" || $row_key == "jam_periksa_en"){
					$cell = substr($cell, 0, strlen($cell)-3);
				}
				echo "<td>$cell</td>";
			}
		}
		echo "</tr>";
	}
	?>
</table>



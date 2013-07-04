<?php 
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=\"$filename\"");
?>

<table>
	<tr>
		<?php
		foreach($headers as $header){
			echo "<th>$header</th>";
		}
		?>
	</tr>
	<?php
	foreach($rows as $row){
		echo "<tr>";
		foreach($row_keys as $row_key){
			$cell = $row[$row_key];
			if($row_key == "tanggal" || $row_key == "tgl_pib"){
				$cell = str_replace("-", "/", $cell);
			}
			echo "<td>$cell</td>";
		}
		echo "</tr>";
	}
	?>
</table>



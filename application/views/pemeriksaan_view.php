<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sistem Pendataan Kontainer</title>

		<link rel="stylesheet" href="<?=base_url();?>application/css/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?=base_url();?>application/css/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?=base_url();?>application/css/colour.css" type="text/css" media="screen" charset="utf-8" />
		<!--[if IE]><![if gte IE 6]><![endif]-->
		<script src="<?=base_url();?>application/js/jquery-1.4.2.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jquery-ui-1.8.1.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jquery.tablesorter.js" type="text/javascript"></script>
	</head>
	<body>
		<header>
			<?php 
				$data['active'] = 2;
				$this->load->view('header', $data); 
			?>
		</header>

		<section>
			<div id="content" class="container_16 clearfix">
				<form method="post" action="<?=site_url('pemeriksaan/entry')?>">
					<div class="grid_1"><p>
						<input name="no" type="text" placeholder="No"/>
					</p></div>
					<div class="grid_2"><p>
						<input name="tanggal" type="text" id="datepicker" placeholder="Tanggal" pattern="((19|20)\d\d[/]0[1-9]|1[012])[/](0[1-9]|[12][0-9]|3[01])" required/>
					</p></div>
					<div class="grid_3"><p>
						<select name="perusahaan" required>
							<option value='-'>[Pilih Perusahaan]</option>
							<?php
							foreach($list_perusahaan as $per){
								echo "<option value='".$per['nama']."'>".$per['nama']."</option>";
							}
							?>
						</select>
					</p></div>
					<div class="grid_2"><p>
						<input name="no_pib" type="text" placeholder="No PIB" required/>
					</p></div>
					<div class="grid_2"><p>
						<input name="tgl_pib" type="text" id="datepicker2" placeholder="Tgl PIB" required/>
					</p></div>
					<div class="grid_2"><p>
						<input name="kode" type="text" placeholder="Kode Kontainer" required/>
					</p></div>
					<div class="grid_2"><p>
						<input name="nomor" type="text" placeholder="Nomer Kontainer" required/>
					</p></div>
					<div class="grid_2"><p>
						<select name="ukuran">
							<option value='-'>[Pilih Ukuran]</option>
							<option value='10"'>10"</option>
							<option value='20"'>20"</option>
							<option value='40"'>40"</option>
							<option value='50"'>50"</option>
							<option value='60"'>60"</option>
						</select>
					</p></div>
					<div class="grid_2"><p>
						<input name="jam_ip" type="text" placeholder="Jam IP" required/>
					</p></div>
					<div class="grid_2"><p>
						<input name="jam_periksa" type="text" placeholder="Jam Periksa" required/>
					</p></div>
					<div class="grid_2"><p>
						<input name="uraian" type="text" placeholder="Uraian Barang" required/>
					</p></div>
					<div class="grid_2"><p>
						<input name="pemeriksa" type="text" placeholder="Pemeriksa" required/>
					</p></div>
					<div class="grid_1"><p>
						<input name="fun" type="hidden" value="<?php if(isset($key)) echo $key; else echo 'page';?>"/>
						<input type="submit" value="Submit"/>
					</p></div>
				</form>

				<div class="grid_9">
					<p>&nbsp;</p>
				</div>
				<form method='POST' action='<?=base_url();?>pemeriksaan/search'>
					<div class="grid_4">
						<p>
							<input type="text" name='search' placeholder="Search Table"/>
						</p>
					</div>
					<div class="grid_1">
						<p>
							<input type="submit" value="Search" />
						</p>
					</div>
				</form>
				<div class="grid_1">
					<p>
						<?php
						$download_url = base_url()."pemeriksaan/download_xls";
						if(isset($key)) $download_url .= "?key=$key";
						?>

						<a href='<?=$download_url;?>' class='error'>Download</a>
					</p>
				</div>

				<div class="grid_16">
					<table id="dataList2" clas="tablesorter">
						<colgroup>
							<col class="colA" style="width:30px; word-wrap:break-word;"/>
							<col class="colB" style="width:60px; word-wrap:break-word;"/>
							<col class="colC" style="width:130px; word-wrap:break-word;"/>
							<col class="colD" style="width:50px; word-wrap:break-word;"/>
							<col class="colE" style="width:60px; word-wrap:break-word;"/>
							<col class="colF" style="width:50px; word-wrap:break-word;"/>
							<col class="colG" style="width:50px; word-wrap:break-word;"/>
							<col class="colH" style="width:45px; word-wrap:break-word;"/>
							<col class="colI" style="width:50px; word-wrap:break-word;"/>
							<col class="colJ" style="width:50px; word-wrap:break-word;"/>
							<col class="colK" style="width:110px; word-wrap:break-word;"/>
							<col class="colL" style="width:80px; word-wrap:break-word;"/>
							<col class="colM" style="width:25px; word-wrap:break-word;"/>
							<col class="colN" style="width:25px; word-wrap:break-word;"/>
							<col class="colO" style="width:25px; word-wrap:break-word;"/>
						</colgroup>
						<thead>
							<tr>
								<th>No</th>
								<th class='center'>Tanggal</th>
								<th>Perusahaan</th>
								<th>No. PIB</th>
								<th class='center'>Tgl PIB</th>
								<th>Kode Kontainer</th>
								<th>Nomor Kontainer</th>
								<th class='center'>Ukuran</th>
								<th class='center'>Jam IP</th>
								<th class='center'>Jam Periksa</th>
								<th>Uraian Barang</th>
								<th>Pemeriksa</th>
								<th class='center' colspan="3" width="10%">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($rows as $row){
								extract($row);
								$tanggal = str_replace("-", "/", $tanggal);
								$tgl_pib = str_replace("-", "/", $tgl_pib);

								echo "
									<tr>
										<td id='col_no_$no' style='text-align:left;'>$no</td>
										<td id='col_tanggal_$no' class='center'>$tanggal</td>
										<td id='col_perusahaan_$no'>$perusahaan</td>
										<td id='col_no_pib_$no'>$no_pib</td>
										<td id='col_tgl_pib_$no' class='center'>$tgl_pib</td>
										<td id='col_kode_$no'>$kode</td>
										<td id='col_nomor_$no'>$nomor</td>
										<td id='col_ukuran_$no' class='center'>$ukuran</td>
										<td id='col_jam_ip_$no' class='center'>$jam_ip</td>
										<td id='col_jam_periksa_$no' class='center'>$jam_periksa</td>
										<td id='col_uraian_$no'>$uraian</td>
										<td id='col_pemeriksa_$no'>$pemeriksa</td>
										<td id='col_sppb_$no' class='center'>";
				if($status == '1') echo 	"<a href='#' onclick=\"sppb_submit('$no')\" class='sppb' no='$no'></a></td>"; 
				else echo 					"<a href='#' class='sppbyes'></a></td>";
				echo "					<td id='col_edit_$no' class='center'><a href='#' onclick=\"edit_row('$no')\" class='edit'></a></td>
										<td id='col_delete_$no' class='center'><a href='#' onclick=\"confirm_delete_row('$no')\" class='delete'></a></td>
									</tr>
									<tr style='display:none'>
										<td id='col_status_$no'>$status</td>
									</tr>
								";
							}
							?>
						</tbody>
						<tfoot>
							<tr><td colspan="15">&nbsp;</td><tr>
							<tr>
								<td colspan="15" class="pagination">
									<?php 
										$prev = $page-1;
										$next = $page+1;

										if($maxpage > 10 && $page > 5){
											if(isset($key)) echo "<a href='".base_url()."pemeriksaan/search?key=$key&page=$prev' class='curved'>Prev</a>";
											else echo "<a href='".base_url()."pemeriksaan/page/$prev' class='curved'>Prev</a>";
										}

										$st = $page-4;
										if($st < 1) $st = 1;
										$en = $st + 9;
										if($en > $maxpage){
											$en = $maxpage;
											$st = $en-9;
											if($st < 1) $st = 1;
										}

										for($i = $st; $i <= $en; $i++){
											if($i == $page) echo "<span class='active curved'>$i</span>";
											else{
												if(isset($key)) echo "<a href='".base_url()."pemeriksaan/search?key=$key&page=$i' class='curved'>$i</a>";
												else echo "<a href='".base_url()."pemeriksaan/page/$i' class='curved'>$i</a>";
											}
										}

										if($maxpage > 10 && $page+5 < $maxpage){
											if(isset($key)) echo "<a href='".base_url()."pemeriksaan/search?key=$key&page=$next' class='curved'>Next</a>";
											else echo "<a href='".base_url()."pemeriksaan/page/$next' class='curved'>Next</a>";
										}
									?>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</section>

		<footer></footer>
	</body>
</html>

<script type="text/javascript">
	$(function(){
		$("#content .grid_5, #content .grid_6").sortable({
			placeholder: 'ui-state-highlight',
			forcePlaceholderSize: true,
			connectWith: '#content .grid_6, #content .grid_5',
			handle: 'h2',
			revert: true
		});
		$("#content .grid_5, #content .grid_6").disableSelection();
	});

	$(document).ready(function(){ 
        $("#dataList").tablesorter(); 
	});

	$(function(){
		$("#datepicker").datepicker();
		$("#datepicker2").datepicker();
		$(".datepicker3").datepicker();
	});

	function sppb_submit(no)
	{
		<?php
		$back_url = urlencode(base_url()."pemeriksaan/page/".$page);
		if(isset($key)) $back_url = urlencode(base_url()."pemeriksaan/search?key=".$key."&page=".$page);
		?>

		document.location = "<?=base_url();?>pemeriksaan/sppb/"+no+"?back_url=<?=$back_url;?>";;
	}

	function edit_row(no)
	{
		var val_tanggal = $("#col_tanggal_"+no).html();
		var val_perusahaan = $("#col_perusahaan_"+no).html();
		var val_no_pib = $("#col_no_pib_"+no).html();
		var val_tgl_pib = $("#col_tgl_pib_"+no).html();
		var val_kode = $("#col_kode_"+no).html();
		var val_nomor = $("#col_nomor_"+no).html();
		var val_ukuran = $("#col_ukuran_"+no).html();
		var val_jam_ip = $("#col_jam_ip_"+no).html();
		var val_jam_periksa = $("#col_jam_periksa_"+no).html();
		var val_uraian = $("#col_uraian_"+no).html();
		var val_pemeriksa = $("#col_pemeriksa_"+no).html();
		var val_status = $("#col_status_"+no).html();

		val_ukuran = val_ukuran.replace("\"","");

		var input_tanggal = "<input id='input_tanggal_"+no+"' name='tanggal' type='text' class='datepicker_"+no+"' value='"+val_tanggal+"' style='width:65px; height:14px; vertical-align:middle;'/>";
		var input_perusahaan = "<select id='input_perusahaan_"+no+"' name='perusahaan' style='width:150px; height:25px; vertical-align:middle;'> <option value='-'>[Pilih Perusahaan]</option>" + 
									<?php
									echo "\"";
									foreach($list_perusahaan as $per){
										$nama = $per['nama'];
										echo "<option value='$nama'>$nama</option>";
									}
									echo "\"";
									?>
								+ "</select>";
		var input_no_pib = "<input id='input_no_pib_"+no+"' name='no_pib' type='text' value='"+val_no_pib+"' style='width:50px; height:14px; vertical-align:middle;'/>";
		var input_tgl_pib = "<input id='input_tgl_pib_"+no+"' name='tgl_pib' type='text' class='datepicker2_"+no+"' value='"+val_tgl_pib+"' style='width:65px; height:14px; vertical-align:middle;'/>";
		var input_kode = "<input id='input_kode_"+no+"' name='kode' type='text' value='"+val_kode+"' style='width:55px; height:14px; vertical-align:middle;'/>";
		var input_nomor = "<input id='input_nomor_"+no+"' name='nomor' type='text' value='"+val_nomor+"' style='width:55px; height:14px; vertical-align:middle;'/>";
		var input_ukuran = "<select id='input_ukuran_"+no+"' name='ukuran' style='width:60px; height:25px; vertical-align:middle; text-align:center;'>" +
								"<option value='-'>[Pilih Ukuran]</option>" +
								"<option value='10\"'>10\"</option>" +
								"<option value='20\"'>20\"</option>" +
								"<option value='40\"'>40\"</option>" +
								"<option value='50\"'>50\"</option>" +
								"<option value='60\"'>60\"</option>" +
							"</select>";
		var input_jam_ip = "<input id='input_jam_ip_"+no+"' name='jam_ip' type='text' value='"+val_jam_ip+"' style='width:55px; height:14px; vertical-align:middle;'/>";
		var input_jam_periksa = "<input id='input_jam_periksa_"+no+"' name='jam_periksa' type='text' value='"+val_jam_periksa+"' style='width:55px; height:14px; vertical-align:middle;'/>";
		var input_uraian = "<input id='input_uraian_"+no+"' name='uraian' type='text' value='"+val_uraian+"' style='width:130px; height:14px; vertical-align:middle;'/>";
		var input_pemeriksa = "<input id='input_pemeriksa_"+no+"' name='pemeriksa' type='text' value='"+val_pemeriksa+"' style='width:80px; height:14px; vertical-align:middle;'/>";
		var save_button = "<a href='#' onclick=\"save_row('"+no+"')\" class='save'></a>";
		var cancel_button = "<a href='#' onclick=\"cancel_row('"+no+"','"+val_tanggal+"','"+val_perusahaan+"','"+val_no_pib+"','"+val_tgl_pib+"','"+val_kode+"','"+val_nomor+"','"+val_ukuran+"','"+val_jam_ip+"','"+val_jam_periksa+"','"+val_uraian+"','"+val_pemeriksa+"','"+val_status+"')\" class='cancel'></a>";
		
		$("#col_tanggal_"+no).html(input_tanggal);
		$("#col_perusahaan_"+no).html(input_perusahaan);
		$("#col_no_pib_"+no).html(input_no_pib);
		$("#col_tgl_pib_"+no).html(input_tgl_pib);
		$("#col_kode_"+no).html(input_kode);
		$("#col_nomor_"+no).html(input_nomor);
		$("#col_ukuran_"+no).html(input_ukuran);
		$("#col_jam_ip_"+no).html(input_jam_ip);
		$("#col_jam_periksa_"+no).html(input_jam_periksa);
		$("#col_uraian_"+no).html(input_uraian);
		$("#col_pemeriksa_"+no).html(input_pemeriksa);
		$("#col_sppb_"+no).html(save_button);
		$("#col_edit_"+no).html(cancel_button);
		$("#col_delete_"+no).html("");

		$("#dataList tr").css('height', '32px');
		$(".datepicker_"+no).datepicker();
		$(".datepicker2_"+no).datepicker();
		$("#input_ukuran_"+no).val(val_ukuran+"\"");
		$("#input_perusahaan_"+no).val(val_perusahaan);
	}

	function save_row(no)
	{
		var form_data = {
			no: no,
			tanggal: $("#input_tanggal_"+no).val(),
			perusahaan: $("#input_perusahaan_"+no).val(),
			no_pib: $("#input_no_pib_"+no).val(),
			tgl_pib: $("#input_tgl_pib_"+no).val(),
			kode: $("#input_kode_"+no).val(),
			nomor: $("#input_nomor_"+no).val(),
			ukuran: $("#input_ukuran_"+no).val(),
			jam_ip: $("#input_jam_ip_"+no).val(),
			jam_periksa: $("#input_jam_periksa_"+no).val(),
			uraian: $("#input_uraian_"+no).val(),
			pemeriksa: $("#input_pemeriksa_"+no).val(),
			ajax: '1'
		};

		var parts = form_data.tanggal.split("/");
		var thn = parseInt(parts[0]);
		var bln = parseInt(parts[1]);
		var tgl = parseInt(parts[2]);

		parts = form_data.tgl_pib.split("/");
		var thn2 = parseInt(parts[0]);
		var bln2 = parseInt(parts[1]);
		var tgl2 = parseInt(parts[2]);

		if(bln >= 1 && bln <= 12 && tgl >= 1 && tgl <= 31 && thn >= 1900 && thn <= 2999 && bln2 >= 1 && bln2 <= 12 && tgl2 >= 1 && tgl2 <= 31 && thn2 >= 1900 && thn2 <= 2999){
			$.ajax({
				url: "<?=site_url('pemeriksaan/update');?>",
				type: "POST",
				data: form_data,
				success: function(){
					var status = $("#col_status_"+no).html();

					$("#col_tanggal_"+no).html($("#input_tanggal_"+no).val());
					$("#col_perusahaan_"+no).html($("#input_perusahaan_"+no).val());
					$("#col_no_pib_"+no).html($("#input_no_pib_"+no).val());
					$("#col_tgl_pib_"+no).html($("#input_tgl_pib_"+no).val());
					$("#col_kode_"+no).html($("#input_kode_"+no).val());
					$("#col_nomor_"+no).html($("#input_nomor_"+no).val());
					$("#col_ukuran_"+no).html($("#input_ukuran_"+no).val());
					$("#col_jam_ip_"+no).html($("#input_jam_ip_"+no).val());
					$("#col_jam_periksa_"+no).html($("#input_jam_periksa_"+no).val());
					$("#col_uraian_"+no).html($("#input_uraian_"+no).val());
					$("#col_pemeriksa_"+no).html($("#input_pemeriksa_"+no).val());
					if(status == '1') $("#col_sppb_"+no).html("<a href='#' onclick=\"sppb_submit('$no')\" class='sppb' no='$no'></a></td>");
					else $("#col_sppb_"+no).html("<a href='#' class='sppbyes'></a></td>");
					$("#col_edit_"+no).html("<a href='#' onclick=\"edit_row('"+no+"')\" class='edit'></a>");
					$("#col_delete_"+no).html("<a href='#' onclick=\"confirm_delete_row('"+no+"')\" class='trash'></a>");
				}
			});
		}else{
			alert("Invalid Date!");
		}
	}

	function cancel_row(no, tanggal, perusahaan, no_pib, tgl_pib, kode, nomor, ukuran, jam_ip, jam_periksa, uraian, pemeriksa, status)
	{
		$("#col_tanggal_"+no).html(tanggal);
		$("#col_perusahaan_"+no).html(perusahaan);
		$("#col_no_pib_"+no).html(no_pib);
		$("#col_tgl_pib_"+no).html(tgl_pib);
		$("#col_kode_"+no).html(kode);
		$("#col_nomor_"+no).html(nomor);
		$("#col_ukuran_"+no).html(ukuran + "\"");
		$("#col_jam_ip_"+no).html(jam_ip);
		$("#col_jam_periksa_"+no).html(jam_periksa);
		$("#col_uraian_"+no).html(uraian);
		$("#col_pemeriksa_"+no).html(pemeriksa);
		if(status == '1') $("#col_sppb_"+no).html("<a href='#' onclick=\"sppb_submit('$no')\" class='sppb' no='$no'></a></td>");
		else $("#col_sppb_"+no).html("<a href='#' class='sppbyes'></a></td>");
		$("#col_edit_"+no).html("<a href='#' onclick=\"edit_row('"+no+"')\" class='edit'></a>");
		$("#col_delete_"+no).html("<a href='#' onclick=\"confirm_delete_row('"+no+"')\" class='delete'></a>");
	}

	function confirm_delete_row(no)
	{
		if(confirm('Apakah anda yakin?')){
			<?php
			$back_url = urlencode(base_url()."pemeriksaan/page/".$page);
			if(isset($key)) $back_url = urlencode(base_url()."pemeriksaan/search?key=".$key."&page=".$page);
			?>

			document.location = "<?=base_url();?>pemeriksaan/delete/"+no+"?back_url=<?=$back_url;?>";
		}
	}

	function tes()
	{
		alert('tes');
	}
	
</script>



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
				$data['active'] = 1;
				$this->load->view('header', $data); 
			?>
		</header>

		<section>
			<div id="content" class="container_16 clearfix">
				<form method="post" action="<?=site_url('kontainer/entry')?>">
					<div class="grid_1"><p>
						<input name="no" type="text" placeholder="No"/>
					</p></div>
					<div class="grid_2"><p>
						<input name="tanggal" type="text" id="datepicker" placeholder="Tanggal" required/>
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
					<div class="grid_1"><p>
						<input name="fun" type="hidden" value="<?php if(isset($key)) echo $key; else echo 'page';?>"/>
						<input type="submit" value="Submit"/>
					</p></div>
				</form>

				
				<div class="grid_9">
					<p>&nbsp;</p>
				</div>
				<form method='POST' action='<?=base_url();?>kontainer/search'>
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
						<button class="error">Download</button>
					</p>
				</div>


				<div class="grid_16">
					<table id="dataList" clas="tablesorter">
						<thead>
							<tr>
								<th class='center_column'>No</th>
								<th>Tanggal</th>
								<th>Perusahaan</th>
								<th>Kode Kontainer</th>
								<th>No Kontainer</th>
								<th>Ukuran</th>
								<th class='center_column' colspan="3" width="10%">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($rows as $row){
								extract($row);
								$tgl = explode('-', $tanggal);
								$tanggal = $tgl[1].'/'.$tgl[2].'/'.$tgl[0];

								$back_url = urlencode(base_url()."kontainer/page/".$page);
								if(isset($key)) $back_url = urlencode(base_url()."kontainer/search?key=".$key."&page=".$page);
								$delete = base_url()."kontainer/delete/".$no."?back_url=$back_url";
								echo "
									<tr>
										<td id='col_no_$no' class='center_column'>$no</td>
										<td id='col_tanggal_$no'>$tanggal</td>
										<td id='col_perusahaan_$no'>$perusahaan</td>
										<td id='col_kode_$no'>$kode</td>
										<td id='col_nomor_$no'>$nomor</td>
										<td id='col_ukuran_$no'>$ukuran</td>
										<td id='col_ip_$no' class='center_column'><a href='#' class='ip'></a></td>
										<td id='col_edit_$no' class='center_column'><a href='#' onclick=\"edit_row('$no')\" class='edit'></a></td>
										<td id='col_delete_$no' class='center_column'><a href='$delete' class='delete'></a></td>
									</tr>
								";
							}
							?>
						</tbody>
						<tfoot>
							<tr><td>&nbsp;</td><tr>
							<tr>
								<td colspan="9" class="pagination">
									<?php 
										$prev = $page-1;
										$next = $page+1;

										if($maxpage > 10 && $page > 5){
											if(isset($key)) echo "<a href='".base_url()."kontainer/search?key=$key&page=$prev' class='curved'>Prev</a>";
											else echo "<a href='".base_url()."kontainer/page/$prev' class='curved'>Prev</a>";
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
												if(isset($key)) echo "<a href='".base_url()."kontainer/search?key=$key&page=$i' class='curved'>$i</a>";
												else echo "<a href='".base_url()."kontainer/page/$i' class='curved'>$i</a>";
											}
										}

										if($maxpage > 10 && $page+5 < $maxpage){
											if(isset($key)) echo "<a href='".base_url()."kontainer/search?key=$key&page=$next' class='curved'>Next</a>";
											else echo "<a href='".base_url()."kontainer/page/$next' class='curved'>Next</a>";
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
		$("#datepicker3").datepicker();
	});

	function edit_row(no)
	{
		var val_tanggal = $("#col_tanggal_"+no).html();
		var val_perusahaan = $("#col_perusahaan_"+no).html();
		var val_kode = $("#col_kode_"+no).html();
		var val_nomor = $("#col_nomor_"+no).html();
		var val_ukuran = $("#col_ukuran_"+no).html();

		val_ukuran = val_ukuran.replace("\"","");

		var input_tanggal = "<input id='input_tanggal_"+no+"' name='tanggal' type='text' class='datepicker_"+no+"' value='"+val_tanggal+"' style='width:80px;'/>";
		var input_perusahaan = "<select id='input_perusahaan_"+no+"' name='perusahaan' style='width:150px;'> <option value='-'>[Pilih Perusahaan]</option>" + 
									<?php
									echo "\"";
									foreach($list_perusahaan as $per){
										$nama = $per['nama'];
										echo "<option value='$nama'>$nama</option>";
									}
									echo "\"";
									?>
								+ "</select>";
		var input_kode = "<input id='input_kode_"+no+"' name='kode' type='text' value='"+val_kode+"' style='width:100px;'/>";
		var input_nomor = "<input id='input_nomor_"+no+"' name='nomor' type='text' value='"+val_nomor+"' style='width:100px;'/>";
		var input_ukuran = "<select id='input_perusahaan_"+no+"' name='ukuran' style='width:100px;'>" +
									"<option value='-'>[Pilih Ukuran]</option>" +
									"<option value='10\"'>10\"</option>" +
									"<option value='20\"'>20\"</option>" +
									"<option value='40\"'>40\"</option>" +
									"<option value='50\"'>50\"</option>" +
									"<option value='60\"'>60\"</option>" +
								"</select>";
		var save_button = "<input class='center_column' type='submit' value='S' onclick=\"save_row('"+no+"')\"/>";
		var cancel_button = "<input  class='center_column' type='submit' value='C' onclick=\"cancel_row('"+no+"','"+val_tanggal+"','"+val_perusahaan+"','"+val_kode+"','"+val_nomor+"','"+val_ukuran+"')\"/>";
		
		$("#col_tanggal_"+no).html(input_tanggal);
		$("#col_perusahaan_"+no).html(input_perusahaan);
		$("#col_kode_"+no).html(input_kode);
		$("#col_nomor_"+no).html(input_nomor);
		$("#col_ukuran_"+no).html(input_ukuran);
		$("#col_ip_"+no).html(save_button);
		$("#col_edit_"+no).html(cancel_button);
		$("#col_delete_"+no).html("");
		$(".datepicker_"+no).datepicker();
	}

	function save_row(no)
	{
		var form_data = {
			no: no,
			tanggal: $("#input_tanggal"+no).val(),
			perusahaan: $("#input_perusahaan"+no).val(),
			kode: $("#input_kode"+no).val(),
			nomor: $("#input_nomor"+no).val(),
			ukuran: $("#input_ukuran"+no).val(),
			ajax: '1'
		};

		$.ajax({
			url: "<?=site_url('kontainer/update');?>",
			type: "POST",
			data: form_data,
			success: function(msg){
				alert(msg);
				//$.fancybox.close();
			}
		});
	}

	function cancel_row(no, tanggal, perusahaan, kode, nomor, ukuran)
	{
		<?php
		$back_url = urlencode(base_url()."kontainer/page/".$page);
		if(isset($key)) $back_url = urlencode(base_url()."kontainer/search?key=".$key."&page=".$page);
		$delete = base_url()."kontainer/delete/".$no."?back_url=$back_url";	
		?>

		$("#col_tanggal_"+no).html(tanggal);
		$("#col_perusahaan_"+no).html(perusahaan);
		$("#col_kode_"+no).html(kode);
		$("#col_nomor_"+no).html(nomor);
		$("#col_ukuran_"+no).html(ukuran + ((ukuran == "-") ? "" : "\""));
		$("#col_ip_"+no).html("<a href='#' class='ip'></a>");
		$("#col_edit_"+no).html("<a href='#' onclick=\"edit_row('"+no+"')\" class='edit'></a>");
		$("#col_delete_"+no).html("<a href='<?=$delete;?>' class='delete'></a>");
	}

	function tes()
	{
		alert('tes');
	}
	
</script>



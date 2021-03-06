<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sistem Pendataan Kontainer</title>

		<link rel="stylesheet" href="<?=base_url();?>application/css/960.css" type="text/css" media="screen" charset="utf-8"/>
		<link rel="stylesheet" href="<?=base_url();?>application/css/template.css" type="text/css" media="screen" charset="utf-8"/>
		<link rel="stylesheet" href="<?=base_url();?>application/css/colour.css" type="text/css" media="screen" charset="utf-8"/>
 		<link rel="stylesheet" href="<?=base_url();?>application/js/jqtp_latest/css/jqtp.css" type="text/css"/>
		<link rel="stylesheet" href="<?=base_url();?>application/js/jqtp_latest/css/jqpopup.css" type="text/css">
		<link rel="stylesheet" href="<?=base_url();?>application/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen"/>

		<script src="<?=base_url();?>application/js/jquery-1.4.2.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jquery-ui-1.8.1.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jquery.tablesorter.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jqtp_latest/js/jquery.jqtp.min.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jqtp_latest/js/jquery.bgiframe.min.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jqtp_latest/js/jqDnR.min.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jqtp_latest/js/jquery.jqpopup.min.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript"></script>
	</head>
	<body>
		<header id="header">
			<?php 
				$data['active'] = 2;
				$this->load->view('header', $data); 
			?>
		</header>

		<section id="section">
			<div id="content" class="container_16 clearfix">
				<form method="post" action="<?=site_url('pemeriksaan/entry')?>">
					<div class="grid_2"><p>
						<input name="no_bap" type="text" placeholder="No BAP" required style="width:60px;float:left;"/>
					</p></div>
					<div class="grid_2" style="margin-left:-20px;"><p>
						<input name="tanggal_bap" type="text" id="datepicker" placeholder="Tanggal BAP" pattern="((19|20)\d\d[/]0[1-9]|1[012])[/](0[1-9]|[12][0-9]|3[01])" required/>
					</p></div>
					<div class="grid_4"><p>
						<select name="perusahaan" required>
							<option value='-'>[Pilih Perusahaan]</option>
							<?php
							foreach($list_perusahaan as $perusahaan){
								extract($perusahaan);
								echo "<option value='$kode'>$kode</option>";
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
					<div class="grid_3"><p>
						<select name="ukuran">
							<option value='-'>[Pilih Ukuran]</option>
							<?php
							foreach($list_ukuran as $ukuran){
								extract($ukuran);
								echo "<option value='$ukuran'>$ukuran</option>";
							}
							?>
						</select>
					</p></div>
					<div class="grid_2"><p>
						<input name="jam_ip" type="text" placeholder="Jam IP" id="jam_ip" class="timepicker" required style="width:40px;float:left;text-align:center;"/>
					</p></div>
					<div class="grid_6"></div>
					<div class="grid_2" style="padding-top:6px;margin-left:-1px;">Jam Periksa :</div>
					<div class="grid_2"><p>
						<input name="jam_periksa_st" type="text" placeholder="Mulai" id="jam_periksa_st" class="timepicker" required style="width:40px;margin-left:-20px;float:left;text-align:center;"/>
					</p></div>
					<div class="grid_1" style="padding-top:6px;margin-left:-90px;">-</div>
					<div class="grid_1"><p>
						<input name="jam_periksa_en" type="text" placeholder="Selesai" id="jam_periksa_en" class="timepicker" required style="width:44px;margin-left:-70px;float:left;text-align:center;"/>
					</p></div>
					<div class="grid_3" style="margin-left:-40px;"><p>
						<input name="uraian" type="text" placeholder="Uraian Barang" required/>
					</p></div>
					<div class="grid_4" style="margin-left:20px;"><p>
						<select name="pemeriksa">
							<option value='-'>[Pilih Pemeriksa]</option>
							<?php
							foreach($list_pemeriksa as $pemeriksa){
								extract($pemeriksa);
								echo "<option value='$nama'>$nama</option>";
							}
							?>
						</select>
					</p></div>
					<div class="grid_2"><p>
						<input name="tgl_sppb" type="text" id="datepicker3" placeholder="Tgl SPPB" required/>
					</p></div>
					<div class="grid_1"><p>
						<input name="fun" type="hidden" value="<?php if(isset($key)) echo $key; else echo 'page';?>"/>
						<input type="submit" value="Submit"/>
					</p></div>
				</form>

				<div class="grid_16">
					<p>&nbsp;</p>
				</div>

				<form method='POST' action='<?=base_url();?>pemeriksaan/search'>
					<div class="grid_5" style="margin-left:-35px;margin-top:30px;">
						<p>
							<input type="text" name='search' placeholder="Search Table"/>
						</p>
					</div>
					<div class="grid_1" style="margin-top:30px;">
						<p>
							<input type="submit" value="Search" />
						</p>
					</div>
				</form>

				<div class="grid_1" style="margin-right:45px;margin-top:30px;">
					<p>
						<a href='#download_filter' class='download error'>Download#1</a>
					</p>
				</div>
				<div class="grid_1" style="margin-top:30px;">
					<p>
						<a href='#download_filter2' class='download2 error'>Download#2</a>
					</p>
				</div>

				<div class="grid_16">
					<table id="dataList2" clas="tablesorter">
						<colgroup>
							<col class="colA" style="width:35px; word-wrap:break-word;"/>
							<col class="colAa" style="width:35px; word-wrap:break-word;"/>
							<col class="colB" style="width:60px; word-wrap:break-word;"/>
							<col class="colC" style="width:80px; word-wrap:break-word;"/>
							<col class="colD" style="width:50px; word-wrap:break-word;"/>
							<col class="colE" style="width:60px; word-wrap:break-word;"/>
							<col class="colF" style="width:50px; word-wrap:break-word;"/>
							<col class="colG" style="width:50px; word-wrap:break-word;"/>
							<col class="colH" style="width:45px; word-wrap:break-word;"/>
							<col class="colI" style="width:50px; word-wrap:break-word;"/>
							<col class="colJ" style="width:40px; word-wrap:break-word;"/>
							<col class="colK" style="width:50px; word-wrap:break-word;"/>
							<col class="colL" style="width:90px; word-wrap:break-word;"/>
							<col class="colM" style="width:70px; word-wrap:break-word;"/>
							<col class="colN" style="width:60px; word-wrap:break-word;"/>
							<col class="colO" style="width:25px; word-wrap:break-word;"/>
							<col class="colP" style="width:25px; word-wrap:break-word;"/>
							<col class="colQ" style="width:25px; word-wrap:break-word;"/>
						</colgroup>
						<thead>
							<tr>
								<th rowspan="2">No</th>
								<th rowspan="2">No BAP</th>
								<th class='center' rowspan="2">Tanggal BAP</th>
								<th rowspan="2">Perusahaan</th>
								<th rowspan="2">No. PIB</th>
								<th class='center' rowspan="2">Tgl PIB</th>
								<th rowspan="2">Kode Kontainer</th>
								<th rowspan="2">Nomor Kontainer</th>
								<th class='center' rowspan="2">Ukuran</th>
								<th class='center' rowspan="2">Jam IP</th>
								<th class='center' colspan="2">Jam Periksa</th>
								<th rowspan="2">Uraian Barang</th>
								<th rowspan="2">Pemeriksa</th>
								<th rowspan="2">Tgl SPPB</th>
								<th class='center' colspan="3" width="10%" rowspan="2">Actions</th>
							</tr>
							<tr>
								<th class="center">Mulai</th>
								<th class="center">Selesai</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($rows as $row){
								extract($row);
								$tanggal_bap = str_replace("-", "/", $tanggal_bap);
								$tgl_pib = str_replace("-", "/", $tgl_pib);
								$tgl_sppb = str_replace("-", "/", $tgl_sppb);
								$jam_ip = substr($jam_ip, 0, strlen($jam_ip)-3);
								$jam_periksa_st = substr($jam_periksa_st, 0, strlen($jam_periksa_st)-3);
								$jam_periksa_en = substr($jam_periksa_en, 0, strlen($jam_periksa_en)-3);

								echo "
									<tr>
										<td id='col_no_$no' style='text-align:left;'>$no</td>
										<td id='col_no_bap_$no' class='center'>$no_bap</td>
										<td id='col_tanggal_$no' class='center'>$tanggal_bap</td>
										<td id='col_perusahaan_$no'>$perusahaan</td>
										<td id='col_no_pib_$no'>$no_pib</td>
										<td id='col_tgl_pib_$no' class='center'>$tgl_pib</td>
										<td id='col_kode_$no'>$kode</td>
										<td id='col_nomor_$no'>$nomor</td>
										<td id='col_ukuran_$no' class='center'>$ukuran</td>
										<td id='col_jam_ip_$no' class='center'>$jam_ip</td>
										<td id='col_jam_periksa_st_$no' class='center'>$jam_periksa_st</td>
										<td id='col_jam_periksa_en_$no' class='center'>$jam_periksa_en</td>
										<td id='col_uraian_$no'>$uraian</td>
										<td id='col_pemeriksa_$no'>$pemeriksa</td>
										<td id='col_tgl_sppb_$no'>$tgl_sppb</td>
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

				<div id="download_hider" style="display:none;">
					<div id="download_filter">
						<div class="grid_2"><p>
							<input id="dw_tanggal_bap" type="text" class="datepicker3" placeholder="Tanggal BAP"/>
						</p></div>
						<div class="grid_2"><p>
							<input id="dw_tanggal_sppb" type="text" class="datepicker4" placeholder="Tanggal SPPB"/>
						</p></div>
						<div class="grid_4" style="margin-left:20px;"><p>
							<select id="dw_perusahaan" style="width:140px;">
								<option value=''>[Pilih Perusahaan]</option>
								<?php
								foreach($list_perusahaan as $perusahaan){
									extract($perusahaan);
									echo "<option value='$kode'>$kode</option>";
								} 
								?>
							</select>
						</p></div>
						<div class="grid_4" style="margin-left:20px;"><p>
							<select id="dw_pemeriksa" style="width:140px;">
								<option value=''>[Pilih Pemeriksa]</option>
								<?php
								foreach($list_pemeriksa as $pemeriksa){
									extract($pemeriksa);
									echo "<option value='$nama'>$nama</option>";
								}
								?>
							</select>
						</p></div>
						<div class="grid_1"><p>
							<input id="dw_submit" type="submit" value="Download"/>
						</p></div>
					</div>
				</div>

				<div id="download_hider2" style="display:none;">
					<div id="download_filter2">
						<div class="grid_2"><p>
							<input id="dw2_tanggal_masuk" type="text" class="datepicker3" placeholder="Tanggal Masuk"/>
						</p></div>
						<div class="grid_2"><p>
							<input id="dw2_tanggal_bap" type="text" class="datepicker3" placeholder="Tanggal BAP"/>
						</p></div>
						<div class="grid_2"><p>
							<input id="dw2_tanggal_sppb" type="text" class="datepicker4" placeholder="Tanggal SPPB"/>
						</p></div>
						<div class="grid_4" style="margin-left:20px;"><p>
							<select id="dw2_perusahaan" style="width:140px;">
								<option value=''>[Pilih Perusahaan]</option>
								<?php
								foreach($list_perusahaan as $perusahaan){
									extract($perusahaan);
									echo "<option value='$kode'>$kode</option>";
								} 
								?>
							</select>
						</p></div>
						<div class="grid_4" style="margin-left:20px;"><p>
							<select id="dw2_pemeriksa" style="width:140px;">
								<option value=''>[Pilih Pemeriksa]</option>
								<?php
								foreach($list_pemeriksa as $pemeriksa){
									extract($pemeriksa);
									echo "<option value='$nama'>$nama</option>";
								}
								?>
							</select>
						</p></div>
						<div class="grid_1"><p>
							<input id="dw2_submit" type="submit" value="Download"/>
						</p></div>
					</div>
				</div>
			</div>
		</section>

		<div id="jqtp_clockDiv" style="display:none;padding:10px;" title="Time Picker">
		    <table>
				<tr>
					<td style="text-align:center;">
						<div id="jqtp_clock"></div>
					</td>
				</tr>
				<tr>
					<td style="text-align:center;">
						<input type="text" id="jqtp_clock_hr" style="width:20px;text-align:center;"/>:
						<input type="text" id="jqtp_clock_min" style="width:20px;text-align:center"/>
					</td>
				</tr>
				<tr>
					<td style="text-align:center;">
						<input type="button" id="pick" value="Pick"/>
						<input type="button" id="now" value="Now"/>
					</td>
				</tr>
		    </table>
		    <input type="hidden" id="hour"/>
			<input type="hidden" id="min"/>
		</div>

		<footer></footer>
	</body>
</html>

<script>
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

	var isJqtpOpen = false;

	$(document).ready(function(){ 
		// table sorter
        $("#dataList2").tablesorter(); 

        // datepicker
        $("#datepicker").datepicker();
		$("#datepicker2").datepicker();
		$("#datepicker3").datepicker();
		$(".datepicker3").datepicker();
		$(".datepicker4").datepicker();

		$("a.download").fancybox({
			overlayShow	: true,
			transitionIn : 'elastic',
			transitionOut : 'elastic',
			showCloseButton : false,
			onComplete : function(links, index){
				$("#dw_submit").attr("onclick", "").click(function(){
					var tanggal_bap = $("#dw_tanggal_bap").val();
					var tanggal_sppb = $("#dw_tanggal_sppb").val();
					var perusahaan = $("#dw_perusahaan").val();
					var pemeriksa = $("#dw_pemeriksa").val();

					document.location = "<?=base_url();?>pemeriksaan/download_xls?tanggal_bap=" + tanggal_bap + "&tgl_sppb=" + tanggal_sppb + "&perusahaan=" + perusahaan + "&pemeriksa=" + pemeriksa;
				});
			},
			onClosed : function(){
				$("#dw_tanggal_bap").val("");
				$("#dw_tanggal_sppb").val("");
				$("#dw_perusahaan").val("");
				$("#dw_pemeriksa").val("");
			}
		});

		$("a.download2").fancybox({
			overlayShow	: true,
			transitionIn : 'elastic',
			transitionOut : 'elastic',
			showCloseButton : false,
			onComplete : function(links, index){
				$("#dw2_submit").attr("onclick", "").click(function(){
					var tanggal_masuk = $("#dw2_tanggal_masuk").val();
					var tanggal_bap = $("#dw2_tanggal_bap").val();
					var tanggal_sppb = $("#dw2_tanggal_sppb").val();
					var perusahaan = $("#dw2_perusahaan").val();
					var pemeriksa = $("#dw2_pemeriksa").val();

					document.location = "<?=base_url();?>pemeriksaan/download_xls2?tanggal_bap=" + tanggal_bap + "&tanggal_masuk=" + tanggal_masuk + "&tgl_sppb=" + tanggal_sppb + "&perusahaan=" + perusahaan + "&pemeriksa=" + pemeriksa;
				});
			},
			onClosed : function(){
				$("#dw2_tanggal_masuk").val("");
				$("#dw2_tanggal_bap").val("");
				$("#dw2_tanggal_sppb").val("");
				$("#dw2_perusahaan").val("");
				$("#dw2_pemeriksa").val("");
			}
		});

		// timepicker
        $("#jqtp_clock").jqtp();
		$("#jqtp_clock").jqtp_realtime();

		$("#jam_ip").focus(function() {
			if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
			isJqtpOpen = true;

			$("#jam_ip").jqtp_object();

			if($("#jam_ip").val() == "") $("#jqtp_clock").jqtp_realtime();
			else{
				var tm = $("#jam_ip").val().split(":");
				$("#jqtp_clock_hr").attr("value", tm[0]);
				$("#jqtp_clock_min").attr("value", tm[1]);
			}

			$("#jqtp_clockDiv").jqpopup_open(this.id);
		});

		$("#jam_periksa_st").focus(function() {
			if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
			isJqtpOpen = true;

			$("#jam_periksa_st").jqtp_object();

			if($("#jam_periksa_st").val() == "") $("#jqtp_clock").jqtp_realtime();
			else{
				var tm = $("#jam_periksa_st").val().split(":");
				$("#jqtp_clock_hr").attr("value", tm[0]);
				$("#jqtp_clock_min").attr("value", tm[1]);
			}

			$("#jqtp_clockDiv").jqpopup_open(this.id);
		});

		$("#jam_periksa_en").focus(function() {
			if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
			isJqtpOpen = true;

			$("#jam_periksa_en").jqtp_object();

			if($("#jam_periksa_en").val() == "") $("#jqtp_clock").jqtp_realtime();
			else{
				var tm = $("#jam_periksa_en").val().split(":");
				$("#jqtp_clock_hr").attr("value", tm[0]);
				$("#jqtp_clock_min").attr("value", tm[1]);
			}

			$("#jqtp_clockDiv").jqpopup_open(this.id);
		});

		$("#now").click(function(){
			$("#jqtp_clock").jqtp_realtime();
		});

		$("#pick").click(function(){
			$("#jqtp_clock").jqtp_getTime();
			$("#jqtp_clockDiv").jqpopup_close(this.id);
			$("#jqtp_clock").jqtp_realTime();
			isJqtpOpen = false;
		});
	});

	$(document).click(function(){
		if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
	});
	$("#jqtp_clockDiv").click(function(){
		return false;
	});
	$(".timepicker").click(function(){
		return false;
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
		var val_no = $("#col_no_"+no).html();
		var val_no_bap = $("#col_no_bap_"+no).html();
		var val_tanggal = $("#col_tanggal_"+no).html();
		var val_perusahaan = $("#col_perusahaan_"+no).html();
		var val_no_pib = $("#col_no_pib_"+no).html();
		var val_tgl_pib = $("#col_tgl_pib_"+no).html();
		var val_kode = $("#col_kode_"+no).html();
		var val_nomor = $("#col_nomor_"+no).html();
		var val_ukuran = $("#col_ukuran_"+no).html();
		var val_jam_ip = $("#col_jam_ip_"+no).html();
		var val_jam_periksa_st = $("#col_jam_periksa_st_"+no).html();
		var val_jam_periksa_en = $("#col_jam_periksa_en_"+no).html();
		var val_uraian = $("#col_uraian_"+no).html();
		var val_pemeriksa = $("#col_pemeriksa_"+no).html();
		var val_tgl_sppb = $("#col_tgl_sppb_"+no).html();
		var val_status = $("#col_status_"+no).html();

		val_ukuran = val_ukuran.replace("\"","");

		var input_no = "<input id='input_no_"+no+"' name='no' value='"+val_no+"' type='text' style='width:30px; height:14px; vertical-align:middle;' disabled/>";
		var input_no_bap = "<input id='input_no_bap_"+no+"' name='no_bap' value='"+val_no_bap+"' type='text' style='width:40px; height:14px; vertical-align:middle;'/>";
		var input_tanggal = "<input id='input_tanggal_"+no+"' name='tanggal' type='text' class='datepicker_"+no+"' value='"+val_tanggal+"' style='width:65px; height:14px; vertical-align:middle;'/>";
		var input_perusahaan = "<select id='input_perusahaan_"+no+"' name='perusahaan' style='width:100px; height:25px; vertical-align:middle;'>" + 
									"<option value='-'>[Pilih Perusahaan]</option>" + 
									<?php
									echo "\"";
									foreach($list_perusahaan as $perusahaan){
										extract($perusahaan);
										echo "<option value='$kode'>$kode</option>";
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
								<?php
								echo "\"";
								foreach($list_ukuran as $ukuran){
									extract($ukuran);
									$ukuran = str_replace("\"", "", $ukuran);
									echo "<option value='$ukuran\\\"'>$ukuran\\\"</option>";
								}
								echo "\"";
								?>
							+ "</select>";
		var input_jam_ip = "<input id='input_jam_ip_"+no+"' class='timepicker' name='jam_ip' type='text' value='"+val_jam_ip+"' style='width:40px; height:14px; text-align:center; vertical-align:middle;'/>";
		var input_jam_periksa_st = "<input id='input_jam_periksa_st_"+no+"' class='timepicker' name='jam_periksa_st' type='text' value='"+val_jam_periksa_st+"' style='width:40px; height:14px; text-align:center; vertical-align:middle; margin-left:-10px;'/>";
		var input_jam_periksa_en = "<input id='input_jam_periksa_en_"+no+"' class='timepicker' name='jam_periksa_en' type='text' value='"+val_jam_periksa_en+"' style='width:40px; height:14px; text-align:center; vertical-align:middle; margin-left:-5px;'/>";
		var input_uraian = "<input id='input_uraian_"+no+"' name='uraian' type='text' value='"+val_uraian+"' style='width:100px; height:14px; vertical-align:middle;'/>";
		var input_pemeriksa = "<select id='input_pemeriksa_"+no+"' name='pemeriksa' style='width:80px; height:25px; vertical-align:middle; text-align:center;'>" +
								"<option value='-'>[Pilih Pemeriksa]</option>" +
								<?php
								echo "\"";
								foreach($list_pemeriksa as $pemeriksa){
									extract($pemeriksa);
									echo "<option value='$nama'>$nama</option>";
								}
								echo "\"";
								?>
							+ "</select>";
		var input_tgl_sppb = "<input id='input_tgl_sppb_"+no+"' name='tgl_sppb' type='text' class='datepicker3_"+no+"' value='"+val_tgl_sppb+"' style='width:65px; height:14px; vertical-align:middle;'/>";
		var save_button = "<a href='#' onclick=\"save_row('"+no+"')\" class='save'></a>";
		var cancel_button = "<a href='#' onclick=\"cancel_row('"+no+"','"+val_no_bap+"','"+val_tanggal+"','"+val_perusahaan+"','"+val_no_pib+"','"+val_tgl_pib+"','"+val_kode+"','"+val_nomor+"','"+val_ukuran+"','"+val_jam_ip+"','"+val_jam_periksa_st+"','"+val_jam_periksa_en+"','"+val_uraian+"','"+val_pemeriksa+"','"+val_tgl_sppb+"','"+val_status+"')\" class='cancel'></a>";
		
		$("#col_no_"+no).html(input_no);
		$("#col_no_bap_"+no).html(input_no_bap);
		$("#col_tanggal_"+no).html(input_tanggal);
		$("#col_perusahaan_"+no).html(input_perusahaan);
		$("#col_no_pib_"+no).html(input_no_pib);
		$("#col_tgl_pib_"+no).html(input_tgl_pib);
		$("#col_kode_"+no).html(input_kode);
		$("#col_nomor_"+no).html(input_nomor);
		$("#col_ukuran_"+no).html(input_ukuran);
		$("#col_jam_ip_"+no).html(input_jam_ip);
		$("#col_jam_periksa_st_"+no).html(input_jam_periksa_st);
		$("#col_jam_periksa_en_"+no).html(input_jam_periksa_en);
		$("#col_uraian_"+no).html(input_uraian);
		$("#col_pemeriksa_"+no).html(input_pemeriksa);
		$("#col_tgl_sppb_"+no).html(input_tgl_sppb);
		$("#col_sppb_"+no).html(save_button);
		$("#col_edit_"+no).html(cancel_button);
		$("#col_delete_"+no).html("");

		$("#dataList tr").css('height', '32px');
		$(".datepicker_"+no).datepicker();
		$(".datepicker2_"+no).datepicker();
		$(".datepicker3_"+no).datepicker();
		$("#input_ukuran_"+no).val(val_ukuran+"\"");
		$("#input_perusahaan_"+no).val(val_perusahaan);
		$("#input_pemeriksa_"+no).val(val_pemeriksa);

		// timepicker
        $("#jqtp_clock").jqtp();
		$("#jqtp_clock").jqtp_realtime();

		$("#input_jam_ip_"+no).focus(function() {
			if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
			isJqtpOpen = true;

			$("#input_jam_ip_"+no).jqtp_object();

			if($("#input_jam_ip_"+no).val() == "") $("#jqtp_clock").jqtp_realtime();
			else{
				var tm = $("#input_jam_ip_"+no).val().split(":");
				$("#jqtp_clock_hr").attr("value", tm[0]);
				$("#jqtp_clock_min").attr("value", tm[1]);
			}

			$("#jqtp_clockDiv").jqpopup_open(this.id);
		});

		$("#input_jam_periksa_st_"+no).focus(function() {
			if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
			isJqtpOpen = true;

			$("#input_jam_periksa_st_"+no).jqtp_object();

			if($("#input_jam_periksa_st_"+no).val() == "") $("#jqtp_clock").jqtp_realtime();
			else{
				var tm = $("#input_jam_periksa_st_"+no).val().split(":");
				$("#jqtp_clock_hr").attr("value", tm[0]);
				$("#jqtp_clock_min").attr("value", tm[1]);
			}

			$("#jqtp_clockDiv").jqpopup_open(this.id);
		});

		$("#input_jam_periksa_en_"+no).focus(function() {
			if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
			isJqtpOpen = true;

			$("#input_jam_periksa_en_"+no).jqtp_object();

			if($("#input_jam_periksa_en_"+no).val() == "") $("#jqtp_clock").jqtp_realtime();
			else{
				var tm = $("#input_jam_periksa_en_"+no).val().split(":");
				$("#jqtp_clock_hr").attr("value", tm[0]);
				$("#jqtp_clock_min").attr("value", tm[1]);
			}

			$("#jqtp_clockDiv").jqpopup_open(this.id);
		});

		$("#now").click(function(){
			$("#jqtp_clock").jqtp_realtime();
		});

		$("#pick").click(function(){
			$("#jqtp_clock").jqtp_getTime();
			$("#jqtp_clockDiv").jqpopup_close(this.id);
			$("#jqtp_clock").jqtp_realTime();
			isJqtpOpen = false;
		});

		$(document).click(function(){
			if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
		});
		$("#jqtp_clockDiv").click(function(){
			return false;
		});
		$(".timepicker").click(function(){
			return false;
		});
	}

	function save_row(no)
	{
		var form_data = {
			no: no,
			no_bap: $("#input_no_bap_"+no).val(),
			tanggal_bap: $("#input_tanggal_"+no).val(),
			perusahaan: $("#input_perusahaan_"+no).val(),
			no_pib: $("#input_no_pib_"+no).val(),
			tgl_pib: $("#input_tgl_pib_"+no).val(),
			kode: $("#input_kode_"+no).val(),
			nomor: $("#input_nomor_"+no).val(),
			ukuran: $("#input_ukuran_"+no).val(),
			jam_ip: $("#input_jam_ip_"+no).val(),
			jam_periksa_st: $("#input_jam_periksa_st_"+no).val(),
			jam_periksa_en: $("#input_jam_periksa_en_"+no).val(),
			uraian: $("#input_uraian_"+no).val(),
			pemeriksa: $("#input_pemeriksa_"+no).val(),
			tgl_sppb: $("#input_tgl_sppb_"+no).val(),
			ajax: '1'
		};

		var parts = form_data.tanggal_bap.split("/");
		var thn = parseInt(parts[0]);
		var bln = parseInt(parts[1]);
		var tgl = parseInt(parts[2]);

		parts = form_data.tgl_pib.split("/");
		var thn2 = parseInt(parts[0]);
		var bln2 = parseInt(parts[1]);
		var tgl2 = parseInt(parts[2]);

		parts = form_data.tgl_sppb.split("/");
		var thn3 = parseInt(parts[0]);
		var bln3 = parseInt(parts[1]);
		var tgl3 = parseInt(parts[2]);

		if(bln >= 1 && bln <= 12 && tgl >= 1 && tgl <= 31 && thn >= 1900 && thn <= 2999 && bln2 >= 1 && bln2 <= 12 && tgl2 >= 1 && tgl2 <= 31 && thn2 >= 1900 && thn2 <= 2999 && bln3 >= 1 && bln3 <= 12 && tgl3 >= 1 && tgl3 <= 31 && thn3 >= 1900 && thn3 <= 2999){
			$.ajax({
				url: "<?=site_url('pemeriksaan/update');?>",
				type: "POST",
				data: form_data,
				success: function(){
					var status = $("#col_status_"+no).html();

					$("#col_no_"+no).html(form_data.no);
					$("#col_no_bap_"+no).html(form_data.no_bap);
					$("#col_tanggal_"+no).html(form_data.tanggal_bap);
					$("#col_perusahaan_"+no).html(form_data.perusahaan);
					$("#col_no_pib_"+no).html(form_data.no_pib);
					$("#col_tgl_pib_"+no).html(form_data.tgl_pib);
					$("#col_kode_"+no).html(form_data.kode);
					$("#col_nomor_"+no).html(form_data.nomor);
					$("#col_ukuran_"+no).html(form_data.ukuran);
					$("#col_jam_ip_"+no).html(form_data.jam_ip);
					$("#col_jam_periksa_st_"+no).html(form_data.jam_periksa_st);
					$("#col_jam_periksa_en_"+no).html(form_data.jam_periksa_en);
					$("#col_uraian_"+no).html(form_data.uraian);
					$("#col_pemeriksa_"+no).html(form_data.pemeriksa);
					$("#col_tgl_sppb_"+no).html(form_data.tgl_sppb);
					if(status == '1') $("#col_sppb_"+no).html("<a href='#' onclick=\"sppb_submit('"+no+"')\" class='sppb' no='"+no+"'></a></td>");
					else $("#col_sppb_"+no).html("<a href='#' class='sppbyes'></a></td>");
					$("#col_edit_"+no).html("<a href='#' onclick=\"edit_row('"+no+"')\" class='edit'></a>");
					$("#col_delete_"+no).html("<a href='#' onclick=\"confirm_delete_row('"+no+"')\" class='trash'></a>");
				}
			});
		}else{
			alert("Invalid Date!");
		}
	}

	function cancel_row(no, no_bap, tanggal, perusahaan, no_pib, tgl_pib, kode, nomor, ukuran, jam_ip, jam_periksa_st, jam_periksa_en, uraian, pemeriksa, tgl_sppb, status)
	{
		$("#col_no_"+no).html(no);
		$("#col_no_bap_"+no).html(no_bap);
		$("#col_tanggal_"+no).html(tanggal);
		$("#col_perusahaan_"+no).html(perusahaan);
		$("#col_no_pib_"+no).html(no_pib);
		$("#col_tgl_pib_"+no).html(tgl_pib);
		$("#col_kode_"+no).html(kode);
		$("#col_nomor_"+no).html(nomor);
		$("#col_ukuran_"+no).html(ukuran + "\"");
		$("#col_jam_ip_"+no).html(jam_ip);
		$("#col_jam_periksa_st_"+no).html(jam_periksa_st);
		$("#col_jam_periksa_en_"+no).html(jam_periksa_en);
		$("#col_uraian_"+no).html(uraian);
		$("#col_pemeriksa_"+no).html(pemeriksa);
		$("#col_tgl_sppb_"+no).html(tgl_sppb);
		if(status == '1') $("#col_sppb_"+no).html("<a href='#' onclick=\"sppb_submit('"+no+"')\" class='sppb' no='"+no+"'></a></td>");
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



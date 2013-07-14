<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sistem Pendataan Kontainer</title>

		<link rel="stylesheet" href="<?=base_url();?>application/css/960.css" type="text/css" media="screen" charset="utf-8"/>
		<link rel="stylesheet" href="<?=base_url();?>application/css/template.css" type="text/css" media="screen" charset="utf-8"/>
		<link rel="stylesheet" href="<?=base_url();?>application/css/colour.css" type="text/css" media="screen" charset="utf-8"/>
		<link rel="stylesheet" href="<?=base_url();?>application/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="<?=base_url();?>application/js/jqtp_latest/css/jqtp.css" type="text/css"/>
		<link rel="stylesheet" href="<?=base_url();?>application/js/jqtp_latest/css/jqpopup.css" type="text/css">
		
		<script src="<?=base_url();?>application/js/jquery-1.4.2.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jquery-ui-1.8.1.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jquery.tablesorter.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jqtp_latest/js/jquery.jqtp.min.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jqtp_latest/js/jquery.bgiframe.min.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jqtp_latest/js/jqDnR.min.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jqtp_latest/js/jquery.jqpopup.min.js" type="text/javascript"></script>
	</head>
	<body>
		<header id="header">
			<?php 
				$data['active'] = 1;
				$this->load->view('header', $data); 
			?>
		</header>

		<section id="section">
			<div id="content" class="container_16 clearfix">
				<form method="post" action="<?=site_url('kontainer/entry')?>">
					<div class="grid_1"><p>
						<input name="no" type="text" placeholder="No"/>
					</p></div>
					<div class="grid_2"><p>
						<input name="tanggal" type="text" id="datepicker" placeholder="Tanggal" pattern="((19|20)\d\d[/]0[1-9]|1[012])[/](0[1-9]|[12][0-9]|3[01])" required/>
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
						<input name="kode" type="text" placeholder="Kode Kontainer" required/>
					</p></div>
					<div class="grid_2"><p>
						<input name="nomor" type="text" placeholder="Nomer Kontainer" required/>
					</p></div>
					<div class="grid_3"><p>
						<select id="in_ukuran" name="ukuran">
							<option value='-'>[Pilih Ukuran]</option>
							<?php
							foreach($list_ukuran as $ukuran){
								extract($ukuran);
								echo "<option value='$ukuran'>$ukuran</option>";
							}
							?>
						</select>
					</p></div>
					<div class="grid_1"><p>
						<input name="fun" type="hidden" value="<?php if(isset($key)) echo $key; else echo 'page';?>"/>
						<input type="submit" value="Submit"/>
					</p></div>
				</form>

				
				<div class="grid_14">
					<p>&nbsp;</p>
				</div>
				<form method='POST' action='<?=base_url();?>kontainer/search'>
					<div class="grid_5">
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
						$download_url = base_url()."kontainer/download_xls";
						if(isset($key)) $download_url .= "?key=$key";
						?>

						<a href='<?=$download_url;?>' class='error'>Download</a>
					</p>
				</div>


				<div class="grid_16">
					<table id="dataList" clas="tablesorter">
						<colgroup>
							<col class="colA" style="width:20px; word-wrap:break-word;"/>
							<col class="colB" style="width:90px; word-wrap:break-word;"/>
							<col class="colC" style="width:120px; word-wrap:break-word;"/>
							<col class="colD" style="width:100px; word-wrap:break-word;"/>
							<col class="colE" style="width:100px; word-wrap:break-word;"/>
							<col class="colF" style="width:100px; word-wrap:break-word;"/>
							<col class="colG" style="width:20px; word-wrap:break-word;"/>
							<col class="colH" style="width:20px; word-wrap:break-word;"/>
							<col class="colI" style="width:20px; word-wrap:break-word;"/>
						</colgroup>
						<thead>
							<tr>
								<th>No.</th>
								<th class='center'>Tanggal</th>
								<th>Perusahaan</th>
								<th>Kode Kontainer</th>
								<th>No. Kontainer</th>
								<th class='center'>Ukuran</th>
								<th class='center' colspan="3" width="10%">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($rows as $row){
								extract($row);
								$tanggal = str_replace("-", "/", $tanggal);

								echo "
									<tr>
										<td id='col_no_$no' style='text-align:left;'>$no</td>
										<td id='col_tanggal_$no' class='center'>$tanggal</td>
										<td id='col_perusahaan_$no'>$perusahaan</td>
										<td id='col_kode_$no'>$kode</td>
										<td id='col_nomor_$no'>$nomor</td>
										<td id='col_ukuran_$no' class='center'>$ukuran</td>
										<td id='col_ip_$no' class='center'>";
			   	if($status == '0') echo 	"<a href='#ip_row' class='ip ip_button' no='$no'></a></td>"; 
				else echo 					"<a href='#' class='unip'></a></td>";
				echo "					<td id='col_edit_$no' class='center'><a href='#' onclick=\"edit_row('$no')\" class='edit'></a></td>
										<td id='col_delete_$no' class='center'><a href='#' onclick=\"confirm_delete_row('$no')\" class='trash'></a></td>
									</tr>
									<tr style='display:none'>
										<td id='col_status_$no'>$status</td>
									</tr>
								";
							}
							?>
						</tbody>
						<tfoot>
							<tr><td colspan="9">&nbsp;</td><tr>
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

				<div id="ip_hider" style="display:none;">
					<div id="ip_row">
						<div class="grid_2"><p>
							<input id="ip_no_pib" type="text" placeholder="No. PIB"/>
						</p></div>
						<div class="grid_2"><p>
							<input id="ip_tgl_pib" type="text" class="datepicker3" placeholder="Tgl PIB"/>
						</p></div>
						<div class="grid_2"><p>
							<input id="ip_jam_ip" type="text" placeholder="Jam IP" style="width:40px;text-align:center;"/>
						</p></div>
						<div class="grid_2" style="padding-top:5px;">Jam Periksa :</div>
						<div class="grid_2"><p>
							<input id="ip_jam_periksa_st" type="text" placeholder="Mulai" required style="width:40px;margin-left:-15px;text-align:center;"/>
						</p></div>
						<div class="grid_1" style="padding-top:5px;margin-left:-5px;">-</div>
						<div class="grid_1"><p>
							<input id="ip_jam_periksa_en" type="text" placeholder="Selesai" required style="width:44px;margin-left:-15px;text-align:center;"/>
						</p></div>
						<div class="grid_2"><p>
							<input id="ip_uraian" type="text" placeholder="Uraian Barang"/>
						</p></div>
						<div class="grid_4" style="margin-left:20px;"><p>
							<select id="ip_pemeriksa" style="width:140px;">
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
							<input id="ip_tgl_sppb" type="text" class="datepicker3" placeholder="Tgl SPPB"/>
						</p></div>
						<div class="grid_1"><p>
							<input id="ip_submit" type="submit" value="IP"/>
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
		</div>

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

	var isJqtpOpen = false;

	$(document).ready(function(){ 
        $("#dataList").tablesorter(); 

        $("#datepicker").datepicker();
		$("#datepicker2").datepicker();
		$(".datepicker3").datepicker();

        $("a.ip_button").fancybox({
			overlayShow	: true,
			transitionIn : 'elastic',
			transitionOut : 'elastic',
			showCloseButton : false,
			onComplete : function(links, index){
				var $self = $(links[index]);  
		      	var no = $self.attr('no');  
		      	ip_row(no);
			},
			onClosed : function(){
				$("#ip_no_pib").val("");
				$("#ip_tgl_pib").val("");
				$("#ip_jam_ip").val("");
				$("#ip_jam_periksa_st").val("");
				$("#ip_jam_periksa_en").val("");
				$("#ip_uraian").val("");
				$("#ip_pemeriksa").val("");
				$("#ip_tgl_sppb").val("");

				if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
			}
		});
	});

	function ip_row(no)
	{
		$(".datepicker3").datepicker();
		var fun = function(){
			ip_submit(no);
		}
		$("#ip_submit").attr("onclick", "").click(fun);

		$("#jqtp_clock").jqtp();
		$("#jqtp_clock").jqtp_realtime();

		$("#ip_jam_ip").focus(function() {
			if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
			isJqtpOpen = true;

			$("#ip_jam_ip").jqtp_object();

			if($("#ip_jam_ip").val() == "") $("#jqtp_clock").jqtp_realtime();
			else{
				var tm = $("#ip_jam_ip").val().split(":");
				$("#jqtp_clock_hr").attr("value", tm[0]);
				$("#jqtp_clock_min").attr("value", tm[1]);
			}

			$("#jqtp_clockDiv").jqpopup_open(this.id);
		});

		$("#ip_jam_periksa_st").focus(function() {
			if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
			isJqtpOpen = true;

			$("#ip_jam_periksa_st").jqtp_object();

			if($("#ip_jam_periksa_st").val() == "") $("#jqtp_clock").jqtp_realtime();
			else{
				var tm = $("#ip_jam_periksa_st").val().split(":");
				$("#jqtp_clock_hr").attr("value", tm[0]);
				$("#jqtp_clock_min").attr("value", tm[1]);
			}

			$("#jqtp_clockDiv").jqpopup_open(this.id);
		});

		$("#ip_jam_periksa_en").focus(function() {
			if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
			isJqtpOpen = true;

			$("#ip_jam_periksa_en").jqtp_object();

			if($("#ip_jam_periksa_en").val() == "") $("#jqtp_clock").jqtp_realtime();
			else{
				var tm = $("#ip_jam_periksa_en").val().split(":");
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
			isJqtpOpen = false;
		});
	}

	function ip_submit(no)
	{
		var no_pib = $("#ip_no_pib").val();
		var tgl_pib = $("#ip_tgl_pib").val();
		var jam_ip = $("#ip_jam_ip").val();
		var jam_periksa_st = $("#ip_jam_periksa_st").val();
		var jam_periksa_en = $("#ip_jam_periksa_en").val();
		var uraian = $("#ip_uraian").val();
		var pemeriksa = $("#ip_pemeriksa").val();
		var tgl_sppb = $("#ip_tgl_sppb").val();

		<?php
		$back_url = urlencode(base_url()."kontainer/page/".$page);
		if(isset($key)) $back_url = urlencode(base_url()."kontainer/search?key=".$key."&page=".$page);
		?>

		document.location = "<?=base_url();?>kontainer/ip/"+no+"?no_pib="+no_pib+"&tgl_pib="+tgl_pib+"&jam_ip="+jam_ip+"&jam_periksa_st="+jam_periksa_st+"&jam_periksa_en="+jam_periksa_en+"&uraian="+uraian+"&pemeriksa="+pemeriksa+"&back_url=<?=$back_url;?>"+"&tgl_sppb="+tgl_sppb;
	}

	function edit_row(no)
	{
		var val_tanggal = $("#col_tanggal_"+no).html();
		var val_perusahaan = $("#col_perusahaan_"+no).html();
		var val_kode = $("#col_kode_"+no).html();
		var val_nomor = $("#col_nomor_"+no).html();
		var val_ukuran = $("#col_ukuran_"+no).html();
		var val_status = $("#col_status_"+no).html();

		val_ukuran = val_ukuran.replace("\"","");

		var input_tanggal = "<input id='input_tanggal_"+no+"' name='tanggal' type='text' class='datepicker_"+no+"' value='"+val_tanggal+"' style='width:65px; height:14px; vertical-align:middle;'/>";
		var input_perusahaan = "<select id='input_perusahaan_"+no+"' name='perusahaan' style='width:150px; height:25px; vertical-align:middle;'>" +
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
		var input_kode = "<input id='input_kode_"+no+"' name='kode' type='text' value='"+val_kode+"' style='width:100px; height:14px; vertical-align:middle;'/>";
		var input_nomor = "<input id='input_nomor_"+no+"' name='nomor' type='text' value='"+val_nomor+"' style='width:100px; height:14px; vertical-align:middle;'/>";
		var input_ukuran = "<select id='input_ukuran_"+no+"' name='ukuran' style='width:60px; height:25px; vertical-align:middle;'>" +
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
		var save_button = "<a href='#' onclick=\"save_row('"+no+"')\" class='save'></a>";
		var cancel_button = "<a href='#' onclick=\"cancel_row('"+no+"','"+val_tanggal+"','"+val_perusahaan+"','"+val_kode+"','"+val_nomor+"','"+val_ukuran+"','"+val_status+"')\" class='cancel'></a>";
		
		$("#col_tanggal_"+no).html(input_tanggal);
		$("#col_perusahaan_"+no).html(input_perusahaan);
		$("#col_kode_"+no).html(input_kode);
		$("#col_nomor_"+no).html(input_nomor);
		$("#col_ukuran_"+no).html(input_ukuran);
		$("#col_ip_"+no).html(save_button);
		$("#col_edit_"+no).html(cancel_button);
		$("#col_delete_"+no).html("");

		$("#dataList tr").css('height', '32px');
		$(".datepicker_"+no).datepicker();
		$("#input_ukuran_"+no).val(val_ukuran+"\"");
		$("#input_perusahaan_"+no).val(val_perusahaan);
	}

	function save_row(no)
	{
		var form_data = {
			no: no,
			tanggal: $("#input_tanggal_"+no).val(),
			perusahaan: $("#input_perusahaan_"+no).val(),
			kode: $("#input_kode_"+no).val(),
			nomor: $("#input_nomor_"+no).val(),
			ukuran: $("#input_ukuran_"+no).val(),
			ajax: '1'
		};

		var parts = form_data.tanggal.split("/");
		var thn = parseInt(parts[0]);
		var bln = parseInt(parts[1]);
		var tgl = parseInt(parts[2]);

		if(bln >= 1 && bln <= 12 && tgl >= 1 && tgl <= 31 && thn >= 1900 && thn <= 2999){
			$.ajax({
				url: "<?=site_url('kontainer/update');?>",
				type: "POST",
				data: form_data,
				success: function(){
					var status = $("#col_status_"+no).html();

					$("#col_tanggal_"+no).html(form_data.tanggal);
					$("#col_perusahaan_"+no).html(form_data.perusahaan);
					$("#col_kode_"+no).html(form_data.kode);
					$("#col_nomor_"+no).html(form_data.nomor);
					$("#col_ukuran_"+no).html(form_data.ukuran);
					if(status == '0') $("#col_ip_"+no).html("<a href='#ip_row' class='ip ip_button' no='$no'></a></td>");
					else $("#col_ip_"+no).html("<a href='#' class='unip' no='$no'></a></td>");
					$("#col_edit_"+no).html("<a href='#' onclick=\"edit_row('"+no+"')\" class='edit'></a>");
					$("#col_delete_"+no).html("<a href='#' onclick=\"confirm_delete_row('"+no+"')\" class='trash'></a>");

					$("a.ip_button").fancybox({
						overlayShow	: true,
						transitionIn : 'elastic',
						transitionOut : 'elastic',
						showCloseButton : false,
						onComplete : function(links, index){
							var $self = $(links[index]);  
					      	var no = $self.attr('no');
					      	ip_row(no);
						},
						onClosed : function(){
							$("#ip_no_pib").val("");
							$("#ip_tgl_pib").val("");
							$("#ip_jam_ip").val("");
							$("#ip_jam_periksa_st").val("");
							$("#ip_jam_periksa_en").val("");
							$("#ip_uraian").val("");
							$("#ip_pemeriksa").val("");
							$("#ip_tgl_sppb").val("");

							if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
						}
					});
				}
			});
		}else{
			alert("Invalid Date!");
		}
	}

	function cancel_row(no, tanggal, perusahaan, kode, nomor, ukuran, status)
	{
		$("#col_tanggal_"+no).html(tanggal);
		$("#col_perusahaan_"+no).html(perusahaan);
		$("#col_kode_"+no).html(kode);
		$("#col_nomor_"+no).html(nomor);
		$("#col_ukuran_"+no).html(ukuran + "\"");
		if(status == '0') $("#col_ip_"+no).html("<a href='#ip_row' class='ip ip_button' no='$no'></a></td>");
		else $("#col_ip_"+no).html("<a href='#' class='unip' no='$no'></a></td>");
		$("#col_edit_"+no).html("<a href='#' onclick=\"edit_row('"+no+"')\" class='edit'></a>");
		$("#col_delete_"+no).html("<a href='#' onclick=\"confirm_delete_row('"+no+"')\" class='trash'></a>");

		$("a.ip_button").fancybox({
			overlayShow	: true,
			transitionIn : 'elastic',
			transitionOut : 'elastic',
			showCloseButton : false,
			onComplete : function(links, index){
				var $self = $(links[index]);  
		      	var no = $self.attr('no');  
		      	ip_row(no);
			},
			onClosed : function(){
				$("#ip_no_pib").val("");
				$("#ip_tgl_pib").val("");
				$("#ip_jam_ip").val("");
				$("#ip_jam_periksa_st").val("");
				$("#ip_jam_periksa_en").val("");
				$("#ip_uraian").val("");
				$("#ip_pemeriksa").val("");
				$("#ip_tgl_sppb").val("");

				if(isJqtpOpen) $("#jqtp_clockDiv").jqpopup_close(this.id);
			}
		});
	}

	function confirm_delete_row(no)
	{
		if(confirm('Apakah anda yakin?')){
			<?php
			$back_url = urlencode(base_url()."kontainer/page/".$page);
			if(isset($key)) $back_url = urlencode(base_url()."kontainer/search?key=".$key."&page=".$page);
			?>

			document.location = "<?=base_url();?>kontainer/delete/"+no+"?back_url=<?=$back_url;?>";
		}
	}

	function tes()
	{
		alert('tes');
	}
	
</script>



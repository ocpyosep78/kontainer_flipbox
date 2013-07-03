<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Sistem Pendataan Kontainer</title>

		<link rel="stylesheet" href="<?=base_url();?>application/css/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?=base_url();?>application/css/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?=base_url();?>application/css/colour.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>application/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
		<!--[if IE]><![if gte IE 6]><![endif]-->
		<script src="<?=base_url();?>application/js/jquery-1.4.2.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jquery-ui-1.8.1.js" type="text/javascript"></script>
		<script src="<?=base_url();?>application/js/jquery.tablesorter.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?=base_url();?>application/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	</head>
	<body>
		<header>
			<?php 
				$data['active'] = 4;
				$this->load->view('header', $data); 
			?>
		</header>

		<section id="section">
			<div id="content" class="container_16 clearfix">
				<form method="post" action="<?=site_url('manajemen_pt/entry')?>">
					<div class="grid_3"><p>
						<input name="owner" type="text" placeholder="Nama Owner" required/>
					</p></div>
					<div class="grid_4"><p>
						<input name="nama" type="text" placeholder="Nama Perusahaan" required/>
					</p></div>
					<div class="grid_3"><p>
						<input name="kode" type="text" placeholder="Kode Perusahaan" required/>
					</p></div>
					<div class="grid_1"><p>
						<input name="fun" type="hidden" value="<?php if(isset($key)) echo $key; else echo 'page';?>"/>
						<input type="submit" value="Submit"/>
					</p></div>
				</form>

				
				<div class="grid_9">
					<p>&nbsp;</p>
				</div>
				<form method='POST' action='<?=base_url();?>manajemen_pt/search'>
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
						<colgroup>
							<col class="colA" style="width:80px; word-wrap:break-word;"/>
							<col class="colC" style="width:280px; word-wrap:break-word;"/>
							<col class="colD" style="width:310px; word-wrap:break-word;"/>
							<col class="colE" style="width:200px; word-wrap:break-word;"/>
							<col class="colG" style="width:30px; word-wrap:break-word;"/>
							<col class="colH" style="width:40px; word-wrap:break-word;"/>
						</colgroup>
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Owner</th>
								<th>Nama Perusahaan</th>
								<th>Kode Perusahaan</th>
								<th class='center' colspan="2" width="10%">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($rows as $row){
								extract($row);

								echo "
									<tr>
										<td id='col_no_$no' style='text-align:left;'>$no</td>
										<td id='col_owner_$no'>$owner</td>
										<td id='col_nama_$no'>$nama</td>
										<td id='col_kode_$no'>$kode</td>
										<td id='col_edit_$no' class='center'><a href='#' onclick=\"edit_row('$no')\" class='edit'></a></td>
										<td id='col_delete_$no' class='center'><a href='#' onclick=\"confirm_delete_row('$no')\" class='trash'></a></td>
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
											if(isset($key)) echo "<a href='".base_url()."manajemen_pt/search?key=$key&page=$prev' class='curved'>Prev</a>";
											else echo "<a href='".base_url()."manajemen_pt/page/$prev' class='curved'>Prev</a>";
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
												if(isset($key)) echo "<a href='".base_url()."manajemen_pt/search?key=$key&page=$i' class='curved'>$i</a>";
												else echo "<a href='".base_url()."manajemen_pt/page/$i' class='curved'>$i</a>";
											}
										}

										if($maxpage > 10 && $page+5 < $maxpage){
											if(isset($key)) echo "<a href='".base_url()."manajemen_pt/search?key=$key&page=$next' class='curved'>Next</a>";
											else echo "<a href='".base_url()."manajemen_pt/page/$next' class='curved'>Next</a>";
										}
									?>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>`
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
				$("#ip_jam_periksa").val("");
				$("#ip_uraian").val("");
				$("#ip_pemeriksa").val("");
			}
		});
	});

	$(function(){
		$("#datepicker").datepicker();
		$("#datepicker2").datepicker();
		$(".datepicker3").datepicker();
	});

	function ip_row(no)
	{
		$(".datepicker3").datepicker();
		var fun = function(){
			ip_submit(no);
		}
		$("#ip_submit").attr("onclick", "").click(fun);
	}

	function ip_submit(no)
	{
		var no_pib = $("#ip_no_pib").val();
		var tgl_pib = $("#ip_tgl_pib").val();
		var jam_ip = $("#ip_jam_ip").val();
		var jam_periksa = $("#ip_jam_periksa").val();
		var uraian = $("#ip_uraian").val();
		var pemeriksa = $("#ip_pemeriksa").val();

		<?php
		$back_url = urlencode(base_url()."kontainer/page/".$page);
		if(isset($key)) $back_url = urlencode(base_url()."kontainer/search?key=".$key."&page=".$page);
		?>

		document.location = "<?=base_url();?>kontainer/ip/"+no+"?no_pib="+no_pib+"&tgl_pib="+tgl_pib+"&jam_ip="+jam_ip+"&jam_periksa="+jam_periksa+"&uraian="+uraian+"&pemeriksa="+pemeriksa+"&back_url=<?=$back_url;?>";
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
		var input_kode = "<input id='input_kode_"+no+"' name='kode' type='text' value='"+val_kode+"' style='width:100px; height:14px; vertical-align:middle;'/>";
		var input_nomor = "<input id='input_nomor_"+no+"' name='nomor' type='text' value='"+val_nomor+"' style='width:100px; height:14px; vertical-align:middle;'/>";
		var input_ukuran = "<select id='input_ukuran_"+no+"' name='ukuran' style='width:60px; height:25px; vertical-align:middle; text-align:center;'>" +
								"<option value='-'>[Pilih Ukuran]</option>" +
								"<option value='10\"'>10\"</option>" +
								"<option value='20\"'>20\"</option>" +
								"<option value='40\"'>40\"</option>" +
								"<option value='50\"'>50\"</option>" +
								"<option value='60\"'>60\"</option>" +
							"</select>";
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

		var parts = form_data.tanggal.split("/")
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

					$("#col_tanggal_"+no).html($("#input_tanggal_"+no).val());
					$("#col_perusahaan_"+no).html($("#input_perusahaan_"+no).val());
					$("#col_kode_"+no).html($("#input_kode_"+no).val());
					$("#col_nomor_"+no).html($("#input_nomor_"+no).val());
					$("#col_ukuran_"+no).html($("#input_ukuran_"+no).val());
					if(status == '0') $("#col_ip_"+no).html("<a href='#ip_row' class='ip ip_button' no='$no'></a></td>");
					else $("#col_ip_"+no).html("<a href='#' class='unip' no='$no'></a></td>");
					$("#col_edit_"+no).html("<a href='#' onclick=\"edit_row('"+no+"')\" class='edit'></a>");
					$("#col_delete_"+no).html("<a href='#' onclick=\"confirm_delete_row('"+no+"')\" class='trash'></a>");
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
			onStart : function(links, index){
				var $self = $(links[index]);  
		      	var no = $self.attr('no');  
		      	ip_row(no);
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



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
						<input name="no" type="hidden" value="<?=count($rows)+1;?>"/>
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
						<?php
						$download_url = base_url()."manajemen_pt/download_xls";
						if(isset($key)) $download_url .= "?key=$key";
						?>

						<a href='<?=$download_url;?>' class='error'>Download</a>
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
	});

	function edit_row(no)
	{
		var val_owner = $("#col_owner_"+no).html();
		var val_nama = $("#col_nama_"+no).html();
		var val_kode = $("#col_kode_"+no).html();

		var input_owner = "<input id='input_owner_"+no+"' name='owner' type='text' value='"+val_owner+"' style='width:220px; height:14px; vertical-align:middle;'/>";
		var input_nama = "<input id='input_nama_"+no+"' name='nama' type='text' value='"+val_nama+"' style='width:250px; height:14px; vertical-align:middle;'/>";
		var input_kode = "<input id='input_kode_"+no+"' name='kode' type='text' value='"+val_kode+"' style='width:150px; height:14px; vertical-align:middle;'/>";		
		var save_button = "<a href='#' onclick=\"save_row('"+no+"')\" class='save'></a>";
		var cancel_button = "<a href='#' onclick=\"cancel_row('"+no+"','"+val_owner+"','"+val_nama+"','"+val_kode+"')\" class='cancel'></a>";
		
		$("#col_owner_"+no).html(input_owner);
		$("#col_nama_"+no).html(input_nama);
		$("#col_kode_"+no).html(input_kode);
		$("#col_edit_"+no).html(save_button);
		$("#col_delete_"+no).html(cancel_button);
	}

	function save_row(no)
	{
		var form_data = {
			no: no,
			owner: $("#input_owner_"+no).val(),
			nama: $("#input_nama_"+no).val(),
			kode: $("#input_kode_"+no).val(),
			ajax: '1'
		};

		$.ajax({
			url: "<?=site_url('manajemen_pt/update');?>",
			type: "POST",
			data: form_data,
			success: function(){
				$("#col_owner_"+no).html($("#input_owner_"+no).val());
				$("#col_nama_"+no).html($("#input_nama_"+no).val());
				$("#col_kode_"+no).html($("#input_kode_"+no).val());
				$("#col_edit_"+no).html("<a href='#' onclick=\"edit_row('"+no+"')\" class='edit'></a>");
				$("#col_delete_"+no).html("<a href='#' onclick=\"confirm_delete_row('"+no+"')\" class='trash'></a>");
			}
		});
	}

	function cancel_row(no, owner, nama, kode)
	{
		$("#col_owner_"+no).html(owner);
		$("#col_nama_"+no).html(nama);
		$("#col_kode_"+no).html(kode);
		$("#col_edit_"+no).html("<a href='#' onclick=\"edit_row('"+no+"')\" class='edit'></a>");
		$("#col_delete_"+no).html("<a href='#' onclick=\"confirm_delete_row('"+no+"')\" class='trash'></a>");
	}

	function confirm_delete_row(no)
	{
		if(confirm('Apakah anda yakin?')){
			<?php
			$back_url = urlencode(base_url()."manajemen_pt/page/".$page);
			if(isset($key)) $back_url = urlencode(base_url()."manajemen_pt/search?key=".$key."&page=".$page);
			?>

			document.location = "<?=base_url();?>manajemen_pt/delete/"+no+"?back_url=<?=$back_url;?>";
		}
	}

	function tes()
	{
		alert('tes');
	}
	
</script>



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
		<header id="header">
			<?php 
				$data['active'] = 4;
				$this->load->view('header', $data); 
			?>
		</header>

		<section id="section">
			<div id="content" class="container_16 clearfix">
				<form method="post" action="<?=site_url('manajemen_ukuran_pemeriksa/add_ukuran')?>">
					<div class="grid_3"><p>
						<input name="ukuran" type="text" placeholder="Ukuran" required/>
					</p></div>
					<div class="grid_1"><p>
						<input name="no" type="hidden" value="<?=count($list_ukuran)+1;?>"/>
						<input type="submit" value="Add"/>
					</p></div>
				</form>

				<div class="grid_5">
					<p>&nbsp;</p>
				</div>

				<form method="post" action="<?=site_url('manajemen_ukuran_pemeriksa/add_pemeriksa')?>">
					<div class="grid_3"><p>
						<input name="nama" type="text" placeholder="Nama Pemeriksa" required/>
					</p></div>
					<div class="grid_1"><p>
						<input name="no" type="hidden" value="<?=count($list_pemeriksa)+1;?>"/>
						<input type="submit" value="Add"/>
					</p></div>
				</form>

				<div class="grid_16">
					<p>&nbsp;</p>
				</div>

				<div class="grid_4">
					<table id="dataUkuran" clas="tablesorter">
						<colgroup>
							<col class="colA" style="width:30px; word-wrap:break-word;"/>
							<col class="colB" style="width:100px; word-wrap:break-word;"/>
							<col class="colC" style="width:20px; word-wrap:break-word;"/>
						</colgroup>
						<thead>
							<tr>
								<th>No.</th>
								<th class='center'>Ukuran</th>
								<th class='center'>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($list_ukuran as $ukuran){
								extract($ukuran);

								echo "
									<tr>
										<td style='text-align:left;'>$no</td>
										<td class='center'>$ukuran</td>
										<td class='center'><a href='#' onclick=\"confirm_delete_ukuran('$no')\" class='trash'></a></td>
									</tr>
								";
							}
							?>
						</tbody>
					</table>
				</div>

				<div class="grid_5" style="margin-left:60px;">
					<p>&nbsp;</p>
				</div>

				<div class="grid_7">
					<table id="dataUkuran" clas="tablesorter">
						<colgroup>
							<col class="colA" style="width:30px; word-wrap:break-word;"/>
							<col class="colB" style="width:200px; word-wrap:break-word;"/>
							<col class="colC" style="width:20px; word-wrap:break-word;"/>
						</colgroup>
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Pemeriksa</th>
								<th class='center'>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($list_pemeriksa as $pemeriksa){
								extract($pemeriksa);

								echo "
									<tr>
										<td style='text-align:left;'>$no</td>
										<td>$nama</td>
										<td class='center'><a href='#' onclick=\"confirm_delete_pemeriksa('$no')\" class='trash'></a></td>
									</tr>
								";
							}
							?>
						</tbody>
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
			placeholder
			: 'ui-state-highlight',
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

	function tes()
	{
		alert('tes');
	}

	function confirm_delete_ukuran(no)
	{
		if(confirm('Apakah anda yakin?')){
			document.location = "<?=base_url();?>manajemen_ukuran_pemeriksa/delete_ukuran/"+no;
		}
	}

	function confirm_delete_pemeriksa(no)
	{
		if(confirm('Apakah anda yakin?')){
			document.location = "<?=base_url();?>manajemen_ukuran_pemeriksa/delete_pemeriksa/"+no;
		}
	}
	
</script>



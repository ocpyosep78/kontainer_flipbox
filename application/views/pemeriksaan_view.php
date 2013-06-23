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

		<script type="text/javascript">
			$(function() {
				$("#content .grid_5, #content .grid_6").sortable({
					placeholder: 'ui-state-highlight',
					forcePlaceholderSize: true,
					connectWith: '#content .grid_6, #content .grid_5',
					handle: 'h2',
					revert: true
				});
				$("#content .grid_5, #content .grid_6").disableSelection();
			});
			$(document).ready(function() 
		    	{ 
		        	$("#dataList").tablesorter(); 
		    	} 
			);
		</script>
		<script>
			$(function() {
				$( "#datepicker" ).datepicker();
				$( "#datepicker2" ).datepicker();
				$( "#datepicker3" ).datepicker();
			});
		</script>
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
				<div class="grid_1">
					<p>
						<input type="text" placeholder="No"/>
					</p>
				</div>
				<div class="grid_2">
					<p>
						<input type="text" id="datepicker" placeholder="tanggal"/>
					</p>
				</div>
				<div class="grid_2">
					<p>
						<select>
							<option>PTA</option>
							<option>ABS</option>
							<option>BDA</option>
							<option>ADB</option>
							<option>ADBSDD</option>
						</select>
					</p>
				</div>
				<div class="grid_2">
					<p>
						<input type="text" placeholder="No PIB"/>
					</p>
				</div>
				<div class="grid_2">
					<p>
						<input type="text" id="datepicker2" placeholder="Tgl PIB"/>
					</p>
				</div>
				<div class="grid_1">
					<p>
						<input type="text" placeholder="kode kontainer"/>
					</p>
				</div>
				<div class="grid_2">
					<p>
						<input type="text" placeholder="nomer kontainer"/>
					</p>
				</div>
				<div class="grid_1">
					<p>
						<select>
							<option>20"</option>
							<option>40"</option>
						</select>
					</p>
				</div>
				<div class="grid_2">
					<p>
						<input type="text" placeholder="Jam IP"/>
					</p>
				</div>
				<div class="grid_2">
					<p>
						<input type="text" placeholder="Jam Periksa"/>
					</p>
				</div>
				<div class="grid_2">
					<p>
						<input type="text" placeholder="uraian barang"/>
					</p>
				</div>
				<div class="grid_2">
					<p>
						<input type="text" placeholder="pemeriksa"/>
					</p>
				</div>
				<div class="grid_2">
					<p>
						<input type="submit" value="Submit" />
					</p>
				</div>
				<div class="grid_1">
					<p>&nbsp;</p>
				</div>
				<div class="grid_4">
					<p>
						<input type="text" placeholder="search table"/>
					</p>
				</div>
				<div class="grid_1">
					<p>
						<input type="submit" value="Search" />
					</p>
				</div>
				<div class="grid_1">
					<p>
						<button class="error">Download</button>
					</p>
				</div>
				<div class="grid_16">
					<table id="dataList" clas="tablesorter">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Perush.</th>
								<th>No PIB</th>
								<th>Tgl PIB</th>
								<th colspan="2" width="10%">No Kontainer</th>
								<th>Ukuran</th>
								<th>Jam IP</th>
								<th>Jam Periksa</th>
								<th>Uraian Barang</th>
								<th>Pemeriksa</th>
								<th colspan="3" width="10%">Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>No</td>
								<td>Tanggal</td>
								<td>Perush.</td>
								<td>No PIB</td>
								<td>Tgl PIB</td>
								<td colspan="2" widtd="10%">No Kontainer</td>
								<td>Ukuran</td>
								<td>Jam IP</td>
								<td>Jam Periksa</td>
								<td>Uraian Barang Loh</td>
								<td>Pemeriksa</td>
								<td><a href="#" class="spbb"></a></td>
								<td><a href="#" class="edit"></a></td>
								<td><a href="#" class="delete"></a></td>
							</tr>					
							<tr>
								<td>No</td>
								<td>Tanggal</td>
								<td>Perush.</td>
								<td>No PIB</td>
								<td>Tgl PIB</td>
								<td colspan="2" widtd="10%">No Kontainer</td>
								<td>Ukuran</td>
								<td>Jam IP</td>
								<td>Jam Periksa</td>
								<td>Uraian Barang Loh</td>
								<td>Pemeriksa nih</td>
								<td><a href="#" class="spbb"></a></td>
								<td><a href="#" class="edit"></a></td>
								<td><a href="#" class="delete"></a></td>
							</tr>
							<tr>
								<td>No</td>
								<td>Tanggal</td>
								<td>Perush.</td>
								<td>No PIB</td>
								<td>Tgl PIB</td>
								<td colspan="2" widtd="10%">No Kontainer</td>
								<td>Ukuran</td>
								<td>Jam IP</td>
								<td>Jam Periksa</td>
								<td>Uraian Barang Loh</td>
								<td>Pemeriksa nih</td>
								<td><a href="#">SPBB</a></td>
								<td><a href="#">edit</a></td>
								<td><a href="#">delete</a></td>
							</tr>
							<tr>
								<td>No</td>
								<td>Tanggal</td>
								<td>Perush.</td>
								<td>No PIB</td>
								<td>Tgl PIB</td>
								<td colspan="2" widtd="10%">No Kontainer</td>
								<td>Ukuran</td>
								<td>Jam IP</td>
								<td>Jam Periksa</td>
								<td>Uraian Barang Loh</td>
								<td>Pemeriksa nih</td>
								<td><a href="#">SPBB</a></td>
								<td><a href="#">edit</a></td>
								<td><a href="#">delete</a></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="9" class="pagination">
									<span class="active curved">1</span><a href="#" class="curved">2</a><a href="#" class="curved">3</a><a href="#" class="curved">4</a> ... <a href="#" class="curved">10 million</a>
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
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
				$data['active'] = 1;
				$this->load->view('header', $data); 
			?>
		</header>

		<section>
			<div id="content" class="container_16 clearfix">
				<form method="post" action="kontainer/entry">
					<div class="grid_1"><p>
						<input name="no" type="text" placeholder="No"/>
					</p></div>
					<div class="grid_2"><p>
						<input name="tanggal" type="text" id="datepicker" placeholder="Tanggal"/>
					</p></div>
					<div class="grid_3"><p>
						<select>
							<?php
							foreach($perusahaan as $per){
								echo "<option>".$per['nama']."</option>";
							}
							?>
						</select>
					</p></div>
					<div class="grid_2"><p>
						<input name="kode" type="text" placeholder="Kode Kontainer"/>
					</p></div>
					<div class="grid_2"><p>
						<input name="nomor" type="text" placeholder="Nomer Kontainer"/>
					</p></div>
					<div class="grid_2"><p>
						<select name="ukuran">
							<option>10"</option>
							<option>20"</option>
							<option>40"</option>
							<option>50"</option>
						</select>
					</p></div>
					<div class="grid_1"><p>
						<input type="submit" value="Submit" />
					</p></div>
				</form>

				<div class="grid_9">
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
								<th colspan="2" width="10%">No Kontainer</th>
								<th>Ukuran</th>
								<th colspan="3" width="10%">Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>245</td>
								<td>05/20/13</td>
								<td>TAD</td>
								<td>MNA</td>
								<td>2345677</td>
								<td>20"</td>
								<td><a href="#" class="ip"></a></td>
								<td><a href="#" class="edit"></a></td>
								<td><a href="#" class="delete"></a></td>
							</tr>					
							<tr>
								<td>255</td>
								<td>05/20/12</td>
								<td>AAD</td>
								<td>ONA</td>
								<td>3345677</td>
								<td>40"</td>
								<td><a href="#" class="ip"></a></td>
								<td><a href="#" class="edit"></a></td>
								<td><a href="#" class="delete"></a></td>
							</tr>
							<tr>
								<td>222</td>
								<td>05/20/13</td>
								<td>TAD</td>
								<td>MNA</td>
								<td>2345677</td>
								<td>20"</td>
								<td><a href="#">IP</a></td>
								<td><a href="#">edit</a></td>
								<td><a href="#">delete</a></td>
							</tr>
							<tr>
								<td>231</td>
								<td>05/20/13</td>
								<td>DDD</td>
								<td>MNA</td>
								<td>2345677</td>
								<td>20"</td>
								<td><a href="#">IP</a></td>
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
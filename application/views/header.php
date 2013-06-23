<h1 id="head">Sistem Pendataan Kontainer</h1>

<ul id="navigation">
	<?php
		if($active == 1) echo "
			<li><span class='active'>Kontainer Masuk</span></li>
			<li><a href='".site_url('pemeriksaan')."'>Pemeriksaan</a></li>
			<li><a href='".site_url('sppb')."'>SPPB</a></li>
			<li><a href='".site_url('manajemen_pt')."'>Manajemen PT</a></li>
		";
		elseif($active == 2) echo "
			<li><a href='".site_url('kontainer')."'>Kontainer Masuk</a></li>
			<li><span class='active'>Pemeriksaan</span></li>
			<li><a href='".site_url('sppb')."'>SPPB</a></li>
			<li><a href='".site_url('manajemen_pt')."'>Manajemen PT</a></li>
		";
		elseif($active == 3) echo "
			<li><a href='".site_url('kontainer')."'>Kontainer Masuk</a></li>
			<li><a href='".site_url('pemeriksaan')."'>Pemeriksaan</a></li>
			<li><span class='active'>SPPB</span></li>
			<li><a href='".site_url('manajemen_pt')."'>Manajemen PT</a></li>
		";
		elseif($active == 4) echo "
			<li><a href='".site_url('kontainer')."'>Kontainer Masuk</a></li>
			<li><a href='".site_url('pemeriksaan')."'>Pemeriksaan</a></li>
			<li><a href='".site_url('sppb')."'>SPPB</a></li>
			<li><span class='active'>Manajemen PT</span></li>
		";
	?>
	
</ul>
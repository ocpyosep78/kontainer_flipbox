<div id="colhead"><h1 id="head">Sistem Pendataan Kontainer</h1></div>

<div id="colnav">
	<ul id="navigation">
		<?php
			if($active == 1) echo "
				<li><span class='active'>Kontainer Masuk</span></li>
				<li><a href='".site_url('pemeriksaan')."'>Pemeriksaan</a></li>
				<li><a href='".site_url('manajemen_pt')."'>Manajemen PT</a></li>
			";
			elseif($active == 2) echo "
				<li><a href='".site_url('kontainer')."'>Kontainer Masuk</a></li>
				<li><span class='active'>Pemeriksaan</span></li>
				<li><a href='".site_url('manajemen_pt')."'>Manajemen PT</a></li>
			";
			elseif($active == 3) echo "
				<li><a href='".site_url('kontainer')."'>Kontainer Masuk</a></li>
				<li><a href='".site_url('pemeriksaan')."'>Pemeriksaan</a></li>
				<li><span class='active'>Manajemen PT</span></li>
			";
		?>
	</ul>
</div>
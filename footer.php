<div class="footer">
	<a href = "https://portal.biohpc.swmed.edu/content/" target="_blank"><img src=./images/BioHPC_logo.PNG alt="BioHPC logo"></a>
	<a href = "https://qbrc.swmed.edu/" target="_blank"><img src=./images/QBRC_logo.JPG alt="QBRC logo"></a>
	<a href = "http://cri.utsw.edu/" target="_blank"><img src=./images/CRI_logo.JPG alt="CRI logo"></a>
	<p>&copy; Copyright 
	<?php 
	date_default_timezone_set('America/Los_Angeles'); 
	echo "2016";
	if(date("Y") != 2016){
		echo " - ".date("Y");
	}
	?>
	</p>
</div>
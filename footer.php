<div class="footer">
	<a href = "https://portal.biohpc.swmed.edu/content/"><img src=./images/BioHPC_logo.png alt="BioHPC logo"></a>
	<a href = "https://qbrc.swmed.edu/"><img src=./images/QBRC_logo.jpg alt="QBRC logo"></a>
	<a href = "http://cri.utsw.edu/"><img src=./images/CRI_logo.jpg alt="CRI logo"></a>
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
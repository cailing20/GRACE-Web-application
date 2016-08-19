<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-US">
<head>
<title>Genomic Regression Analysis of Coordinated Expression - About</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta name="Keywords" content="Regression, Copy Number, RNA, gene expression, correlation, co-expression"/>
<meta name="Description" content="Bioinformatic tool to retrieve correlated genes from tumor and normal tissue data based on a novel genomic regression method."/>

<!-- For the home icon -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/grace.css">
<style>
.about{
	display:inline-block;
	padding:10px;
	margin:10px;
	
}
.about p{
	display:block;
}
.about img{
	height:150px;
	display:block;
}
</style>
<script src="js/jquery-2.2.1.min.js"></script>

</head>

<body>
<div class="wrapper-main">
	<?php include_once 'header.php';?>
	<div style="margin:20px">
		<h2>This is still work in progress...</h2><br>
		
		<h2>What's next</h2>
		
		<div class="about card">
			<img src="images/About/debug.jpg" alt="Debug">
			<p>Debug</p>
		</div>
		
		<div class="about card">
			<img src="images/About/responsive_design.png" alt="Web Responsive Design">
			<p>Responsive Design</p>
		</div>
		
		<div class="about card">
			<img src="images/About/browser_compatibility.png" alt="Browser Compatibility">
			<p>Broser Compatibility</p>
		</div>
		
		<div class="about card">
			<img src="images/About/security.jpg" alt="Security">
			<p>Security</p>
		</div>

	</div>
	<div class="push"></div>
</div>
<?php include_once 'footer.php';?>


<script>
activatePage('top-nav-about');
//responsive top-nav
function toggleMenu() {
    document.getElementsByClassName("top-nav")[0].classList.toggle("responsive");
}
</script>
</body>
</html>

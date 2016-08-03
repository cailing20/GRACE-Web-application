<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-US">
<head>
<title>Genomic Regression Analysis of Coordinated Expression - Credits</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta name="Keywords" content="Regression, Copy Number, RNA, gene expression, correlation, co-expression"/>
<meta name="Description" content="Bioinformatic tool to retrieve correlated genes from tumor and normal tissue data based on a novel genomic regression method."/>

<!-- For the home icon -->
<link rel="stylesheet" href="./css/font-awesome.min.css">
<link rel="stylesheet" href="./css/w3.css">
<link rel="stylesheet" href="./css/grace.css">

<script src="./js/jquery-2.2.1.min.js"></script>
</head>

<body>
<div class="wrapper-main">
	<?php include_once './header.php';?>
	
	<div class="acknowlegements">
		<h1>Acknowledgements</h1><br>
		<h3>TCGA Network</h3>
		<p>We gratefully acknowledge the contributions from the TCGA Research Network.</p>
		<h3>Funding</h3>
		<p>This study was supported by the American Association for Cancer Research (AACR) Basic Cancer Research Fellowship (15-40-01-CAIL) awarded to Ling Cai; 
		and grants from the National Cancer Institute (CA157996 to Ralph J. DeBearardinis); Cancer Prevention Research Institute of Texas (RP130272 to Ralph J. DeBearardinis) and 
		National Institutes of Health (CA172211-01 to Guanghua Xiao)</p>
		<h3>Computing Resources</h3>
		<p>We thank the UT Southwestern BioHPC and Quantitative Biomedical Research Center (QBRC) for the use of their computing resources.</p>
		<p>We also thank the Broad Institute FireBrowse RESTful API for data sharing.</p>
		<h3>Website</h3>
		<p>We thank Ling Cai, Yi Du and Liqiang Wang for their efforts in designing, implementing and testing the web application.</p>
		<p>The dynamic and modern RNA copy number scatter plots are generated by <a href="http://www.highcharts.com/" target="_blank">Highcharts</a>.</p>
	</div>
	<div class="push"></div>
</div>
<?php include_once './footer.php';?>


<script>
//activate credits in top navigation
activatePage('top-nav-credits')
</script>
</body>
</html>

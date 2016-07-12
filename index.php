<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-US">
<head>
<title>Genomic Regression Analysis of Coordinated Expression - Home Page</title>

<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta name="Keywords" content="Regression, Copy Number, RNA, gene expression, correlation, co-expression"/>
<meta name="Description" content="Bioinformatic tool to retrieve correlated genes from tumor and normal tissue data based on a novel genomic regression method."/>

<link rel="stylesheet" href="./css/font-awesome.min.css">
<link rel="stylesheet" href="./css/w3.css">
<link rel="stylesheet" href="./css/grace.css">
<script src="./js/jquery-2.2.1.min.js"></script>
<!-- classList problem for IE -->
<script src="./js/classList.min.js"></script>
</head>

<body class="home-body">
<div class="wrapper-main">
	<?php include_once './header.php';?>
	
	
	<!-- Start of the left navigation menu for home content -->
	<div class='left-nav' id='home-nav'>
	<br>
	<ul class="LN">
	  <li><a href="#" class="homeLinks" id="firstHome" onclick="openRef(event, 'Intro')">General Introduction</a></li>
	  <li><a href="#" class="homeLinks" onclick="openRef(event, 'SCNA')">Somatic Copy Number Alteration</a></li>
	  <li><a href="#" class="homeLinks" onclick="openRef(event, 'StandardAnalysis')">Co-expression Analysis</a></li>
	  <li><a href="#" class="homeLinks" onclick="openRef(event, 'GRACE_Method')">Rationale of GRACE</a></li>
	  <li><a href="#" class="homeLinks" onclick="openRef(event, 'GRACE_performance')">Performance of GRACE</a></li>
	</ul>
	</div>
	<!-- End of the left navigation menu for home content -->
	
	<!-- Start of the  home content -->
	<div id="Intro" class='homeContent' style="display:block;">
		<h3><b>Introduction</b></h3>
		<p>Co-expression analyses are useful tools for elucidating gene function.
		 Genes coordinately expressed with a gene of interest are often functionally linked in the same biological pathway.
		 Many cancer online analysis platforms provide co-expression analysis based on cancer transcriptomic data.</p>
		<p>However, in cancer, a large fraction of the genome is affected by somatic copy number alterations (SCNA)
		<sup class='ref'><a href="http://www.ncbi.nlm.nih.gov/pubmed/?term=24071852" target="_blank"
		   title="Beroukhim, R. et al. The landscape of somatic copy-number alteration across human cancers. Nature 463, 899-905 (2010)." 
		   id="ref-link-1">ref</a></sup>
		   such as amplifications and deletions, and correlation between mRNA abundance and DNA copy number are often observed. 
		   Because copy number gain and loss can lead to simultaneous over- and under-expression of multiple genes from the same genomic location, 
		   genes from the same DNA segment with copy number alteration also become correlated. 
		   As a consequence, standard co-expression analyses using cancer transcriptomic data often identify physically neighboring genes as co-expressing genes based on their positive correlation with the gene of interest. 
		   
		<p><b>Genomic Regression Analysis of Coordinated Expression (GRACE)</b> is a method developed to remove effect of copy number alteration from co-expression analysis so that the resulting genes are mostly based on biological regulation. 
		   This web portal allows users to perform co-expression analysis with tumor or normal samples from various cancer types based on TCGA studies. 
		   The users may apply either GRACE or standard, non-SCNA adjusted method to perform analysis with tumor sample data. 
		   Standard method may also be applied for normal tissue samples, which lack frequent SCNAs.  
		   Functional enrichment analysis is also provided for interpretation of co-expressing genes. </p>
	</div>
	
	<div id="SCNA" class='homeContent'>
		<div class="home-image-container card"><img class="home-image" src="./images/HOME_SCNA.png" alt="BRCA_SCNA_Chr1"></div>
		<h3 class="home-title"><b>Somatic Copy Number Alteration (SCNA) in Cancer</b></h3>
		<p>Somatic copy number alteration (SCNA) is commonly seen in cancer. 
		For example, plotted in the figure are the relative copy number levels of chromosome 1 using 1075 samples from TCGA Breast Invasive Carcinoma (BRCA) study
		<sup class='ref'><a href="http://www.ncbi.nlm.nih.gov/pubmed/23000897" target="_blank"
		   title="The Cancer Genome Atlas Network. Comprehensive molecular portraits of human breast tumours. Nature 490, 61-70 (2012)." 
		   >ref</a></sup>. 
		Chromosome 1p is frequently deleted whereas 1q is frequently amplified in breast cancer. 
		Consequently, RNA and genomic copy number for genes from the same arm of chromosome 1 are strongly correlated. 
		This also results in correlation of neighboring genes on chromosome 1.</p>
	</div>
	
	<div id="StandardAnalysis" class='homeContent'>
		<div class="home-image-container card"><img class="home-image" src="./images/HOME_EIF2DbyStandardMethod.png" alt="EIF2D coexpressing genes by standard method"></div>
		<h3 class="home-title"><b>Standard Co-expression Analysis in Cancer</b></h3>
		<p>Because of frequent SCNA events in cancer, standard co-expression analysis using cancer transcriptomic data often identify physically neighboring genes as being co-expressed. 
		For example, the top 10 co-expressing genes for EIF2D, a gene on chromosome 1q32, encoding eukaryotic translation initiation factor 2D that locates at chromosome 1q32, are all located nearby or from the same 1q32. 
		This trend holds true for the top 200 co-expressing genes. 
		And such bias is quite common in the cancer genome because of the ubiquity of SCNAs.</p>
	</div>
	
	<div id="GRACE_Method" class='homeContent'>
		<div class="home-image-container card" style="width:280px !important;float:left;margin-right:20px;margin-top:10px;"><img class="home-image" src="./images/HOME_GRACEMethod.png" alt="Residuals from regressing RNA on copy number for EIF2D" style="width:250px !important;"></div>
		<h3 class="home-title"><b>GRACE method</b></h3>
		<p>To correct for the bias from SCNA in co-expression analysis, we fit a linear regression model using copy number as the explanatory variable and RNA levels as the response variable. 
		The residuals from this linear regression model represent variations in RNA that cannot be explained by copy number variations. 
		Such residuals are calculated for every gene and are used for co-expression analysis instead of the original RNA levels. 
		We have named this method Genomic Regression Analysis of Coordinated Expression (GRACE). </p>
	</div>
	
	<div id="GRACE_performance" class='homeContent'>
		<div class="home-image-container card"><img class="home-image" src="./images/HOME_EIF2DbyGRACEMethod.png" alt="EIF2D coexpressing genes by GRACE method"></div>
		<h3 class="home-title"><b>Genomic Regression Analysis of Coordinated Expression in Cancer</b></h3>
		<p>Using GRACE, the bias from SCNA is largely reduced. 
		Using EIF2D again as an example, the top 10 coexpressing genes called by GRACE come from various chromosomes. 
		But they are all involved in translation and therefore functionally relevant to EIF2D. 
		The top 200 EIF2D coexpressing genes are no longer enriched in EIF2D neighboring genes from chromosome 1q. 
		Instead, the list is topped by genes encoding ribosome subunits.</p>
	</div>
	<!-- End of the  home content -->
	<div class="push"></div>
</div>
<?php include_once './footer.php';?>

<script>
/* This script activates the home icon in the top menu */
function startPage(){
	activatePage('top-nav-home');
	$("#firstHome").addClass("active");
}
window.onload = startPage; 

/* Transition between tabs from left navigation bar at home page */
function openRef(evt, referenceName) {
    var i, homeContent, homeLinks;

    homeContent = document.getElementsByClassName("homeContent");
    for (i = 0; i < homeContent.length; i++) {
        homeContent[i].style.display = "none";
    }

    homeLinks = document.getElementsByClassName("homeLinks");
    for (i = 0; i < homeContent.length; i++) {
        homeLinks[i].classList.remove("active");
    }
    document.getElementById(referenceName).style.display = "block";
    evt.currentTarget.classList.add("active");
    
}


</script>
</body>
</html>
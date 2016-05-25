<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-US">
<head>
<title>Genomic Regression Analysis of Coordinated Expression - Home Page</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Keywords" content="Regression, Copy Number, RNA, gene expression, correlation, co-expression">
<meta name="Description" content="Bioinformatic tool to retrieve correlated genes from tumor and normal tissue data based on a novel genomic regression method.">

<!-- For the home icon -->
<link rel="stylesheet" href="./css/font-awesome.min.css">
<link rel="stylesheet" href="./css/w3.css">
<link rel="stylesheet" href="./css/test.css">


<script src="./js/jquery-2.2.1.min.js"></script>

</head>

<body>
<div id="top-banner">
	<div class='top-logo col-4'>
		<a href='./Home.php'>
<!-- 		<img src="./images/GraceLogo.png" alt="Grace Logo">
 -->		
		<b>
			<span style="color:transparent; text-shadow: 0 0 12px rgba(95,15,78,0.2)">G</span>
			<span style="color:transparent; text-shadow: 0 0 9px rgba(128,22,86,0.4)">R</span>
			<span style="color:transparent; text-shadow: 0 0 6px rgba(161,29,94,0.6)">A</span>
			<span style="color:transparent; text-shadow: 0 0 3px rgba(194,36,102,0.8)">C</span>
			<span style="color:transparent; text-shadow: 0 0 0px rgba(229,42,111,1)">E</span>
		</b>
		
		
		</a>
	</div>
	<div class='top-description col-8'>Genomic Regression Analysis of Coordinated Expression</div>
</div>

<div id='top-nav'>
	<ol class='top-nav w3-card-2'>
		<li><a href='./Home.php' id='top-nav-home' class='fa fa-home' style='font-size: 2rem;' title='Home'></a></li>
		<li><a href='./Analysis.php' id='top-nav-analysis' title='Analysis of coordinately expressed genes'>Analysis</a></li>
		<li><a href='./FAQ.php' id='top-nav-faq' title='Frequently Asked Questions'>FAQ</a></li>
		<li><a href='./Resources.php' id='top-nav-resources' title='Useful websites'>Resources</a></li>
		<li><a href='./Credits.php' id='top-nav-credits' title='Acknowledgements'>Credits</a></li>
		<li><a href='./About.php' id='top-nav-about' title='Version history'>About</a></li>
		<li class="icon">
	    <a href="javascript:void(0);" onclick="toggleMenu()"><i class="fa fa-bars"></i></a>
	  </li>
	</ol>
</div>
<script>
function toggleMenu() {
    document.getElementsByClassName("top-nav")[0].classList.toggle("responsive");
}
function activatePage(activePage) {
	var page = document.getElementById(activePage);
	page.className += " active";
}
</script>

<script>
function startPage(){
	activatePage('top-nav-home');
	$("#firstHome").addClass("active");
}
window.onload = startPage; 

</script>

<script> /* Transition between tabs from left navigation bar at home page */
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

<div class='w3-card-2 left-nav' id='home-nav'>
<br>
<h2 style="margin-left:15px; color:#5F0F4E; font-weight:500; padding-top:5px;">Rationale of GRACE</h2>
<ul class="LN">
  <li><a href="#" class="homeLinks" id="firstHome" onclick="openRef(event, 'Intro')">Introduction</a></li>
  <li><a href="#" class="homeLinks" onclick="openRef(event, 'SCNA')">Somatic copy number alteration (SCNA) in cancer</a></li>
  <li><a href="#" class="homeLinks" onclick="openRef(event, 'StandardAnalysis')">Standard Co-expression Analysis in Cancer</a></li>
  <li><a href="#" class="homeLinks" onclick="openRef(event, 'GRACE_Method')">How does GRACE work</a></li>
  <li><a href="#" class="homeLinks" onclick="openRef(event, 'GRACE_performance')">Using GRACE with cancer samples</a></li>
</ul>
</div>


<div id="Intro" class='homeContent' style="display:block;">
<h3><b>Introduction</b></h3>
<p>Co-expression analysis are useful tools for elucidating gene functions.
 Genes coordinatedly expressed together with the gene of interest are likely involved in the same pathway.
 Many cancer online analysis platforms provide co-expression analysis based on cancer transcriptomic data.</p>
<p>However in cancer, a large fraction of the genome is affected by somatic copy number alteration (SCNA)
<sup class='ref'><a href="http://www.ncbi.nlm.nih.gov/pubmed/?term=24071852" target="_blank"
   title="Beroukhim, R. et al. The landscape of somatic copy-number alteration across human cancers. Nature 463, 899-905 (2010)." 
   id="ref-link-1">ref</a></sup>
   and correlation between mRNA abundance and DNA copy number are often observed. 
   As copy number gain and loss can lead to simultaneous over- and under-expression of multiple genes from the same segment, 
   genes from the same DNA segment with copy number alteration also become correlated. 
   As a consequence, standard co-expression analysis using cancer transcriptomic data often identify physically neighboring genes as co-expressing genes based on their positive correlation with the gene of interest. 
   
<p><b>Genomic Regression Analysis of Coordinated Expression (GRACE)</b> is a method developed to remove effect of copy number alteration from co-expression analysis so that the resulted genes are mostly based on biological regulation rather than copy number alteration. 
   This web portal allows users to perform co-expression analysis with tumor or normal samples from various cancer types based on TCGA studies. 
   The users may use GRACE or the standard method to performa analysis with tumor sample data or standard method with normal sample data. 
   Functional enrichment analysis is also provided for interpretation of co-expressing genes. </p>
</div>

<div id="SCNA" class='homeContent'>
<img class="home-image w3-card-2" src="./images/HOME_SCNA.png" alt="BRCA_SCNA_Chr1">
<h3><b>Somatic Copy Number Alteration (SCNA) in Cancer</b></h3>
<p>Somatic copy number alteration (SCNA) is commonly seen in cancer. 
For example,plotted in the figure are the relative copy number levels of chromosome 1 using 1075 samples from TCGA Breast Invasive Carcinoma (BRCA) study
<sup class='ref'><a href="http://www.ncbi.nlm.nih.gov/pubmed/23000897" target="_blank"
   title="The Cancer Genome Atlas Network. Comprehensive molecular portraits of human breast tumours. Nature 490, 61-70 (2012)." 
   >ref</a></sup>. 
Chromosome 1p is frequently deleted whereas 1q is frequently amplified in breast cancer. 
Consequently, there is strong positive correlation between RNA and copy number for genes from the same arm of chromosome 1. 
This also results in correlation of neighboring genes.</p>
</div>

<div id="StandardAnalysis" class='homeContent'>
<img class="home-image w3-card-2" src="./images/HOME_EIF2DbyStandardMethod.png" alt="EIF2D coexpressing genes by standard method">
<h3><b>Standard Co-expression Analysis in Cancer</b></h3>
<p>Because of frequent SCNA events in cancer, standard co-expression analysis using cancer transcriptomic data often identify physically neighboring genes as co-expressing genes. 
For example, the top 10 co-expressing genes for EIF2D, a gene encoding eukaryotic translation initiation factor 2D that locates at chromosome 1q32, are all from the proximity of its locus. 
This trend holds true for its top 200 co-expressing genes. 
This bias introduced by SCNA is quite ubiquitous in the cancer genome because of the widespread of SCNA.</p>
</div>

<div id="GRACE_Method" class='homeContent'>
<img class="home-image w3-card-2" src="./images/HOME_GRACEMethod.png" alt="Residuals from regressing RNA on copy number for EIF2D">
<h3><b>GRACE method</b></h3>
<p>To correct for the bias from SCNA in co-expression analysis, we fit a linear regression model using copy number as the explanatory variable and RNA levels as the response variable. 
The residuals from this linear regression model represents variations in RNA that could not be accounted for by copy number variations. 
Such residuals are calculated for every gene and are used for co-expression analysis instead of the original RNA levels. 
We have named this method Genomic Regression Analysis of Coordinated Expression (GRACE). </p>
</div>

<div id="GRACE_performance" class='homeContent'>
<img class="home-image w3-card-2" src="./images/HOME_EIF2DbyGRACEMethod.png" alt="EIF2D coexpressing genes by GRACE method">
<h3><b>Genomic Regression Analysis of Coordinated Expression in Cancer</b></h3>
<p>Using GRACE, the bias from SCNA is largely reduced. 
Take EIF2D for example again, the top 10 coexpressing genes called by GRACE come from various chromosomes. 
But they are all involved in translation and functionally relevant to EIF2D. 
The top 200 EIF2D coexpressing genes are no longer enriched in EIF2D neighboring genes from chromosome 1q. 
Instead, the list is topped by genes encoding ribosome subunits.</p>
</div>

</body>
</html>

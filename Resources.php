<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-US">
<head>
<title>Genomic Regression Analysis of Coordinated Expression - Resources</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta name="Keywords" content="Regression, Copy Number, RNA, gene expression, correlation, co-expression"/>
<meta name="Description" content="Bioinformatic tool to retrieve correlated genes from tumor and normal tissue data based on a novel genomic regression method."/>

<!-- For the home icon -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/grace.css">
<link rel="stylesheet" href="css/Resources.css" type="text/css" />
<script src="js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="js/highlight.pack.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/jquery.accordion.js"></script>
<script type="text/javascript">
$(window).on('load resize', function(){
	var width = $(window).width() - 20;
	document.getElementById("ACbody").style.width = (width+'px');
})
   $(document).ready(function() {

       //syntax highlighter
       hljs.tabReplace = '    ';
       hljs.initHighlightingOnLoad();

       $.fn.slideFadeToggle = function(speed, easing, callback) {
           return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
       };

       //accordion
       $('.accordion').accordion({
           defaultOpen: 'section1',
           cookieName: 'accordion_nav',
           speed: 'slow',
           animateOpen: function (elem, opts) { //replace the standard slideUp with custom function
               elem.next().stop(true, true).slideFadeToggle(opts.speed);
           },
           animateClose: function (elem, opts) { //replace the standard slideDown with custom function
               elem.next().stop(true, true).slideFadeToggle(opts.speed);
           }
       });

   });
</script>
</head>

<body>
<div class="wrapper-main">
	<?php include_once 'header.php';?>
	
	<h1 class="ACh1">External Resources</h1>
	<div id="ACbody">
		<!-- panel -->
		<div class="accordion" id="section1">Cancer Profiling Databases<span></span></div>
		<div class="ACcontainer">
		    <div class="ACcontent">
		    	<a href="http://firebrowse.org/" target="_blank">
					<img src="images/Resources/FireBrowse.png" alt="FIREBROWSE">
				</a>
				<p>
					FireBrowse is a simple and elegant way to explore cancer data, backed by a powerful computational infrastructure, application programming interface (API), graphical tools and online reports.  It sits above the TCGA GDAC Firehose, one of the deepest and most integratively characterized open cancer datasets in the world--with over 80K sample aliquots from 11,000+ cancer patients, spanning 38 unique disease cohorts. 
					<sup class='ref'><a href="https://www.broadinstitute.org/software/cprg/?q=node/63" target="_blank"
	   									title="FireBrowse Introduction" >ref</a></sup>
	   				<br><br>
				</p>
				
				<a href="http://www.broadinstitute.org/tumorscape/pages/portalHome.jsf" target="_blank">
					<img src="images/Resources/Tumorscape.png" alt="TumorScape">
				</a>
				<p>
					TumorScape is designed to facilitate the use and understanding of high-resolution copy number data amassed from multiple cancer types. The functionalities, including gene-level analysis, analysis by cancer type, download and visualization of cancer DNA copy number data, are supported.
					<sup class='ref'><a href="http://www.broadinstitute.org/tumorscape/pages/portalHome.jsf" target="_blank"
	   									title="TumorScape Introduction" >ref</a></sup>
	   				<br><br>
				</p>
				
				<a href="http://www.broadinstitute.org/ccle/home" target="_blank">
					<img src="images/Resources/CCLE.JPG" alt="CCLE">
				</a>
				<p>
					The Cancer Cell Line Encyclopedia (CCLE) project is an effort to conduct a detailed genetic characterization of a large panel of human cancer cell lines. The CCLE provides public access analysis and visualization of DNA copy number, mRNA expression, mutation data and more, for 1000 cancer cell lines.
					<sup class='ref'><a href="https://www.broadinstitute.org/software/cprg/?q=node/11" target="_blank"
	   									title="CCLE Introduction" >ref</a></sup>
	   				<br><br>
				</p>
				
				<a href="http://discover.nci.nih.gov/cellminer/home.do" target="_blank">
					<img src="images/Resources/CellMiner.gif" alt="CellMiner">
				</a>
				<p>
					CellMiner™ is a web application that facilitates systems biology through the retrieval and integration of the molecular and pharmacological data sets for the NCI-60 cell lines. The NCI-60 is a panel of 60 diverse human cancer cell lines used by the Developmental Therapeutics Program of the U.S. National Cancer Institute to screen over 100,000 chemical compounds and natural products (since 1990).
					<sup class='ref'><a href="http://discover.nci.nih.gov/cellminer/home.do" target="_blank"
	   									title="CellMiner Introduction" >ref</a></sup>
					<br><br>
				</p>
				
				
			</div>
		</div>
		<!-- end panel -->
		<!-- panel -->
		<div class="accordion" id="section2">Cancer Analysis Platforms<span></span></div>
		<div class="ACcontainer">
		    <div class="ACcontent">
		        <a href="http://www.cbioportal.org/" target="_blank">
					<img src="images/Resources/cbioportal_logo.png" alt="cBioPortal_logo">
				</a>
				<p>
					The cBioPortal for Cancer Genomics provides visualization, analysis and download of large-scale cancer genomics data sets.
					<sup class='ref'><a href="http://www.cbioportal.org/" target="_blank"
	   									title="cBioPortal Introduction" >ref</a></sup>
					<br><br>
				</p>
				
		        <a href="https://www.oncomine.org/resource/login.html" target="_blank">
					<img src="images/Resources/Oncomine.png" alt="Oncomine_logo">
				</a>
				<p>
					Oncomine combines a rapidly growing compendium of 20,000+ cancer transcriptome profiles with a sophisticated analysis engine and a powerful web application for data-mining and visualization.
					<sup class='ref'><a href="http://www.webcitation.org/getfile?fileid=bcbe297e4085b19933cca759a88e0e2b9fac3b1e" target="_blank"
	   									title="Oncomine (Research) Introduction" >ref</a></sup>
					<br><br>
				</p>
				
				<a href="https://genome-cancer.ucsc.edu/proj/site/hgHeatmap/" target="_blank">
					<img src="images/Resources/UCSCCancerBrowser.png" alt="UCSC Cancer Browser_logo">
				</a>
				<p>
					The UCSC Cancer Browser allows researchers to interactively explore cancer genomics data and its associated clinical information. Data can be viewed in a variety of ways, including by value, chromosome location, clinical feature, biological pathway or geneset of interest. It is also possible to quickly perform and easily view statistical analyses on subsets of the data.
					<sup class='ref'><a href="https://genome-cancer.ucsc.edu/proj/site/help/" target="_blank"
	   									title="UCSC Cancer Browser Introduction" >ref</a></sup>
					<br><br>
				</p>
				
		    </div>
		</div>
		<!-- end panel -->
		<!-- panel -->
		<div class="accordion" id="section3">Tissue Specific Expression Analysis<span></span></div>
		<div class="ACcontainer">
		    <div class="ACcontent">
		        <a href="http://giant.princeton.edu/" target="_blank">
					<img src="images/Resources/Giant.png" alt="GIANT_logo" style="height:197px !important;height:142.5px !important;">
				</a>
				<p>
					Genome-scale Integrated Analysis of gene Networks in Tissues (GIANT) provides an interface to human tissue networks through multi-gene queries, network visualization, analysis tools (including NetWAS) and downloadable networks. GIANT enables systematic exploration of the landscape of interacting genes that shape specialized cellular functions across more than a hundred human tissues and cell types.
					<sup class='ref'><a href="http://www.nature.com/ng/journal/v47/n6/full/ng.3259.html" target="_blank"
	   									title="GIANT Introduction" >ref</a></sup>
					<br><br>
				</p>
				
				<a href="https://www.ebi.ac.uk/gxa/home" target="_blank">
					<img src="images/Resources/ExpressionAtlas.png" alt="Expression Atlas_logo" style="height:197px !important;height:142.5px !important;">
				</a>
				<p>
					The Expression Atlas provides information on gene expression patterns under different biological conditions. Gene expression data is re-analyzed in-house to detect genes showing interesting baseline and differential expression patterns.
					<sup class='ref'><a href="https://www.ebi.ac.uk/gxa/about.html" target="_blank"
	   									title="Expression Atlas Introduction" >ref</a></sup>
					<br><br>
				</p>
				
				<a href="http://biogps.org/#goto=welcome" target="_blank">
					<img src="images/Resources/BioGPS.JPG" alt="BioGPS_logo">
				</a>
				<p>
				BioGPS is an extensible and customizable portal for querying and organizing gene annotation resources. In particular, its default gene annotation report provides a survey of gene expression patterns from a diverse set of tissues and cell types.
					<sup class='ref'><a href="http://biogps.org/about/" target="_blank"
	   									title="BioGPS Introduction" >ref</a></sup>
					<br><br>
				</p>
				
		    </div>
		</div>
		<!-- end panel -->
		<!-- panel -->
		<div class="accordion" id="section4">Functional Enrichment Analysis<span></span></div>
		<div class="ACcontainer">
		    <div class="ACcontent">
				<a href="http://amp.pharm.mssm.edu/Enrichr/" target="_blank">
					<img src="images/Resources/Enrichr.JPG" alt="Enrichr_logo">
				</a>
				<p>
					Enrichr is an easy-to-use intuitive enrichment analysis web-based tool providing various types of visualization summaries of collective functions of gene lists. Enrichr provides access to 35 gene-set libraries with many useful libraries such as those created from ENCODE enlisting many targets for many transcription factors as well as a gene-set library extracted from the NIH Roadmap Epigenomics Project for histone modifications.
					<sup class='ref'><a href="http://bmcbioinformatics.biomedcentral.com/articles/10.1186/1471-2105-14-128" target="_blank"
	   									title="Enrichr Introduction" >ref</a></sup>
					<br><br>
				</p>
	
				<a href="https://david.ncifcrf.gov/" target="_blank">
					<img src="images/Resources/David.JPG" alt="DAVID_logo">
				</a>
				<p>
					The Database for Annotation, Visualization and Integrated Discovery (DAVID) provides a comprehensive set of functional annotation tools for investigators to understand the biological meaning behind a large list of genes.
					<sup class='ref'><a href="https://david.ncifcrf.gov/home.jsp" target="_blank"
	   									title="DAVID Introduction" >ref</a></sup>
					<br><br>
				</p>	  
				
				<a href="http://cbl-gorilla.cs.technion.ac.il/" target="_blank">
					<img src="images/Resources/Gorilla.JPG" alt="GOrilla_logo">
				</a>
				<p>
					GOrilla (Gene Ontology enRIchment anaLysis and visuaLizAtion tool) is a tool for discovery and visualization of enriched GO terms in ranked gene lists
					<sup class='ref'><a href="http://bmcbioinformatics.biomedcentral.com/articles/10.1186/1471-2105-10-48" target="_blank"
	   									title="GOrilla Introduction" >ref</a></sup>
					<br><br>
				</p>	    
			</div>
		</div>
		<!-- end panel -->
		
		<!-- panel -->
		<div class="accordion" id="section6">Are we missing important resources?<span></span></div>
		<div class="ACcontainer">
		    <div class="ACcontent">
		    	<p> Please let me know:
					Email any additional resources to ling[dot]cai[at]utsouthwestern[dot]edu
		        </p>
		    </div>
		</div>
		<!-- end panel -->
	</div>
	<div class="push"></div>
</div>
<?php include_once 'footer.php';?>
<script>
activatePage('top-nav-resources')
</script>
</body>
</html>

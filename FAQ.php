<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-US">
<head>
<title>Genomic Regression Analysis of Coordinated Expression - FAQ</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta name="Keywords" content="Regression, Copy Number, RNA, gene expression, correlation, co-expression"/>
<meta name="Description" content="Bioinformatic tool to retrieve correlated genes from tumor and normal tissue data based on a novel genomic regression method."/>

<!-- For the home icon -->
<link rel="stylesheet" href="./css/font-awesome.min.css">
<link rel="stylesheet" href="./css/w3.css">
<link rel="stylesheet" href="./css/grace.css">
<link rel="stylesheet" href="./css/FAQ.css" type="text/css" />
<script src="./js/jquery-2.2.1.min.js"></script>
<script type="text/javascript" src="./js/highlight.pack.js"></script>
<script type="text/javascript" src="./js/jquery.cookie.js"></script>
<script type="text/javascript" src="./js/jquery.accordion.js"></script>
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
	<?php include_once './header.php';?>
	
	
	<!-- Each panel is a Q/A pair -->
	<h1 class="ACh1">Frequently Asked Questions</h1>
	<div id="ACbody">
		<!-- panel -->
		<div class="accordion" id="section1">How do I run a RNA and DNA Copy Number Scatter Plot analysis?<span></span></div>
		<div class="ACcontainer">
		    <div class="ACcontent">
				<img class="faq" src="./images/FAQ/step1_pickPathway.png" alt="click dropdown menu to select from KEGG pathway gene sets">
				<p>There are two ways to enter a gene for analysis. One way is to pick a gene from the KEGG pathway genes sets. 
				Click the "Pick from KEGG Pathways" button to release the dropdown menu.</p><br><br>
				<img class="faq" src="./images/FAQ/step2_pickPathway.png" alt="choose a pathway gene set">
				<p>The list includes 186 pathway gene sets from the KEGG Pathway database.</p><br><br>
				<img class="faq" src="./images/FAQ/step3_pickPathway.png" alt="browse genes from a pathway gene set">
				<p>The user can browse the genes from a chosen gene set.
				They can also go back by clicking the back arrow to choose from the other KEGG pathway gene sets.</p><br><br>
				<img class="faq" src="./images/FAQ/step4_pickPathway.png" alt="choose another pathway gene set">
				<p>Another pathway gene set can be chosen from the menu.</p><br><br>
				<img class="faq" src="./images/FAQ/step5_pickPathway.png" alt="pick a gene from the pathway gene set">
				<p>When the cursor rolls over the gene name, a description of the gene will be shown. 
				Clicking on the gene will send the gene name to the search field.</p><br><br>
				<img class="faq" src="./images/FAQ/step6_pickPathway.png" alt="pick a gene from the pathway gene set">
				<br><br>
				<img class="faq" src="./images/FAQ/step7_enterGene.png" alt="enter a gene from search field">
				<p>Alternatively, a gene name can be directly entered into the search field.</p><br><br>
				<img class="faq" src="./images/FAQ/step8_enterGene.png" alt="submit gene name">
				<p>The user may click "Next" to submit the gene name. 
				If the user did not enter a valid gene name, or no analysis is available for the gene entered by the user, a note will appear under the search field.
				If the gene name is valid, the user can progress to the next step and the gene name entered will be shown in the progress bar on the left.</p><br><br>
				<img class="faq" src="./images/FAQ/step9_sp_chooseAnalysis.png" alt="choose scatter plot analysis">
				<p>"RNA and DNA Copy Number Scatter Plot" can be chosen from the analysis option.  Options may be disabled when data is not available for analysis.</p><br><br>
				<img class="faq" src="./images/FAQ/step10_chooseCohort.png" alt="choose a cohort">
				<p>The user can choose a TCGA cohort. Options may be disabled when data is not available for analysis.</p><br><br>
				<img class="faq" src="./images/FAQ/step11_chooseCohort.png" alt="submit cohort option">
				<p>This is the final step for RNA and DNA copy number scatter plot analysis. The user may click "Submit" to view the result.
				If the user want to modify the previous steps, simply click "Previous" to go back.</p><br><br>
				<img class="faq" src="./images/FAQ/step12_sp_viewResult.png" alt="view scatter plot result">
				<p>A scatter plot for RNA and DNA copy number will be generated for the chosen gene and cohort. 
				To start another analysis, click "Reset" in the progress bar on the left.</p><br><br>
		    </div>
		</div>
		<!-- end panel -->
		
		<!-- panel -->
		<div class="accordion" id="section2">How do I run a co-expression analysis?<span></span></div>
		<div class="ACcontainer">
		    <div class="ACcontent">
				<img class="faq" src="./images/FAQ/step1_pickPathway.png" alt="click dropdown menu to select from KEGG pathway gene sets">
				<p>There are two ways to enter a gene for analysis. One way is to pick a gene from the KEGG pathway genes sets. 
				Click the "Pick from KEGG Pathways" button to release the dropdown menu.</p><br><br>
				<img class="faq" src="./images/FAQ/step2_pickPathway.png" alt="choose a pathway gene set">
				<p>The list includes 186 pathway gene sets from the KEGG Pathway database.</p><br><br>
				<img class="faq" src="./images/FAQ/step3_pickPathway.png" alt="browse genes from a pathway gene set">
				<p>The user can browse the genes from a chosen gene set.
				They can also go back by clicking the back arrow to choose from the other KEGG pathway gene sets.</p><br><br>
				<img class="faq" src="./images/FAQ/step4_pickPathway.png" alt="choose another pathway gene set">
				<p>Another pathway gene set can be chosen from the menu.</p><br><br>
				<img class="faq" src="./images/FAQ/step5_pickPathway.png" alt="pick a gene from the pathway gene set">
				<p>When the cursor rolls over the gene name, the description of the gene will be shown. 
				Clicking on the gene will send the gene name to the search field.</p><br><br>
				<img class="faq" src="./images/FAQ/step6_pickPathway.png" alt="pick a gene from the pathway gene set">
				<br><br>
				<img class="faq" src="./images/FAQ/step7_enterGene.png" alt="enter a gene from search field">
				<p>Alternatively, a gene name can be directly entered into the search field.</p><br><br>
				<img class="faq" src="./images/FAQ/step8_enterGene.png" alt="submit gene name">
				<p>The user may click "Next" to submit the gene name. 
				If the user did not enter a valid gene name, or no analysis is available for the gene entered by the user, a note will appear under the search field.
				If the gene name is valid, the user can progress to the next step and the gene name entered will be shown in the progress bar on the left.</p><br><br>
				<img class="faq" src="./images/FAQ/step9_co_chooseAnalysis.png" alt="choose coexpression analysis">
				<p>"Coexpression Analysis" can be chosen from the analysis options.  Options may be disabled when data is not available for analysis.</p><br><br>
				<img class="faq" src="./images/FAQ/step10_co_chooseCohort.png" alt="choose a cohort">
				<p>The user can choose a TCGA cohort. Options may be disabled when data is not available for analysis.</p><br><br>
				<img class="faq" src="./images/FAQ/step11_chooseMethod.png" alt="choose a sample method option">
				<p>The user may choose to use data from tumor samples or normal samples to run the coexpression analysis. 
				For tumor samples, the user can choose between the standard method and GRACE. The number of samples is also given in the option name. 
				Note that the GRACE method generally has fewer samples than the standard method because some samples were excluded due to the unavailability of DNA copy number data. 
				There might also be fewer genes returned by the GRACE method since genes with saturated DNA copy number levels are also excluded from the analysis.</p><br><br>
				<img class="faq" src="./images/FAQ/step12_submit.png" alt="submit">
				<p>Click "Submit" to retrieve coexpressing genes.</p><br><br>
				<img class="faq" src="./images/FAQ/step13_pickSetDB.png" alt="view coexpression result">
				<p>By default the co-expression analysis will show the top 100 positively correlated genes by Spearman rank correlation. 
				When the cursor rolls over the gene name, description of the gene will appear; clicking the gene name will open a new tab that takes the user to a gene report from <a href="http://biogps.org/#goto=welcome" target="_blank">BioGPS</a>
				There are several additional analysis options. 
				For enrichment analysis, a list of gene set databases is provided for the user to choose from.</p><br><br>
				<img class="faq" src="./images/FAQ/step14_submitEnrichmentAnalysis.png" alt="select gene set database for enrichment analysis">
				<p>After choosing a gene set database, click "Enrichment Analysis" to run the enrichment analysis based on the hypergeometric test.</p><br><br>
				<img class="faq" src="./images/FAQ/step15_viewEnrichmentAnalysisSet1.png" alt="submit enrichment analysis">
				<p>The result of the enrichment analysis will be given in a new table. 
				Nominal P-values and Benjamini Hochberg adjusted P-values will be given. 
				An "In Set" column will be added to the coexpression analysis result table to indicate whether the coexpressing genes belong to the selected gene set in the enriched gene set table. 
				</p><br><br>
				<img class="faq" src="./images/FAQ/step16_viewEnrichmentAnalysisSet2.png" alt="show a different enriched gene set">
				<p>
				User may select other enriched gene sets from the table to check where genes from the gene sets are located in the coexpression gene table. 
				</p><br><br>
				<img class="faq" src="./images/FAQ/step17_download.png" alt="download">
				<p>To download the full coexpression result, click "Download the Full Table".</p><br><br>
				<img class="faq" src="./images/FAQ/step18_download.png" alt="content of full table">
				<p>The downloaded CSV table will include the gene name, Spearman rank correlation coefficient, locus and description of the coexpressing genes.</p><br><br>
				<img class="faq" src="./images/FAQ/step19_refreshTable.png" alt="refresh options">
				<p>The user can also change the sorting order of the coexpression gene table and define the number of genes to be included in the coexpression analysis result. </p><br><br>
				<img class="faq" src="./images/FAQ/step20_refreshTableResult.png" alt="refresh result">
				<p>By click the "Refresh" button, the co-expression gene table will be refreshed with the customized parameters. 
				Users may also use this customized table for enrichment analysis.</p><br><br>
		    </div>
		</div>
		<!-- end panel -->
		
		<!-- panel -->
		<div class="accordion" id="section3">What is the source of the data?<span></span></div>
		<div class="ACcontainer">
		    <div class="ACcontent">
		        <p>
					mRNA expression data and GISTIC DNA copy number data for over 20 TCGA disease cohorts were downloaded from 
					<a href='http://firebrowse.org/' target="_blank">FIREHOSE</a>. 
		        	"illuminahiseq_rnaseqv2-RSEM_genes_normalized" was downloaded as the mRNA data and "all_data_by_genes" was downloaded as DNA copy number data.
		        	In the scatter plot analysis, data was retrieved from <a href="http://firebrowse.org/api-docs/" target="_blank">FIREBROWSE Web API</a>.
		        </p>
		        <p>
		        	Gene set libraries in the enrichment analysis are downloaded from 
		        	<a href="http://software.broadinstitute.org/gsea/downloads.jsp" target="_blank">Molecular Signatures Database (MSigDB)</a>,
		        	<a href="http://amp.pharm.mssm.edu/Enrichr/#stats" target="_blank">Enrichr</a>, and
		        	<a href="http://www.genenames.org/cgi-bin/genefamilies/" target="_blank">HGNC</a>.
		        </p>
		    </div>
		</div>
		<!-- end panel -->
		<!-- panel -->
		<div class="accordion" id="section4">Why are some genes not available for co-expression analysis?<span></span></div>
		<div class="ACcontainer">
		    <div class="ACcontent">
		        <p>
					In our co-expression analysis, we remove genes that are under-expressed in too many samples (when over 90% of the samples have 0 RSEM values).
					In addition, when GRACE is applied, we also filter out genes with saturated DNA copy number values so that both the RNA and DNA copy number of the same gene can be in linear range.
					For example, ERBB2, a frequently amplified oncogene has a relative DNA copy number of 3.657 in 97 of the 1080 tumor samples and is therefore filtered out.
		        </p>
		    </div>
		</div>
		<!-- end panel -->
		<!-- panel -->
		<div class="accordion" id="section5">Why are some cohorts or analysis options disabled?<span></span></div>
		<div class="ACcontainer">
		    <div class="ACcontent">
		        <p>
					There are several reasons. 
					In the case of co-expression analysis, some genes were filtered out because of under-expression or saturated DNA copy number (see answer to the previous question). 
					For cohorts with no DNA copy number data available, co-expression analysis with GRACE cannot be performed. 
					For cohorts with no normal sample data available, co-expression analysis for normal samples cannot be performed.				
		        </p>
		        <p>
		        	In the case of RNA and DNA Copy Number Scatter Plot generation, it is not available for cohorts without DNA copy number data.
		        </p>
		    </div>
		</div>
		<!-- end panel -->
		
		<!-- panel -->
		<div class="accordion" id="section6">Is login required?<span></span></div>
		<div class="ACcontainer">
		    <div class="ACcontent">
		        <p>
					No, login is not required – the website is open access.
		        </p>
		    </div>
		</div>
		<!-- end panel -->
		
		<!-- panel -->
		<div class="accordion" id="section7">Have a question not listed here?<span></span></div>
		<div class="ACcontainer">
		    <div class="ACcontent">
		    	<p>
					Questions, suggestions, opinions and criticism are all welcome! Email to <a href="mailto:ling.cai@utsouthwestern.edu" style="text-decoration:underline;">ling.cai@utsouthwestern.edu</a>
		        </p>
		    </div>
		</div>
		<!-- end panel -->
	</div>
	<!-- End of all Q/A pairs -->
	<div class="push"></div>
</div>
<?php include_once './footer.php';?>
<script>
activatePage('top-nav-faq')
</script>
</body>
</html>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Genomic Regression Analysis of Coordinated Expression - Analysis</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta name="Keywords" content="Regression, Copy Number, RNA, gene expression, correlation, co-expression"/>
<meta name="Description" content="Bioinformatic tool to retrieve correlated genes from tumor and normal tissue data based on a novel genomic regression method."/>

<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/grace.css">
<link rel="stylesheet" href="css/TypeaheadDrilldown.css">
<link href="css/multi_step_form.css" rel="stylesheet" type="text/css">

<script src="js/jquery-2.2.1.min.js"></script>
<!-- For highcharts -->
<script src="js/highcharts.js"></script>
<script src="js/highcharts_exporting.js"></script>
<!-- For the search box-->
<script src="js/typeahead.bundle.js"></script>
<!-- For dropdown -->
<script src="js/bootstrap.min.js"></script>
<!-- For step by step forms -->
<script src="js/multi_step_form.js"></script>
<!-- classList problem for IE -->
<script src="js/classList.min.js"></script>
</head>

<body class="analysis-body">
<div class="wrapper-main">
	<?php include_once 'header.php';?>
	
	<div class='container'>
		<div id="MSFprogressbar">
		<!-- Progress Bar -->
			<ul>
				<li id="firstStep" class="MSFactive">Enter a Gene Symbol</li>
				<span id='entered-gene'></span>
				<br>
				
				<li id="secondStep">Choose an Analysis</li>
				<span id='chosen-analysis'></span>
				<br>
				
				<li id="thirdStep">Pick a TCGA Cohort</li>
				<span id='picked-cohort'></span>
				<br>
				
				<li id="fourthStep" class="CA-only">Select Samples and Method</li>
				<span class="CA-only" id='selected-sampleMethod'></span>
				<br>
			</ul>
			
			<button onclick="reset()" id="reset">Reset</button>
		</div>
		
		<div class="analysis-content">
			<!-- Start of fieldset enter a gene -->
			<fieldset id="first" class="MSF card">
			<legend>Step 1: Enter a Gene Symbol</legend>
			<div class="typeahead-container">
				<!-- aligns the search field and the button for dropdown menu -->
				<div style="display:table">
					<div id="search-box" style="display:table-cell">
						<input class="typeahead" type="text" placeholder="Enter a Gene Symbol" id='search-gene' value='' name="gene" method="post">
					</div>
					<div class="dropdown" style="display:table-cell">
						<button onclick="toggleDropdown()" class="dropbtn">Pick from KEGG Pathways
							<i class="fa fa-caret-down"></i>
						</button>
					</div>
				</div>
				
				<!-- The following enables sliding contents -->
				<div id="pickPathwayContainer" class="contentContainer">
					<div id="wrapper">
						<div id="pathwaySuggest" class="content">
						<?php include_once'getKeggPathways.php'?>
						</div>
						
						<div id="geneSet" class="content">
						</div>
					</div>
				</div>
				
				<!-- This area is reserved for warnings when user enters invalid gene name, alias or genes with no analysis available -->
				<div id="geneValidation" style="color:#E52A6F;"></div>
				
			</div>
			<input class="next_btn" name="next" type="button" value="Next" onclick="checkGene()">
			</fieldset>
			<!-- End of fieldset enter a gene -->
			
			<!-- Start of fieldset choose an analysis -->
			<fieldset id="second" class="MSF card" >
				<legend>Step 2: Choose an Analysis</legend>
					<select id='choose-analysis'>
						<option value="RNA and DNA Copy Number Scatter Plot">RNA and DNA Copy Number Scatter Plot</option>	
						<option value="Co-expression Analysis">Co-expression Analysis</option>
					</select>
				<input class="pre_btn" name="previous" type="button" value="Previous" onclick="clearGene()">
				<input class="next_btn" name="next" type="button" value="Next" onclick="sendAnalysis(); setCohortOptions();">
			</fieldset>
			<!-- End of fieldset choose an analysis -->
	
			<!-- Start of fieldset choose a cohort -->
			<fieldset id="third" class="MSF card">
				<legend>Step 3: Pick a TCGA cohort</legend>
				<select id='TCGA-Cohort'>                    
				<?php include_once'cohort_options.php';?>
				</select>
				<input class="pre_btn" type="button" value="Previous" onclick="clearAnalysis()">
				<input class="next_btn CA-only" name="next" type="button" value="Next" onclick="sendCohort();setSampleMethodOptions();">
				<input class="submit_btn not-CA-only" type="submit" value="Submit" onclick = "sendCohort();showReset();generateScatterPlot();">
			</fieldset>
			<!-- End of fieldset choose a cohort -->
			
			<!-- Start of fieldset choose a sample/method -->
			<fieldset id="fourth" class="MSF card">
			<legend>Step 4: Select Samples and Method</legend>
				<select id='sampleMethod'>                    
					<option value="0"></option>
					<option value="1"></option>
					<option value="2"></option>
				</select>
				<input class="pre_btn" type="button" value="Previous" onclick="clearCohort()">
				<input class="submit_btn" type="submit" value="Submit" onclick="sendSampleMethod();showReset();generateCoexpressionAnalysisResult(grace.length='100',grace.order='asc',grace.setDB='0',grace.setID='-1');">
			</fieldset>
			<!-- End of fieldset choose a sample/method -->
			
			<!-- Scatter Plot Analysis Result -->
			<div id="scatterPlot" class="hide"></div>
			
			<!-- Start of Coexpression Analysis Result (3 parts) -->
			<div class="result">
				<!-- Part 1: coexpressing gene table -->
				<div id="CoexpressionAnalysisResult" class="card hide"></div>
				<!-- Part 2: followup analysis form -->
				<div id="CoexpFollowUp" class="card hide MSF">
					<form id="followUpForm">
						<div align="center"><input type="button" value="Download the Full Table" onclick="download();"><br></div>
						
						<div class="FollowUpSections">
							<div class="FollowUpInput">
								Sort genes by 
								<input type="radio" name="corTrend" value="asc" checked>Positive
								<input type="radio" name="corTrend" value="desc">Negative
								Correlation <br>
								Choose top <input type="number" name="quantity" min="20" max="3000" value=100> genes
							</div>
							<div class="FollowUpButton"><input type="button" value="Refresh Table" onclick ="refreshCoexpressionAnalysisResult();"></div>
						</div>
						
						<div class="FollowUpSections">
							<div class="FollowUpInput">
							Choose gene sets from
							<select id='setDB'>
									<option value="0" selected="true">KEGG Pathways</option>	
									<option value="1">HGNC Gene Families</option>
									<option value="2">REACTOME Pathways</option>
									<option value="3">Pathway Interaction Database (PID)</option>
									<option value="4">GO Biological Process</option>
									<option value="5">GO Cellular Component</option>
									<option value="6">GO Molecular Function</option>
									<option value="7">Human Phenotype Ontology</option>
									<option value="8">MGI Mammalian Phenotype</option>
									<option value="9">OMIM Disease</option>
									<option value="10">OMIM Expanded</option>
									<option value="11">CHEA</option>
									<option value="12">HMDB Metabolites</option>
							</select>
							</div>
							<div class="FollowUpButton"><input type="button" value="Enrichment Analysis" onclick = "enrichmentAnalysis();"></div>
						</div>
					</form>			
				</div>
				<!-- Part 3: Enrichment analysis table -->
				<div id="EnrichmentOutput" class="hide"></div>
			</div>
		</div>
	</div>
	<div class="push"></div>
</div>
<?php include_once 'footer.php';?>
<script>
//activate analysis in top navigation menu
activatePage('top-nav-analysis')
//initialize your global object called grace to store analysis input parameters
if (!window.grace) {
  window.grace = {
	analysis:'',
	cohort:'',
	sampleMethod:'',
	sampleMethodId:'',
	gene:'',
	validGene:null,
	id:'',

	length:'100',
	order:'asc',
	setDB:'0',
	setID:'-1'
  };
}

/* var analysis = '';
var cohort = '';
var sampleMethodId = '';
var gene = '';
var id = '';  */
//This is a general script that stores data from ajax calls
jQuery.extend({
    getValues: function(url) {
        var result = null;
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            async: false,
            success: function(data) {
                result = data;
            }
        });
       return result;
    }
});
//This script is for searching gene symbols, it is adpated from twitter typeahead basics
var geneSymbols = <?php include_once'getAllSymbols.php'; ?>;
var substringMatcher = function(strs) {
		return function findMatches(q, cb) {
	    var matches, substringRegex;

	    // an array that will be populated with substring matches
	    matches = [];

	    // regex used to determine if a string contains the substring `q`
	    substrRegex = new RegExp('^'+q, 'i');

	    // iterate through the pool of strings and for any string that
	    // contains the substring `q`, add it to the `matches` array
	    $.each(strs, function(i, str) {
	      if (substrRegex.test(str)) {
	        matches.push(str);
	      }
	    });

	    cb(matches.sort());
	  };
};
	
$('#search-box .typeahead').typeahead({
	hint: true,
	highlight: true,
	minLength: 1
	},
	{
	name: 'geneSymbols',
	source: substringMatcher(geneSymbols)
});

//This script is for displaying KEGG pathways from dropdown menu
function toggleDropdown() {
    $("#pickPathwayContainer").toggleClass("show");
}

//This script captures click events (outside the menu) to hide the dropdown menu
//Because it doesn't seem to work in IE need this additional function
function selectorMatches(el, selector) {
	var p = Element.prototype;
	var f = p.matches || p.webkitMatchesSelector || p.mozMatchesSelector || p.msMatchesSelector || function(s) {
		return [].indexOf.call(document.querySelectorAll(s), this) !== -1;
	};
	return f.call(el, selector);
}
window.onclick = function(e) {
	var et = e.target;
	if(!selectorMatches(et,'.dropbtn')){
		if(!selectorMatches(et,'#back-link')){
			if(!selectorMatches(et,'#back')){
				if(!selectorMatches(et.parentNode,'.content')){
					var dropdowns = document.getElementsByClassName("contentContainer");
				    for (var i = 0; i < dropdowns.length; i++) {
				      var openDropdown = dropdowns[i];
				      if (openDropdown.classList.contains('show')) {
				        openDropdown.classList.remove('show');
				      }
				    }
				}
			}
		}
	}
}

//This script is for displaying carets when mouse move over an item in the dropdown menu
$("#pathwaySuggest").on( "mouseover", function(event) {
	var ANode;
    var target = event.target; 
    while (target && target.parentNode !== this) {
        target = target.parentNode; // If the clicked element isn't a direct child
        if(!target) { return; } // If element doesn't exist
    }
    if (target.tagName === 'A'){
        ANode = target.childNodes[1];
        ANode.style.visibility = "visible";
    }
});
//This script is for displaying carets when mouse move out of an item in the dropdown menu
$("#pathwaySuggest").on( "mouseout", function(event) {
	var lNode;
    var target = event.target; 
    while (target && target.parentNode !== this) {
        target = target.parentNode; // If the clicked element isn't a direct child
        if(!target) { return; } // If element doesn't exist
    }
    if (target.tagName === 'A'){
        ANode = target.childNodes[1];
        ANode.style.visibility = "hidden";
    }
});
//This script is for displaying genes in the gene set when user click the name of the gene set the dropdown menu
$( "#pathwaySuggest" ).on( "click", function(event) {
	var transforms = ["transform",
	            "msTransform",
	            "webkitTransform",
	            "mozTransform",
	            "oTransform"];
	var transformProperty = getSupportedPropertyName(transforms);		
	var pickedPathway = null;
	var target = event.target; // Clicked element
    var translateValue = "translate(" + "-500px" + ", 0px)";
	$("#wrapper").css(transformProperty,translateValue);
    while (target && target.parentNode !== this) {
       target = target.parentNode; // If the clicked element isn't a direct child
        if(!target) { return; } // If element doesn't exist
    }
    if (target.tagName === 'A'){
        pickedPathway = $(target).text();
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
	           if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	               document.getElementById("geneSet").innerHTML = xmlhttp.responseText;
	           }
	       };
	       xmlhttp.open("GET","getGeneSet.php?q="+pickedPathway,true);
	       xmlhttp.send();
    }

});


//When user clicks on a gene from the KEGG pathway gene set, this script sends the gene to the search field and close the dropdown menu
$( "#geneSet" ).on( "click", "a", function() {
	if($(this).hasClass('subset')){
	var clickedText = $(this).text();
	   $('.typeahead').typeahead('val', clickedText);
	   var dropdowns = document.getElementsByClassName("contentContainer");
	   var i;
	   for (i = 0; i < dropdowns.length; i++) {
	     var openDropdown = dropdowns[i];
	     if (openDropdown.classList.contains('show')) {
	       openDropdown.classList.remove('show');
	     }
	   }
	}
});

 
// vendor prefix management (for sliding content in the dropdown menu
function getSupportedPropertyName(properties) {
    for (var i = 0; i < properties.length; i++) {
        if (typeof document.body.style[properties[i]] != "undefined") {
            return properties[i];
        }
    }
    return null;
}

//The following functions are called in getGeneSet.php
//This script is for going back to pathway list from geneset
function backToPathwayList(){
	var wrapper = document.querySelector("#wrapper");
	var transforms = ["transform",
	            "msTransform",
	            "webkitTransform",
	            "mozTransform",
	            "oTransform"];
	var transformProperty = getSupportedPropertyName(transforms);
	wrapper.style[transformProperty] = "translate(0,0)";
}
//This script is to change the color of the back arrow upon hover
function brightArrow(){
	document.getElementById('back').style.color="#E52A6F";
}
function darkArrow(){
	document.getElementById('back').style.color="#5F0F4E";
}


//The following lines are to pass entered values to progress bar
function checkGene(){
	document.getElementById('geneValidation').innerHTML = '';
	grace.gene = document.getElementById('search-gene').value;
	grace.gene = grace.gene.toUpperCase();
	var arrXhr = [];
	//if the gene name entered by the user can be matched to the existing list of gene symbols
	if(geneSymbols.indexOf(grace.gene)>-1){
		grace.validGene = true;
		arrXhr[0] = new XMLHttpRequest();
		arrXhr[0].onreadystatechange = function() {
			//send the gene name and related information to the progress bar
		if (arrXhr[0].readyState == 4 && arrXhr[0].status == 200) {
			var geneInfoAll = JSON.parse(arrXhr[0].responseText);
			var geneInfo = geneInfoAll['geneInfo'];
			document.getElementById('entered-gene').value = geneInfoAll['geneId'];
			document.getElementById('entered-gene').innerHTML = geneInfo;
			$("#firstStep").html('<i class="fa fa-pencil-square-o stepReset" onclick=reset()></i> Enter a Gene Symbol');
			}
		};
		arrXhr[0].open("GET","getGeneInfo.php?q="+grace.gene,true);
	 	arrXhr[0].send();

		//this XHR checks the analysis availability for the gene entered by the user and disable options if needed
	 	arrXhr[1] = new XMLHttpRequest();
	 	arrXhr[1].onreadystatechange = function() {
		if (arrXhr[1].readyState == 4 && arrXhr[1].status == 200) {
			var analysisOptions=arrXhr[1].responseText.split(',');
			if(analysisOptions[0]==1){
				document.getElementById('choose-analysis').options[0].disabled = false;
			}else{
				document.getElementById('choose-analysis').options[0].disabled = true;
				document.getElementById('choose-analysis').options[1].selected = true;
			}
			if(analysisOptions[1]==1){
				document.getElementById('choose-analysis').options[1].disabled = false;
			}else{
				document.getElementById('choose-analysis').options[1].disabled = true;
				document.getElementById('choose-analysis').options[0].selected = true;
			}
		}
		};
		arrXhr[1].open("GET","analysis_options.php?q="+grace.gene,true);
	 	arrXhr[1].send();

	}else{
		//if the gene entered by the user cannot be matched to existing list, it will be handeled by map2availableAliases.php
		grace.validGene = false;
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById('geneValidation').innerHTML = xmlhttp.responseText;
			}
		};
		xmlhttp.open("GET","map2availableAliases.php?q="+grace.gene,true);
	 	xmlhttp.send();
	 	document.getElementById('search-gene').value='';
	}
}

function sendAnalysis() {
	grace.analysis = $( "#choose-analysis" ).val();
	document.getElementById('chosen-analysis').innerHTML = grace.analysis;
	grace.id = document.getElementById('entered-gene').value;
	$("#secondStep").html('<i class="fa fa-pencil-square-o stepReset" onclick=resetAnalysis()></i> Choose An Analysis');
	
}
function sendCohort() {
	grace.cohort = $( "#TCGA-Cohort" ).val();
	document.getElementById('picked-cohort').innerHTML = grace.cohort;
	$("#thirdStep").html('<i class="fa fa-pencil-square-o stepReset" onclick=resetCohort()></i> Pick A TCGA Cohort');
}
function sendSampleMethod() {
	grace.sampleMethodId = $("#sampleMethod").val();
	document.getElementById('selected-sampleMethod').innerHTML = document.getElementById('sampleMethod').options[Number(grace.sampleMethodId)].text;
	$("#fourthStep").html('<i class="fa fa-pencil-square-o stepReset" onclick=resetSampleMethod()></i> Select Samples and Method');
	
}

//The following lines are to clear values from progress bar, it is called when users click the previous button or the reset button
function clearGene(){
	grace.gene = '';
	grace.validGene = false;
	document.getElementById('entered-gene').innerHTML = grace.gene;
	$("#firstStep").html('Enter a Gene Symbol');
}
function clearAnalysis(){
	grace.analysis = '';
	document.getElementById('chosen-analysis').innerHTML = grace.analysis;
	$("#secondStep").html('Choose an Analysis');
}
function clearCohort(){
	grace.cohort = '';
	document.getElementById('picked-cohort').innerHTML = grace.cohort;
	$("#thirdStep").html('Pick a TCGA Cohort');
}
function clearSampleMethod(){
	grace.sampleMethod = '';
	document.getElementById('selected-sampleMethod').innerHTML = grace.sampleMethod;
	$("#fourthStep").html('Select Samples and Method');
}

//The following lines are to display additional options based on type of analysis
function setCohortOptions(){
	var cohortOptions;
	function setOptions(){
		for(i=0;i<arguments[0].length;i++){
			//some cohorts are not available for the selected gene and analysis, disable them
			if(arguments[0][i]==0){
				document.getElementById('TCGA-Cohort').options[i].disabled = true;
			}else{
				document.getElementById('TCGA-Cohort').options[i].disabled = false;
			}
		}
		//select the first available option as default
		var e = document.getElementById("TCGA-Cohort");
		if(e.options[e.selectedIndex].disabled){
			document.getElementById('TCGA-Cohort').options[arguments[0].indexOf(1)].selected = true;
		}
	}

	//progress bar steps will be different based on the type of analysis
	if(grace.analysis==='Co-expression Analysis'){
		$(".CA-only").show();
		$(".not-CA-only").hide();
		xmlhttp = new XMLHttpRequest();
	 	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			cohortOptions=JSON.parse(xmlhttp.responseText);
			setOptions(cohortOptions);
		}
	};
		xmlhttp.open("GET","cohort_options_disabled.php?g="+grace.gene, true);
	 	xmlhttp.send();
	}else{
		$(".CA-only").hide();
		$(".not-CA-only").show();
	/* Script here to exclude LAML and MESO for the scatter plot analysis*/
		cohortOptions = Array.apply(null, Array(21)).map(Number.prototype.valueOf,1);
		cohortOptions[10] = 0;
		cohortOptions[15] = 0;
		setOptions(cohortOptions);	
	}
}
function setSampleMethodOptions(){
	var sampleMethodOptions;
	//some samples/methods are not available for particular genes/cohorts/analysis, the following function disable such options
	function setOptions(){
		for(i=0;i<arguments[0].length;i++){
			document.getElementById('sampleMethod').options[i].text = arguments[2][i];
			if(arguments[0][i]==0){
				document.getElementById('sampleMethod').options[i].disabled = true;
			}else{
				document.getElementById('sampleMethod').options[i].disabled = false;
				document.getElementById('sampleMethod').options[i].text =
					document.getElementById('sampleMethod').options[i].text.replace('-',("(").concat(arguments[1][i],")  -"));
			}
		}
		document.getElementById('sampleMethod').options[arguments[0].indexOf(1)].selected = true;
	}
	xmlhttp = new XMLHttpRequest();
 	xmlhttp.onreadystatechange = function() {
	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		var sampleMethodOptionsData=JSON.parse(xmlhttp.responseText);
		setOptions(sampleMethodOptionsData['samplemethodEnabled'],sampleMethodOptionsData['sampleNumber'],sampleMethodOptionsData['sampleMethodOptions']);
		}
	};
	xmlhttp.open("GET","samplemethod_options_disabled.php?g="+grace.gene+"&c="+grace.cohort, true);
 	xmlhttp.send();
}
//The following lines are to display Reset button on submit and hiding reset button on reset
function showReset(){
	document.getElementById('reset').style.display="block";
}
function resetAnalysis(){
	document.getElementById('reset').style.display="none";
	//clearGene();
	clearAnalysis();
	clearCohort();
	clearSampleMethod();
	$("li").removeClass("MSFactive");
	$("#firstStep").addClass("MSFactive");
	$("#secondStep").addClass("MSFactive");
	$(".MSF").hide();
	$("#second").show();
	$("#CoexpressionAnalysisResult").hide();
	$("#CoexpFollowUp").hide();
	$("#scatterPlot").hide();
	$("#EnrichmentOutput").hide();
	$("#EnrichmentOutput").removeClass("card");

	//$("#firstStep").html('Enter a Gene Symbol');
	$("#secondStep").html('Choose an Analysis');
	$("#thirdStep").html('Pick a TCGA Cohort');
	$("#fourthStep").html('Select Samples and Method');
	
	grace.length = '100';
	grace.order = 'asc';
	grace.setDB = '0';
	grace.setID = '-1';
}
function resetCohort(){
	document.getElementById('reset').style.display="none";
	//clearGene();
	//clearAnalysis();
	clearCohort();
	clearSampleMethod();
	$("li").removeClass("MSFactive");
	$("#firstStep").addClass("MSFactive");
	$("#secondStep").addClass("MSFactive");
	$("#thirdStep").addClass("MSFactive");
	$(".MSF").hide();
	$("#third").show();
	$("#CoexpressionAnalysisResult").hide();
	$("#CoexpFollowUp").hide();
	$("#scatterPlot").hide();
	$("#EnrichmentOutput").hide();
	$("#EnrichmentOutput").removeClass("card");

	//$("#firstStep").html('Enter a Gene Symbol');
	//$("#secondStep").html('Choose an Analysis');
	$("#thirdStep").html('Pick a TCGA Cohort');
	$("#fourthStep").html('Select Samples and Method');
	
	grace.length = '100';
	grace.order = 'asc';
	grace.setDB = '0';
	grace.setID = '-1';
}

function resetSampleMethod(){
	document.getElementById('reset').style.display="none";
	//clearGene();
	//clearAnalysis();
	//clearCohort();
	clearSampleMethod();
	$("li").removeClass("MSFactive");
	$("#firstStep").addClass("MSFactive");
	$("#secondStep").addClass("MSFactive");
	$("#thirdStep").addClass("MSFactive");
	$("#fourthStep").addClass("MSFactive");
	$(".MSF").hide();
	$("#fourth").show();
	$("#CoexpressionAnalysisResult").hide();
	$("#CoexpFollowUp").hide();
	$("#scatterPlot").hide();
	$("#EnrichmentOutput").hide();
	$("#EnrichmentOutput").removeClass("card");

	//$("#firstStep").html('Enter a Gene Symbol');
	//$("#secondStep").html('Choose an Analysis');
	//$("#thirdStep").html('Pick a TCGA Cohort');
	$("#fourthStep").html('Select Samples and Method');
	
	grace.length = '100';
	grace.order = 'asc';
	grace.setDB = '0';
	grace.setID = '-1';
}

function reset(){
	document.getElementById('reset').style.display="none";
	clearGene();
	clearAnalysis();
	clearCohort();
	clearSampleMethod();
	$("li").removeClass("MSFactive");
	$("#firstStep").addClass("MSFactive");
	$(".MSF").hide();
	$("#first").show();
	$("#CoexpressionAnalysisResult").hide();
	$("#CoexpFollowUp").hide();
	$("#scatterPlot").hide();
	$("#EnrichmentOutput").hide();
	$("#EnrichmentOutput").removeClass("card");

	$("#firstStep").html('Enter a Gene Symbol');
	$("#secondStep").html('Choose an Analysis');
	$("#thirdStep").html('Pick a TCGA Cohort');
	$("#fourthStep").html('Select Samples and Method');
	
	grace.length = '100';
	grace.order = 'asc';
	grace.setDB = '0';
	grace.setID = '-1';
}
//For Scatter Plot Analysis, adapted from Highcharts
function generateScatterPlot(){
	var $scatterPlotContainer = $('#scatterPlot');
	var RNA, CN;
	var RNAsamples = [];
	var COMMONsamples = [];
	var commonData = [];
	var RNAindex;
	var urlRNA, urlCN;
	var data = $.getValues("getRNACNsymbol.php?q="+grace.id);
	urlRNA = "http://firebrowse.org/api/v1/Samples/mRNASeq?format=json&gene="+data['RNA']+"&cohort="+grace.cohort+"&sample_type=TP&protocol=RSEM&page_size=2000&sort_by=tcga_participant_barcode";
	urlCN = "http://firebrowse.org/api/v1/Analyses/CopyNumber/Genes/All?format=json&cohort="+grace.cohort+"&gene="+data['CN']+"&page_size=2000&sort_by=tcga_participant_barcode";

<<<<<<< HEAD
	$scatterPlotContainer.html('<img id="loading" src="./images/ajax-loader.gif" alt="Loading" style="width:50px;height:50px;margin:100px;">');
=======
	$scatterPlotContainer.html('<img id="loading" src="images/ajax-loader.GIF" alt="Loading" style="width:50px;height:50px;margin:100px;">');
>>>>>>> Ling
	$scatterPlotContainer.show();
	$.when(
		$.ajax({
			   type: 'GET',
			   url: urlCN,
			   xhrFields: {
			      withCredentials: false
			   },
			   success: function(data) {
				   CN = data;
			   }
			}),
		$.ajax({
		   type: 'GET',
		   url: urlRNA,
		   xhrFields: {
		      withCredentials: false
		   },
		   success: function(data) {
			   RNA = data;
		   }
		})


	).then(function() {
	    if(RNA&&CN){
			for(i=0;i<RNA.mRNASeq.length;i++){
				RNAsamples.push(RNA.mRNASeq[i]['tcga_participant_barcode']);
			}
			for(i=0;i<CN.All.length;i++){
				var CNsample = CN.All[i]['tcga_participant_barcode'];
				RNAindex = RNAsamples.indexOf(CNsample);
				if(RNAindex>=0){
					COMMONsamples.push(CNsample);
					commonData.push([CN.All[i]['all_copy_number'],Math.round(100*(Math.pow(2,RNA.mRNASeq[RNAindex]['expression_log2'])-1))/100]);
					}
			}
			$("#loading").fadeOut('slow', function()
		            {
		                // without this the DOM will contain multiple elements
		                // with the same ID, which is bad.
		                $(this).remove();
		            });
			$('#scatterPlot').highcharts({
		        chart: {
		            type: 'scatter',
		            zoomType: 'xy'
		        },
		        title: {
		            text: 'DNA Copy Number Versus RNA Expression of '+commonData.length+' '+grace.cohort+' tumor samples'
		        },
		        subtitle: {
		            text: 'Source: TCGA'
		        },
		        xAxis: {
		            title: {
		                enabled: true,
		                text: 'Relative Copy Number'
		            },
		            startOnTick: true,
		            endOnTick: true,
		            showLastLabel: true
		        },
		        yAxis: {
		            title: {
		                text: 'RNA-seq V2 RSEM gene normalized'
		            },
		            labels: {
			            formatter: function() {
			                return this.value.toExponential(0); // 2 digits of precision
			            }
		            }
		        },
		        legend: {
		            layout: 'vertical',
		            verticalAlign: 'top',
		            align: 'right',
		            floating: true,
		            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
		            borderWidth: 1,
	            	y:50
		        },
		        credits: {
		            enabled: false
		        },
		        exporting: { 
			        enabled: true 
			    },
		        plotOptions: {
		            scatter: {
		                marker: {
		                    radius: 5,
		                    states: {
		                        hover: {
		                            enabled: true,
		                            lineColor: 'rgb(100,100,100)'
		                        }
		                    }
		                },
		                states: {
		                    hover: {
		                        marker: {
		                            enabled: false
		                        }
		                    }
		                },
		                tooltip: {
		                    headerFormat: '<b>{series.name}</b><br>',
		                    pointFormat: '{point.x}, {point.y}'
		                }
		            }
		        },
		        series: [{
		            name: grace.gene,
		            color: 'rgba(229, 42, 111, .5)',
		            data: commonData
		        }]
		    }).fadeIn('slow');

	    }
	});
		
}
// For coexpression analysis table 
function generateCoexpressionAnalysisResult(){
	var $coexp = $('#CoexpressionAnalysisResult');
<<<<<<< HEAD
	$coexp.html('<img id="loading" src="./images/ajax-loader.gif" alt="Loading" style="width:50px;height:50px;margin-left:auto;margin-right:auto;margin-top:150px;display:block;">');
=======
	$coexp.html('<img id="loading" src="images/ajax-loader.GIF" alt="Loading" style="width:50px;height:50px;margin-left:auto;margin-right:auto;margin-top:150px;display:block;">');
>>>>>>> Ling
	xmlhttp = new XMLHttpRequest();
 	xmlhttp.onreadystatechange = function() {
	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		var coexpTable=JSON.parse(xmlhttp.responseText);
		var ids = coexpTable['ids'];
		var symbols = coexpTable['symbols'];
		var locus = coexpTable['locus'];
		var description = coexpTable['description'];
		var entrezID = coexpTable['entrezID'];
		var coefs = coexpTable['coefs'];
		if(grace.setID>=0){
			var inSetIds = coexpTable['inSetIds'];
		}
		var tr=[];

		tr.push('<table id="geneTable">');
		tr.push('<tr>');
		tr.push('<th>Rank</th>');
		tr.push('<th>Gene</th>');
		tr.push('<th>Rho</th>');
		tr.push('<th>Cytoband</th>');
		if(grace.setID>=0){
			tr.push('<th>In Set</th>');
		}
		tr.push('</tr>');
		for (var i = 0; i < description.length; i++) {
		    tr.push('<tr>');
		    tr.push("<td>" + (i+1) + "</td>");
		    tr.push('<td><a style="text-decoration: underline;" href="http://biogps.org/#goto=genereport&id='+entrezID[i]+'" title="'+description[i]+'" target="_blank">' + symbols[i].symbol + '</a></td>');
		    tr.push("<td>" + coefs[i] + "</td>");
		    tr.push("<td>" + locus[i] + "</td>");
		    if(grace.setID>=0){
				if(inSetIds.indexOf(ids[i])>=0){
					tr.push('<td class="inSet"><i class="inSet fa fa-circle"></i></td>');
				}else{
					tr.push('<td></td>');
				}
			}
		    tr.push('</tr>');
		}
		tr.push('</table>');
		$coexp.html($(tr.join('')));
	    $coexp.show();
	    if(grace.setID<0){
	    	var $followUp = $('#CoexpFollowUp');
		    $followUp.show();
	    }	
	}
};
	xmlhttp.open("GET","coexpResultTable.php?id="+grace.id+"&cohort="+grace.cohort+"&method="+grace.sampleMethodId+"&length="+grace.length+"&order="+grace.order+"&setID="+grace.setID+"&setDB="+grace.setDB, true);
 	xmlhttp.send();   
}
//This function refresh the result of coexpression table
function refreshCoexpressionAnalysisResult(){
	grace.length = $('#followUpForm').find('input[name="quantity"]').val();
	grace.order = $('input[name=corTrend]:checked', '#followUpForm').val();
	//when setID is negative, the 'Inset' column will disappear
	grace.setID = '-1';
	generateCoexpressionAnalysisResult();
	$('#EnrichmentOutput').hide();
}
//The following enrichment analysis is based on hypergeometric test
function enrichmentAnalysis(){
	var $output = $('#EnrichmentOutput');
<<<<<<< HEAD
	$output.html('<img id="loading" src="./images/ajax-loader.gif" alt="Loading" style="display:block;margin:auto;padding-top:50px;width:50px;">');
=======
	$output.html('<img id="loading" src="images/ajax-loader.GIF" alt="Loading" style="display:block;margin:auto;padding-top:50px;width:50px;">');
>>>>>>> Ling
	grace.length = $('#followUpForm').find('input[name="quantity"]').val();
	grace.order = $('input[name=corTrend]:checked', '#followUpForm').val();
	grace.setDB = $('#setDB').val();
	/* Adapted from http://stackoverflow.com/questions/1885557/simplest-code-for-array-intersection-in-javascript */
	function intersection_destructive(a, b)
	{
	  var result = [];
	  while( a.length > 0 && b.length > 0 )
	  {  
	     if      (a[0] < b[0] ){ a.shift(); }
	     else if (a[0] > b[0] ){ b.shift(); }
	     else /* they're equal */
	     {
	       result.push(a.shift());
	       b.shift();
	     }
	  }

	  return result;
	}
	/* http://mathworld.wolfram.com/StirlingsApproximation.html */
	function lnFatorial(n){
		var lnFact;
		lnFact = Math.log(Math.sqrt((2*n+1/3)*Math.PI))+n*(Math.log(n)-1);
		return(lnFact);
	}
	function lnComb(x,y){
		return (lnFatorial(x)-lnFatorial(y)-lnFatorial(x-y))
	}

	function dhyper(m,n,N,x){
		/* m be population positive
		   n be population negative
		   N be subpopulaton
		   x be positives in subpopulation */
		var Prob = lnComb(m,x)+lnComb(n,N-x)-lnComb(m+n,N);
		return(Math.exp(Prob));
	}
	function phyper(m,n,N,x){
		var sumProb = 0;
		for(var i = x; i<m; i++){
			var d = dhyper(m,n,N,i);
			if(!isNaN(d)){
				sumProb += d;
			}
		}
		return(sumProb);
	}
	function pAdjust(x){
		/* adjusted p-value from Benjamini Hochberg Procedure
		start from sorted p-value */
		var testP = [];
		var adjP = [];
		for(var i = 0; i < x.length; i++){
			testP[i] = x.length/(i+1)*x[i];
		}
		for(var i = 0; i < x.length; i++){
			adjP[i] = Math.min.apply(null,testP.slice(i));
		}
		return(adjP);
	}
	
	
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	if (xmlhttp.readyState == 4 && xmlhttp.status ==200){
		var data = JSON.parse(xmlhttp.responseText);
		var allIds = data['allIds'];
		var ids = data['topIds'];
		var geneSets = data['geneSets'];
		ids.sort(function(a, b){return a-b});
		allIds.sort(function(a, b){return a-b});
		var inSet = [];
		var hyperScore = [];
		var pathwayIds = [];
		var pathwayNames = [];
		for(var i=0; i<geneSets.length; i++){
			var x = geneSets[i]['gene_id'].slice(0);
			x.sort(function(a, b){return a-b});	
			var y = ids.slice(0);
			pathwayNames[i] = geneSets[i]['pathway'];
			inSet[i] = intersection_destructive(x,y).length;
			hyperScore [i] = phyper(geneSets[i]['gene_id'].length,(allIds.length-geneSets[i]['gene_id'].length),ids.length,inSet[i]);
			}
		var hyperScoreRanked = hyperScore.slice(0);
		hyperScoreRanked.sort(function(a, b){return a-b});
		var pathwayNamesRanked = [];
		var insetRanked = [];
		for(var i=0; i<geneSets.length; i++){
			pathwayIds[i] = hyperScore.indexOf(hyperScoreRanked[i]);
			insetRanked[i] = inSet[hyperScore.indexOf(hyperScoreRanked[i])];
			hyperScore[pathwayIds[i]] = 1.1; //to prevent duplicates in the next iteration, since indexOf only returns the first match
			pathwayNamesRanked[i] = pathwayNames[pathwayIds[i]];
		}
		var pAdjustedHP = pAdjust(hyperScoreRanked);
		var tr=[];
		tr.push('<table id="setTable">');
		tr.push('<tr>');
		tr.push('<th></th>');
		tr.push('<th>Rank</th>');
		tr.push('<th>Gene Set</th>');
		tr.push('<th>P-value</th>');
		tr.push('<th>adjusted P-value</th>');
		tr.push('</tr>');
		for (var i = 0; i < 10; i++) {
			if(insetRanked[i]==0) break;
		    tr.push("<td><input type='radio' name='enrichedSet' value = " + pathwayIds[i] +"></td>");
		    tr.push("<td>" + (i+1) + "</td>");
		    tr.push("<td>" + pathwayNamesRanked[i] + "</td>");
		    tr.push("<td>" + hyperScoreRanked[i].toExponential(2) + "</td>");
		    tr.push("<td>" + pAdjustedHP[i].toExponential(2) + "</td>");
		    tr.push('</tr>');
		}
		tr.push('</table>');
		$output.html($(tr.join('')));
		$output.show();
		$output.addClass("card");
		$("input:radio[name='enrichedSet']:first").attr('checked', true);
		showEnrichedGenes();
		prepareSetSelection();
		}
	}
	xmlhttp.open("GET","getEnrichment.php?method="+grace.sampleMethodId+"&cohort="+grace.cohort+"&id="+grace.id+"&length="+grace.length+"&order="+grace.order+"&setDB="+grace.setDB,true);
 	xmlhttp.send();
}

function showEnrichedGenes(){
	var radVal =$("input:radio[name='enrichedSet']:checked").val();
	grace.setID = radVal;
	generateCoexpressionAnalysisResult();
}

function prepareSetSelection(){
	var rad=$("input:radio[name='enrichedSet']").get();
	var prev = rad[0];
	for(var i = 0; i < rad.length; i++) {
	    rad[i].onclick = function() {
	        if(this !== prev) {
	            prev = this;
 	        	generateCoexpressionAnalysisResult(grace.setID=this.value);
	        }
	    };
	}
}

function download(){
	$.ajax({
	    url: 'downloadFullCoexpResult.php',
	    type: 'POST',
	    success: function() {
	        window.location = "downloadFullCoexpResult.php?gene="+grace.gene+"&id="+grace.id+"&method="+grace.sampleMethodId+"&cohort="+grace.cohort;
	    }
	});
}
</script>

</body>
</html>

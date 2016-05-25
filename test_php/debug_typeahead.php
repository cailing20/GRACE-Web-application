<!DOCTYPE html>
<html>
<head>
<title>Genomic Regression Analysis of Coordinated Expression - Analysis</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Keywords" content="Regression, Copy Number, RNA, gene expression, correlation, co-expression">
<meta name="Description" content="Bioinformatic tool to retrieve correlated genes from tumor and normal tissue data based on a novel genomic regression method.">

<!-- For the home icon -->
<link rel="stylesheet" href="./css/font-awesome.min.css">
<link rel="stylesheet" href="./css/w3.css">
<link rel="stylesheet" href="./css/grace.css">
<link rel="stylesheet" href="./css/debug_typeahead.css">

<script src="./js/jquery-2.2.1.min.js"></script>



<!-- For the search box-->
<script src="./js/typeahead.bundle.js"></script>


</head>

<body>



<div class="typeahead-container">
	<span id="search-box">
		<input class="typeahead" type="text" placeholder="Enter a Gene Symbol" id='search-gene' value='' name="gene" method="post">
	</span>
	
	<div class="dropdown">
		<button onclick="toggleDropdown()" class="dropbtn">Pick from KEGG Pathways
			<i class="fa fa-caret-down"></i>
		</button>
	
		<div id="pickPathwayContainer" class="contentContainer">
			<div id="wrapper">
				<div id="pathwaySuggest" class="content">
				<?php include_once'./getKeggPathways.php'?>
				</div>
				
				<div id="geneSet" class="content">
				</div>
			</div>
		</div>
	</div>
	<div id="geneValidation" style="color:#E52A6F;"></div>
</div>


<script>
//This script is for searching gene symbols, it is adpated from twitter typeahead basics
var geneSymbols = <?php include_once'./getAllSymbols.php'; ?>;
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
</script>

<script>
//This script is for displaying KEGG pathways from dropdown menu
function toggleDropdown() {
    document.getElementById("pickPathwayContainer").classList.toggle("show");
}




window.onclick = function(event) {
	if ((!event.target.matches('.dropbtn'))&&(!event.target.parentNode.matches('.content'))) {
	var dropdowns = document.getElementsByClassName("contentContainer");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<script>
//This script is for displaying and hiding carets when mouse move over an item in the dropdown menu
 var pickPath = document.getElementById('pathwaySuggest'); // Parent
 pickPath.addEventListener('mouseover', function (e) {
	 var ANode;
     var target = e.target; 
     while (target && target.parentNode !== pickPath) {
         target = target.parentNode; // If the clicked element isn't a direct child
         if(!target) { return; } // If element doesn't exist
     }
     if (target.tagName === 'A'){
         ANode = target.childNodes[1];
         ANode.style.visibility = "visible";
     }
 });
 pickPath.addEventListener('mouseout', function (e) {
	 var lNode;
     var target = e.target; 
     while (target && target.parentNode !== pickPath) {
         target = target.parentNode; // If the clicked element isn't a direct child
         if(!target) { return; } // If element doesn't exist
     }
     if (target.tagName === 'A'){
         ANode = target.childNodes[1];
         ANode.style.visibility = "hidden";
     }
 });

 //This script for requesting genes from the clicked geneset coupled to php
 $( "#geneSet" ).on( "click", "a", function() {
	 if($(this).hasClass('subset')){
		  var clickedText = $( this ).text();
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
 var pickedPathway = null;

 

 pickPath.addEventListener('click', function (e) {
     var target = e.target; // Clicked element
     var translateValue = "translate3d(" + "-500px" + ", 0px, 0)";
     while (target && target.parentNode !== pickPath) {
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
	        xmlhttp.open("GET","./getGeneSet.php?q="+pickedPathway,true);
	        xmlhttp.send();
     }
     wrapper.style[transformProperty] = translateValue;
 });
 </script>
 <script>
//This script is for sliding contents between pathways and genesets
// Dealing with Transforms
//
var wrapper = document.querySelector("#wrapper");
var transforms = ["transform",
            "msTransform",
            "webkitTransform",
            "mozTransform",
            "oTransform"];
 
var transformProperty = getSupportedPropertyName(transforms);
 
// vendor prefix management
function getSupportedPropertyName(properties) {
    for (var i = 0; i < properties.length; i++) {
        if (typeof document.body.style[properties[i]] != "undefined") {
            return properties[i];
        }
    }
    return null;
}
 </script>
 <script>
//This script is for going back to pathway list from geneset
function backToPathwayList(){
	wrapper.style[transformProperty] = "translate3d(0,0,0)";
}
 </script>
  <script>
//This script is to change the color of the back arrow upon hover
function brightArrow(){
	document.getElementById('back').style.color="#E52A6F";
}
function darkArrow(){
	document.getElementById('back').style.color="#5F0F4E";
}
 </script>


</body>
</html>
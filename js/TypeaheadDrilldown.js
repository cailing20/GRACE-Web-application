//This script is for searching gene symbols, it is adpated from twitter typeahead basics
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
    document.getElementById("pickPathwayContainer").classList.toggle("show");
}
$('.contentContainer').on('click', function(event){
    // The event won't be propagated up to the document NODE and 
    // therefore delegated events won't be fired
    event.stopPropagation();
});
window.onclick = function(event) {
	if (!event.target.matches('.dropbtn')) {
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
 
 
//This script is for going back to pathway list from geneset
function backToPathwayList(){
	wrapper.style[transformProperty] = "translate3d(0,0,0)";
}
 
  
//This script is to change the color of the back arrow upon hover
function brightArrow(){
	document.getElementById('back').style.color="#E52A6F";
}
function darkArrow(){
	document.getElementById('back').style.color="#5F0F4E";
}
 
 
 //This script is used to change caret direction for drop down button
 $(document).ready(function(){
  $(".dropdown").on("hide.bs.dropdown", function(){
    $(".btn").html('Dropdown <span class="caret"></span>');
  });
  $(".dropdown").on("show.bs.dropdown", function(){
    $(".btn").html('Dropdown <span class="caret caret-up"></span>');
  });
});
 
 
 
 //This script is to pass clicked gene from geneset to input
 var geneSet = document.getElementById('geneSet'); 
 geneSet.addEventListener('click', function (e) {
	 var pathwayTitle = document.getElementById('pathwayTitle')
	 var backLink = document.getElementById('back-link')
	 var target = e.target;
	 if ((target !== pathwayTitle)&&(target !== backLink)){
		    var clickedText = $(target).text();
		    $('.typeahead').typeahead('val', '');
		    document.getElementById('search-gene').value = clickedText;
    }
 });
 

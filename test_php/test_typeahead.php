<!DOCTYPE html>
<html>
<head>
<title>Genomic Regression Analysis of Coordinated Expression - Analysis</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="Keywords" content="Regression, Copy Number, RNA, gene expression, correlation, co-expression">
<meta name="Description" content="Bioinformatic tool to retrieve correlated genes from tumor and normal tissue data based on a novel genomic regression method.">


<link rel="stylesheet" href="./css/debug_typeahead.css">

<script src="./js/jquery-2.2.1.min.js"></script>



<!-- For the search box-->
<script src="./js/typeahead.bundle.js"></script>


</head>
<div id="the-basics">
  <input class="typeahead" type="text" placeholder="Enter a Symbol">
</div>

<script>
var geneSymbols = <?php include_once'./getAllSymbols.php'; ?>;
var substringMatcher = function(strs) {
	  return function findMatches(q, cb) {
	    var matches, substringRegex;

	    // an array that will be populated with substring matches
	    matches = [];

	    // regex used to determine if a string contains the substring `q`
	    substrRegex = new RegExp(q, 'i');

	    // iterate through the pool of strings and for any string that
	    // contains the substring `q`, add it to the `matches` array
	    $.each(strs, function(i, str) {
	      if (substrRegex.test(str)) {
	        matches.push(str);
	      }
	    });

	    cb(matches);
	  };
	};
	$('#the-basics .typeahead').typeahead({
	  hint: true,
	  highlight: true,
	  minLength: 1
	},
	{
	  name: 'geneSymbols',
	  source: substringMatcher(geneSymbols)
	});
</script>
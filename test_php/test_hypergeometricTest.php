<script src="./js/jquery-2.2.1.min.js"></script>
<div id="output">

</div>

<script>

(function hypergeometricTest(){
	var $output = $('#output');
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
	function dhyper(m,n,N,x){
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
		console.log(x.length);
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
		for(var i=0; i<geneSets.length; i++){
			pathwayIds[i] = hyperScore.indexOf(hyperScoreRanked[i]);
			hyperScore[pathwayIds[i]] = 1; //to prevent duplicates in the next iteration, since indexOf only returns the first match
			pathwayNamesRanked[i] = pathwayNames[pathwayIds[i]];
		}
		var pAdjustedHP = pAdjust(hyperScoreRanked);
		console.log(inSet);
		console.log(hyperScore);
		console.log(pathwayNamesRanked);
		console.log(pAdjustedHP);
		var tr=[];
		tr.push('<table id="setTable">');
		tr.push('<tr>');
		tr.push('<th></th>');
		tr.push('<th>Rank</th>');
		tr.push('<th>Gene Set</th>');
		tr.push('<th>P-value</th>');
		tr.push('<th>adjusted P-value</th>');
		tr.push('</tr>');
		for (var i = 0; i < hyperScore.length; i++) {
		    tr.push("<td><input type='radio' name=" + pathwayNamesRanked[i] + "value = " + pathwayIds[i] +"></td>");
		    tr.push("<td>" + (i+1) + "</td>");
		    tr.push("<td>" + pathwayNamesRanked[i] + "</td>");
		    tr.push("<td>" + hyperScoreRanked[i].toExponential(2) + "</td>");
		    tr.push("<td>" + pAdjustedHP[i].toExponential(2) + "</td>");
		    tr.push('</tr>');
		}
		tr.push('</table>');
		$output.html($(tr.join('')));
		}
	}
	xmlhttp.open("GET","./test.php?method=0&cohort=COAD&id=2949&length=100&order=asc&setDB=0",true);
 	xmlhttp.send();
})();
</script>


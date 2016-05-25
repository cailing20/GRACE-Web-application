<script src="./js/jquery-2.2.1.min.js"></script>
<input id="input" type="text" value="A2MP1"/>
<div id="output"></div>

<script>

var gene = document.getElementById('input').value;

// gene = document.getElementById('search-gene').value;
var geneSymbols = <?php include './getAllSymbols.php'; ?>;	
if(geneSymbols.indexOf(gene)>-1){
// 	document.getElementById('entered-gene').innerHTML = gene;
	document.getElementById('output').innerHTML = "validated";
}else{
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		document.getElementById("output").innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET","./map2availableAliases.php?q="+gene,true);
    xmlhttp.send();
}


</script>
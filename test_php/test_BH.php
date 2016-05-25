<script>
function pAdjust(x){
	/* adjusted p-value from Benjamini Hochberg Procedure
	start from sorted p-value */
	var testP = [];
	var adjP = [];
	console.log(x.length);
	for(var i = 0; i < x.length; i++){
		testP[i] = x.length/(i+1)*x[i];
	}
	console.log(testP);
	function adjust(x){
		return(Math.min(x));
	}
	for(var i = 0; i < x.length; i++){
		adjP[i] = Math.min.apply(null,testP.slice(i));
	}
	return(adjP);
}
var pvals = [0.001,0.008,0.039,0.041,0.042,0.06,0.074,0.205,0.212,0.216,0.222,0.251,0.269,
             0.275,0.34,0.341,0.384,0.569,0.594,0.696,0.762,0.94,0.942,0.975,0.986];
console.log(pAdjust(pvals));
</script>
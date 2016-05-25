<script>
function lnFatorial(n){
	var lnFact = Math.log(Math.sqrt((2*n+1/3)*Math.PI))+n*(Math.log(n)-1);
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
		if(!isNan(d)){
			sumProb += d;
		}
	}
	return(sumProb);
}



</script>
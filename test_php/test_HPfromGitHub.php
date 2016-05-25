<script>
/* Adapted from https://gist.github.com/trevnorris/c39ac96740842e05303f */
function hyper(x, n, m, nn) {
	var Prob;
	if (2 * m > nn) {
	      if (2 * n > nn) {
	        Prob = hyp(nn - m - n + x, nn - n, nn - m, nn);
	      } else {
	        Prob = 1 - hyp(n - x - 1, n, nn - m, nn);
	      }
	    } else if (2 * n > nn) {
	      Prob = 1 - hyp(m - x - 1, m, nn - n, nn);
	    } else {
	      Prob = hyp(x, n, m, nn)
	    }
	  function hyp(x,n,m,nn){
		  var nz, mz;
		  // best to have n<m
		  if (m < n) {
		    nz = m;
		    mz = n
		  } else {
		    nz = n;
		    mz = m
		  }
		  var h=1;
		  var s=1;
		  var k=0;
		  var i=0;
		  while (i < x) {
		    while (s > 1 && k < nz) {
		      h = h * (1 - mz / (nn - k));
		      s = s * (1 -mz / (nn - k));
		      k = k + 1;
		    }
		    h = h * (nz - i) * (mz - i) / (i + 1) / (nn - nz - mz + i + 1);
		    s = s + h;
		    i = i + 1;
		  }
		  while (k < nz) {
		    s = s * (1 - mz / (nn - k));
		    k = k + 1;
		  }
		  return s;
		  }
	  Prob = Math.round(Prob * 100000) / 100000;
	  return(Prob);
}
	</script>
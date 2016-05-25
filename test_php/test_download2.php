<script src="./js/jquery-2.2.1.min.js"></script>
<button onclick="download();">Download File</button>

<script>
var graceid='14557';
var gracesampleMethodId='1';
var gracecohort='BRCA';
function download(){
	$.ajax({
	    url: './downloadFullCoexpResult.php',
	    type: 'POST',
	    success: function() {
	        window.location = "./downloadFullCoexpResult.php?id="+grace.id+"&method="+grace.sampleMethodId+"&cohort="+grace.cohort;
	    }
	});
}

</script>
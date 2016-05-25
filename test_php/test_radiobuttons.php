<div id='test'>
Radio button1: <input type="radio" name="colors" value='a'>
Radio button2: <input type="radio" name="colors" value='b'>
Radio button3: <input type="radio" name="colors" value='c'>
Radio button1: <input type="radio" name="animals" value='d'>
Radio button2: <input type="radio" name="animals" value='e'>
Radio button3: <input type="radio" name="animals" value='f'>
</div>
<script src="./js/jquery-2.2.1.min.js"></script>
<script>
$("input:radio[name='animals']:first").attr('checked', true);
(function(){
	var rad=$("input:radio[name='colors']").get();
	var prev = rad[0];
	for(var i = 0; i < rad.length; i++) {
	    rad[i].onclick = function() {
		    console.log('clicked!');
	/* 	        (prev)? console.log(prev.value):null;
	*/	        if(this !== prev) {
	            prev = this;
	        	console.log(this.value);
	        }
	    };
	}
})();
</script>
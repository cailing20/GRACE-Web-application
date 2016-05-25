<script>
var x=1;
var y=0;
function test(x){
	if(x>1){console.log('x>1');}else if(x==1){console.log('x=1');}else{console.log('x<1');}
}
test();
test(x);
test(x=2,y=3);
console.log(x);
console.log(y);
</script>
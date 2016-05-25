<p><?php 
$arr = [1,2,3,4,5];
$order = 'desc';
$length=3;
if($order=='asc'){
	$ids = array_slice($arr,0,$length);
}else{
	$ids = array_slice($arr,-$length,$length);
}
$ids=array_reverse($ids);
echo json_encode($ids);
?></p>
<?php 
/* $method = '1';
$cohort = 'BRCA';
$id = '8475';
$length = '100';
$order = 'asc';
$setDB = '0'; */
$method = $_GET['method'];
$cohort = $_GET['cohort'];
$id = $_GET['id'];
$length = $_GET['length'];
$order = $_GET['order'];
$setDB = $_GET['setDB'];

$methods = ["tumor_RNA","tumor_RES","normal"];
$fileName = "file:///Z:/TCGA_NeighborProject/Website/Database/JSON/".$methods[$method]."/".$cohort."/";
$fileName.= strval(200*floor($id/200)+1)."-".strval(200*ceil($id/200))."/".$id.".json";
$json = file_get_contents($fileName);
$coexpResult = json_decode($json,true);
if($order=='asc'){
	$ids = array_slice($coexpResult['id'],0,$length);
}else{
	$ids = array_slice($coexpResult['id'],-$length,$length,true);
}

$setDBs=["kegg","GeneFamily"];
$fileName = "./json/".$setDBs[$setDB].".json";
$json = file_get_contents($fileName);
$geneSets = json_decode($json,true);



$data = array();
$data['topIds'] = $ids;
$data['geneSets'] = $geneSets;
$data['allIds'] = $coexpResult['id'];
echo json_encode($data);
?>

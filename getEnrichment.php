<?php 
/* $method = '1';
$cohort = 'BRCA';
$id = '8475';
$length = '100';
$order = 'asc';
$setDB = '0'; */
$method = trim(stripslashes(htmlspecialchars($_GET['method'])));
$cohort = trim(stripslashes(htmlspecialchars($_GET['cohort'])));
$id = trim(stripslashes(htmlspecialchars($_GET['id'])));
$length = trim(stripslashes(htmlspecialchars($_GET['length'])));
$order = trim(stripslashes(htmlspecialchars($_GET['order'])));
$setDB = trim(stripslashes(htmlspecialchars($_GET['setDB'])));

$methods = ["tumor_RNA","tumor_RES","normal"];
$fileName = "/mnt/database/JSON/".$methods[$method]."/".$cohort."/";
$fileName.= strval(200*floor($id/200)+1)."-".strval(200*ceil($id/200))."/".$id.".json";
$fileName = realpath($fileName);
if ( "/mnt/database/JSON/" == substr($fileName, 0 , 19)) {
  $json = file_get_contents($fileName);
} else {
  header("Location:index.php");
}
$coexpResult = json_decode($json,true);
if($order=='asc'){
	$ids = array_slice($coexpResult['id'],0,$length);
}else{
	$ids = array_slice($coexpResult['id'],-$length,$length);
}

$setDBs=["kegg","GeneFamily","REACTOME","PID","GO_BIOLOGICAL_PROCESS_2015","GO_CELLULAR_COMPONENT_2015","GO_MOLECULAR_FUNCTION_2015",
		"HUMAN_PHENOTYPE_ONTOLOGY","MGI_MAMMALIAN_PHENOTYPE_2013","OMIM_DISEASE","OMIM_EXPANDED","CHEA_2015",
		"HMDB_METABOLITES"];
$fileName = "./json/".$setDBs[$setDB].".json";
$fileName = realpath($fileName);
if ( "/mnt/database/JSON/" == substr($fileName, 0 , 19)) {
  $json = file_get_contents($fileName);
} else {
  header("Location:index.php");
}
$geneSets = json_decode($json,true);



$data = array();
$data['topIds'] = $ids;
$data['geneSets'] = $geneSets;
$data['allIds'] = $coexpResult['id'];
echo json_encode($data);
?>

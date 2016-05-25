<?php
$method = $_GET['method'];
$cohort = $_GET['cohort'];
$id = $_GET['id'];
$length = $_GET['length'];
$order = $_GET['order'];
$setID = $_GET['setID'];
$setDB = $_GET['setDB'];
/* $method = '1';
$cohort = 'COAD';
$id = '2949';
$length = '100';
$order = 'asc';
$setID = '0';
$setDB = '1'; */

$methods = ["tumor_RNA","tumor_RES","normal"];
$setDBs = ["kegg_sets","genefamily_sets","reactome_sets","pid_sets","go_biological_process_2015_sets",
		"go_cellular_component_2015_sets","go_molecular_function_2015_sets","human_phenotype_ontology_sets",
		"mgi_mammalian_phenotype_2013_sets","omim_disease_sets","omim_expanded_sets","chea_2015_sets",
		"hmdb_metabolites_sets"];
$fileName = "file:///Z:/TCGA_NeighborProject/Website/Database/JSON/".$methods[$method]."/".$cohort."/";
$fileName.= strval(200*floor($id/200)+1)."-".strval(200*ceil($id/200))."/".$id.".json";
$json = file_get_contents($fileName);
$dat = json_decode($json,true);
if($length==(0)){
	$length = count($dat['id']);
}
if($order=='asc'){
	$ids = array_slice($dat['id'],0,$length);
}else{
	$ids = array_slice($dat['id'],-$length,$length);
}


require_once('./connection.php');
$db = Db::getInstance();
try {
	$sql = "SELECT `symbol` FROM gene_symbols WHERE id IN(".implode(',', $ids);
	$sql.= ") ORDER BY FIELD(id, ".implode(',', $ids).")";
	$stmt = $db->query($sql);
	$coexp_symbols = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$sql = "SELECT `locus`,`description` FROM gene_info WHERE `gene_id` IN (".implode(',', $ids).")
			ORDER BY LOCATE(CAST(`gene_id` AS CHAR),'".implode(',', $ids)."')" ;
	$stmt = $db->query($sql);
	while($info = $stmt->fetch(PDO::FETCH_ASSOC)){
		$locus[] = $info['locus'];
		$description[] = $info['description'];
	}
	if($setID>=0){
		$setDB_name = $setDBs[$setDB];
		$sql = "SELECT `gene_id` FROM ".$setDB_name." WHERE `pathway_id` = ".($setID+1);
		$stmt = $db->query($sql);
		while($setIDgroup = $stmt->fetch(PDO::FETCH_ASSOC)){
			$inSetIds[] = intval($setIDgroup['gene_id']);
		}
	}
}catch(PDOException $e) {
	echo $e->getMessage();
}
if($setID>=0){
	$json = file_get_contents($fileName);
	$dat = json_decode($json,true);
}
$coexp_data = array();
if($order=='asc'){
	$coexp_data['ids']=$ids;
	$coexp_data['symbols']=$coexp_symbols;
	$coexp_data['locus']=$locus;
	$coexp_data['description']=$description;
}else{
	$coexp_data['ids'] = array_reverse($ids);
	$coexp_data['symbols']=array_reverse($coexp_symbols);
	$coexp_data['locus']=array_reverse($locus);
	$coexp_data['description']=array_reverse($description);
}

if($setID>=0){
	$coexp_data['inSetIds']=$inSetIds;
}
if($order=='asc'){
	$coexp_data['coefs']=array_slice($dat['coef'],0,$length);
}else{
	$coexp_data['coefs']=array_reverse(array_slice($dat['coef'],-$length,$length));
}
echo json_encode($coexp_data);
unset($sql);
unset($stmt);
unset($samplemethodEnabled);
$db = null;
?>
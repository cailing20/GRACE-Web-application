<?php
$method = $_GET['method'];
$cohort = $_GET['cohort'];
$id = $_GET['id'];
/* $method = '1';
$cohort = 'COAD';
$id = '2949';
$length = '100';
$order = 'asc';
$setID = '0';
$setDB = '1'; */

$methods = ["tumor_RNA","tumor_RES","normal"];
$fileName = "file:///Z:/TCGA_NeighborProject/Website/Database/JSON/".$methods[$method]."/".$cohort."/";
$fileName.= strval(200*floor($id/200)+1)."-".strval(200*ceil($id/200))."/".$id.".json";
$json = file_get_contents($fileName);
$dat = json_decode($json,true);
$ids = $dat['id'];
$coefs = $dat['coef'];

require_once('./connection.php');
$db = Db::getInstance();
$json = file_get_contents('file:///Z:/TCGA_NeighborProject/Website/Database/JSON/tumor_RES/BRCA/13001-13200/13092.json');
try {
	$sql = "SELECT * FROM gene_symbols WHERE `id` IN (".implode(',', $ids).") ORDER BY `id`" ;
	$stmt = $db->query($sql);
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$sql = "SELECT `gene_id`,`locus`,`description` FROM gene_info WHERE `gene_id` IN (".implode(',', $ids).") ORDER BY `gene_id`";
	$stmt = $db->query($sql);
	$resultInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
}catch(PDOException $e) {
	echo $e->getMessage();
}

$symbolArr = array() ;
$locusArr = array() ;
$descriptionlArr = array() ;
for($i = 0; $i < count($result); $i++) {
	$key = $result[$i]['id'];
	$symbolArr[$key] = $result[$i]['symbol'];
	$key = $resultInfo[$i]['gene_id'];
	$locusArr[$key] = $resultInfo[$i]['locus'];
	$descriptionlArr[$key] = $resultInfo[$i]['description'];
}

$symbols = array();
$locuses = array();
$descriptions = array();
foreach(array_values($ids) as $key){
	$symbols[]=$symbolArr[$key];
	$locuses[]=$locusArr[$key];
	$descriptions[]=$descriptionlArr[$key];
}
function outputCSV($data,$file_name = 'file.csv') {
	# output headers so that the file is downloaded rather than displayed
	header("Content-Type: text/csv");
	header("Content-Disposition: attachment; filename=$file_name");
	# Disable caching - HTTP 1.1
	header("Cache-Control: no-cache, no-store, must-revalidate");
	# Disable caching - HTTP 1.0
	header("Pragma: no-cache");
	# Disable caching - Proxies
	header("Expires: 0");

	# Start the ouput
	$output = fopen("php://output", "w");
	fputcsv($output, ['symbol','Rho','locus','description']);
	# Then loop through the rows
	foreach ($data as $row) {
		# Add the rows to the body
		fputcsv($output, $row); // here you can change delimiter/enclosure
	}
	# Close the stream off
	fclose($output);
}
/* outputCSV(array($coexp_symbols,$description,$coefs,$locus),'download.csv');
 */
outputCSV(array_map(null,$symbols,$coefs,$locuses,$descriptions),'download.csv');

unset($sql);
unset($stmt);
unset($samplemethodEnabled);
$db = null;
?>

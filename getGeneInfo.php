<?php
require_once('./connection.php');
$db = Db::getInstance();
$q = $_GET['q'];
try {
	/* The following prepares the description for genes from the gene set */
	$sql = "SELECT `gene_id`,`locus`,`description` FROM gene_info 
			WHERE `gene_id` = (SELECT `id` FROM gene_symbols WHERE `symbol` = '".$q."')";
	$result = $db->query($sql);
	while($row= $result->fetch(PDO::FETCH_ASSOC))
	{
		$geneInfo= $q."<br>";
		$geneInfo.="<span>".$row['locus']."<br></span>";
		$geneInfo.="<span>".$row['description']."</span>";
		$geneId = $row['gene_id'];
	}	
	$data = array();
	$data['geneInfo'] = $geneInfo;
	$data['geneId'] = $geneId;
	echo json_encode($data);
}catch(PDOException $e) {
	echo $e->getMessage();
}


unset($sql);
unset($result);

$db = null;

?>
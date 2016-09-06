<?php
require_once('connection.php');
$db = Db::getInstance();
$q = $_GET['q'];
try {
	/* The following prepares the description for genes from the gene set */
	$sql = "SELECT * FROM scatter_plot_lookup WHERE `gene_id` =".$q;
	$result = $db->query($sql);
	$data = array();
	while($row= $result->fetch(PDO::FETCH_ASSOC))
	{
		$data['RNA'] = $row['rna_symbol'];
		$data['CN'] = $row['cn_symbol'];
	}	
	echo json_encode($data);
}catch(PDOException $e) {
	echo $e->getMessage();
}
unset($sql);
unset($result);

$db = null;

?>
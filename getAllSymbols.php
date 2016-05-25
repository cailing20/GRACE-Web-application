<?php
require_once('./connection.php');
$db = Db::getInstance();
try {
	/* The following prepares the description for genes from the gene set */
	$sql = "SELECT `symbol` FROM gene_symbols";
	$result = $db->query($sql);
	while($row= $result->fetch(PDO::FETCH_ASSOC))
	{
		$geneSymbols[] = $row['symbol'];
	}
	}catch(PDOException $e) {
		echo $e->getMessage();
	}

echo json_encode($geneSymbols);

unset($sql);
unset($result);

$db = null;

?>
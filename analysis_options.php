<?php
require_once('./connection.php');
$db = Db::getInstance();
$q = $_GET['q'];
try {
	$sql = "SELECT * FROM analysis_availability WHERE gene_id = (SELECT `id` FROM gene_symbols WHERE `symbol` ='".$q."')";
	$result = $db->query($sql);
	while($row= $result->fetch(PDO::FETCH_ASSOC))
	{
		echo $row['scatter_plot'].",".$row['coexpression_analysis'];
	}
}catch(PDOException $e) {
	echo $e->getMessage();
}

?>

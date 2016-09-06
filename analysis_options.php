<?php
require_once('connection.php');
$db = Db::getInstance();
$q = trim(stripslashes(htmlspecialchars($_GET['q'])));
if(preg_match("/^[a-zA-Z0-9-_]*$/", $q)){
	try {
		$stmt = $db->prepare("SELECT * FROM analysis_availability WHERE gene_id = (SELECT `id` FROM gene_symbols WHERE `symbol` = :symbol)");
		$stmt->execute(array('symbol' => $q));
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			echo $row['scatter_plot'].",".$row['coexpression_analysis'];
		}
	}catch(PDOException $e) {
		echo $e->getMessage();
	}
} else {

	echo "Invalid Input!";
	
}

$db = null;
?>

<?php
require_once('connection.php');
$db = Db::getInstance();
<<<<<<< HEAD
$q = trim(stripslashes(htmlspecialchars($_GET['q'])));
try {
	$sql = "SELECT * FROM analysis_availability WHERE gene_id = (SELECT `id` FROM gene_symbols WHERE `symbol` ='".$q."')";
	$result = $db->query($sql);
	while($row= $result->fetch(PDO::FETCH_ASSOC))
	{
		echo $row['scatter_plot'].",".$row['coexpression_analysis'];
=======
$q = $_GET['q'];
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
>>>>>>> Ling
	}
} else {

	echo "Invalid Input!";
	
}

$db = null;
?>

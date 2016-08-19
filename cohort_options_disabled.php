<?php
require_once('connection.php');
$db = Db::getInstance();
$g = $_GET['g'];
if(preg_match("/^[a-zA-Z0-9-_]*$/", $g)){

	$cohortEnabled = array_fill(0, 21, 0);
	
	try {
		$sql = "SELECT COUNT(*) FROM `ca_all_cohorts` WHERE `gene_id` =
				(SELECT `id` FROM `gene_symbols` WHERE symbol = '".$g."')";
		$stmt = $db->query($sql);
		if($stmt->fetch(PDO::FETCH_COLUMN)==0){
			$sql = "SELECT `cohort_id` FROM ca_partial_cohorts WHERE `gene_id` = 
					(SELECT `id` FROM gene_symbols WHERE `symbol` = '".$g."')";
			$stmt = $db->query($sql);
			while($enabledPos= $stmt->fetch(PDO::FETCH_ASSOC)){
				$cohortEnabled[$enabledPos['cohort_id']-1] = 1;
			}
		}else{
			$cohortEnabled = array_fill(0, 21, 1);
		}
	}catch(PDOException $e) {
		echo $e->getMessage();
	}
	
	echo json_encode($cohortEnabled);
	
	unset($sql);
	unset($stmt);
	unset($cohortEnabled);

} else {

	echo "Invalid Input!";

}

$db = null;

?>
<?php
require_once('connection.php');
$db = Db::getInstance();
<<<<<<< HEAD
$g = trim(stripslashes(htmlspecialchars($_GET['g'])));
$c = trim(stripslashes(htmlspecialchars($_GET['c'])));
$sampleMethodOptions = ["Tumor Samples - Standard Method","Tumor Samples - GRACE", "Normal Samples - Standard Method"];
$samplemethodEnabled = array_fill(0, 3, 0);
$sampleNumber = array_fill(0,3,0);
try {
	/* The following prepares the description for genes from the gene set */
	$sql = "SELECT `option_id`,`n_samples` FROM ca_option_availability WHERE `cohort_id`=
			(SELECT id FROM cohorts WHERE cohort = '".$c."')" ;
	$stmt = $db->query($sql);
	while($enabledPos = $stmt->fetch(PDO::FETCH_ASSOC)){
		$samplemethodEnabled[$enabledPos['option_id']-1] = 1;
		$sampleNumber[$enabledPos['option_id']-1] = $enabledPos['n_samples'];
	}
	/* If only one option is available, that must be available and we are ready to proceed,
	 * otherwise we need to check the partial_option_by_cohorts table to see if all options are available
	 * for the gene.*/
	if($stmt->rowCount()!=1){
		$sql = "SELECT `option_id` FROM partial_option_by_cohorts 
				WHERE `gene_id`=(SELECT `id` FROM gene_symbols WHERE `symbol`= '".$g."')
				AND `cohort_id` = (SELECT `id` FROM cohorts WHERE `cohort` = '".$c."')";
		$stmt = $db->query($sql);
		/* If there is record in the partial_option_by_cohort table, the enabled array needs to be 
		 * reconstructed based on the result from this table */
		if($stmt->rowCount()!=0){
			$samplemethodEnabled = array_fill(0, 3, 0);
			while($enabledPos = $stmt->fetch(PDO::FETCH_ASSOC)){
				$samplemethodEnabled[$enabledPos['option_id']-1] = 1;
			}
			for($i=0;$i<3;$i++){
				if($samplemethodEnabled[$i]==0){
					$sampleNumber[$i] = null;
=======
$g = $_GET['g'];
if(preg_match("/^[A-Z0-9-]*$/", $g)){

	$c = $_GET['c'];
	$sampleMethodOptions = ["Tumor Samples - Standard Method","Tumor Samples - GRACE", "Normal Samples - Standard Method"];
	$samplemethodEnabled = array_fill(0, 3, 0);
	$sampleNumber = array_fill(0,3,0);
	try {
		/* The following prepares the description for genes from the gene set */
		$sql = "SELECT `option_id`,`n_samples` FROM ca_option_availability WHERE `cohort_id`=
				(SELECT id FROM cohorts WHERE cohort = :cohortNumber)" ;
		$stmt = $db->prepare($sql);
		$stmt->execute(array('cohortNumber'=>$c));
		while($enabledPos = $stmt->fetch(PDO::FETCH_ASSOC)){
			$samplemethodEnabled[$enabledPos['option_id']-1] = 1;
			$sampleNumber[$enabledPos['option_id']-1] = $enabledPos['n_samples'];
		}
		/* If only one option is available, that must be available and we are ready to proceed,
		 * otherwise we need to check the partial_option_by_cohorts table to see if all options are available
		 * for the gene.*/
		if($stmt->rowCount()!=1){
			$sql = "SELECT `option_id` FROM partial_option_by_cohorts 
					WHERE `gene_id`=(SELECT `id` FROM gene_symbols WHERE `symbol`= :symbol)
					AND `cohort_id` = (SELECT `id` FROM cohorts WHERE `cohort` = :cohortNumber)";
			$stmt = $db->prepare($sql);
			$stmt->execute(array('symbol'=>$g,'cohortNumber'=>$c));
			/* If there is record in the partial_option_by_cohort table, the enabled array needs to be 
			 * reconstructed based on the result from this table */
			if($stmt->rowCount()!=0){
				$samplemethodEnabled = array_fill(0, 3, 0);
				while($enabledPos = $stmt->fetch(PDO::FETCH_ASSOC)){
					$samplemethodEnabled[$enabledPos['option_id']-1] = 1;
				}
				for($i=0;$i<3;$i++){
					if($samplemethodEnabled[$i]==0){
						$sampleNumber[$i] = null;
					}
>>>>>>> Ling
				}
			}
		}
	}catch(PDOException $e) {
		echo $e->getMessage();
	}
	$data = array();
	$data['sampleMethodOptions'] = $sampleMethodOptions;
	$data['samplemethodEnabled'] = $samplemethodEnabled;
	$data['sampleNumber'] = $sampleNumber;
	echo json_encode($data);
	
	unset($sql);
	unset($stmt);
	unset($samplemethodEnabled);
	
} else {
	echo "Invalid Input!";
}

$db = null;

?>

<?php
require_once('./connection.php');
$db = Db::getInstance();
try {
	/* The following prepares the description for genes from the gene set */
	$sql = "SELECT cohorts.cohort,cohort_description.description
			FROM cohorts
			LEFT JOIN cohort_description
			ON cohorts.cohort=cohort_description.cohort;";
	$result = $db->query($sql);
	$cohort_options = $result->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e) {
	echo $e->getMessage();
}

for($i=0;$i<count($cohort_options);$i++){
	echo "<option value='".$cohort_options[$i]['cohort']."'>".$cohort_options[$i]['cohort']." - ".$cohort_options[$i]['description']."</option><br>";
}

unset($sql);
unset($result);
unset($cohort_options);
$db = null;

?>
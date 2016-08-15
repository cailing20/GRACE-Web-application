<?php
require_once('./connection.php');
$db = Db::getInstance();
$q = $_GET['q'];

if(preg_match("/^[a-zA-Z0-9-_]*$/", $q)){

	try {
		/* The following prepares the symbols for genes from the gene set */
		$sql = "SELECT
		  `symbol`
		FROM
		  gene_symbols
		WHERE
		  `id` IN(
		  SELECT
		    `gene_id`
		  FROM
		    kegg_sets
		  WHERE
		    `pathway_id` =(SELECT id FROM kegg_names WHERE pathway = '".$q."'))";
		$result = $db->query($sql);
		$set_symbols = $result->fetchAll(PDO::FETCH_ASSOC);
		
		/* The following prepares the description for genes from the gene set */
		$sql = "SELECT
		  `description`
		FROM
		  gene_info
		WHERE
		  `gene_id` IN(
		  SELECT
		    `gene_id`
		  FROM
		    kegg_sets
		  WHERE
		    `pathway_id` =(SELECT id FROM kegg_names WHERE pathway = '".$q."'))";
		$result = $db->query($sql);
		$set_description = $result->fetchAll(PDO::FETCH_ASSOC);;
	}catch(PDOException $e) {
		echo $e->getMessage();
	}
	echo "<a href='#' id='back-link' onclick='backToPathwayList()' onmouseover='brightArrow()' onmouseout='darkArrow()'><i id='back' class='fa fa-arrow-left fa-lg'></i></a>";
	echo "<a href='#' class='pathwayTitle' id='pathwayTitle'>".$q."</a>";
	for($i=0;$i<count($set_symbols);$i++){
		echo '<a href="#" class="subset" title="'.$set_description[$i]["description"].'">'.$set_symbols[$i]["symbol"].'</a>';
	}
	
	unset($sql);
	unset($result);
	unset($set_symbols);
	unset($set_description);
		
} else {

	echo "Invalid Input!";
	
}

$db = null;
?>

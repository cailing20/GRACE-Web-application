<?php
require_once('connection.php');
$db = Db::getInstance();
try {
	/* The following prepares the description for genes from the gene set */
	$sql = "SELECT `pathway` FROM kegg_names";
	$result = $db->query($sql);
       $row_count = $result->rowCount();
       if($row_count){
       		$keggPathways = $result->fetchAll(PDO::FETCH_ASSOC);
       }
}catch(PDOException $e) {
	echo $e->getMessage();
}

foreach($keggPathways as $keggPathway){
	echo "<a href='#'>".$keggPathway['pathway']."<i id='spanCaret' class='middleIcon fa fa-caret-right hidden-caret'></i></a>";
}
unset($sql);
unset($result);
unset($keggPathways);
$db = null;
?>
<?php
require_once('connection.php');
$db = Db::getInstance();
$q = $_GET['q'];
if(empty($q)){
	echo "Gene Symbol is required!";
} else{
	$q = trim(stripslashes(htmlspecialchars($q)));
	
	if(preg_match("/^[a-zA-Z0-9-_]*$/", $q)){
	try {
		$sql = "SELECT `gene_id` FROM available_aliases WHERE `alias`= :alias";
		$stmt = $db->prepare($sql);
		$stmt->execute(array('alias'=>$q));
		if($stmt->rowCount()==0){
			try {
				$sql = "SELECT count(*) FROM unavailable_genes_aliases WHERE `symbol`= :symbol";
				$stmt = $db->prepare($sql);
				$stmt->execute(array('symbol'=>$q));
				if($stmt->fetch(PDO::FETCH_COLUMN)>0){
					echo "No analysis is available for gene entered.";
				}else{
					echo "Invalid Gene Name.";
				}
			}catch(PDOException $e) {
				echo $e->getMessage();
			}
			die();
		}else{
			while($row= $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$alias[] = $row['gene_id'];
			}
			if(count($alias)==1){
				try {
					$sql = "SELECT s.symbol, i.locus, i.description
				FROM gene_symbols AS s, gene_info AS i
				WHERE s.id=".$alias[0]." AND i.gene_id=".$alias[0];
					$result = $db->query($sql);
					while($row= $result->fetch(PDO::FETCH_ASSOC))
					{
						echo $q." is the alias of ".$row['symbol']."<br>";
						echo "Locus: ".$row['locus']."<br>";
						echo "Description: ".$row['description']."<br>";
						echo "Please confirm and enter ".$row['symbol']." as gene name instead.";
					}
				}catch(PDOException $e) {
					echo $e->getMessage();
				}
			}else if(count($alias)>1){
				try {
					/* The following prepares the description for genes from the gene set */
					$sql = "SELECT ss.symbol,si.locus,si.description FROM
				(SELECT * FROM gene_symbols AS s WHERE s.id IN (".implode(",", $alias).")) AS ss
				LEFT JOIN (SELECT * FROM gene_info AS i WHERE i.gene_id IN (".implode(",", $alias)."))
				AS si ON ss.id=si.gene_id";
					$result = $db->query($sql);
					echo "There are ".count($alias)." aliases matching to the gene you entered:<br><br>";
					while($row= $result->fetch(PDO::FETCH_ASSOC))
					{
						echo "Symbol: ".$row['symbol']."<br>";
						echo "Locus: ".$row['locus']."<br>";
						echo "Description: ".$row['description']."<br><br>";
					}
					echo "Please use the correct gene symbol";
				}catch(PDOException $e) {
					echo $e->getMessage();
				}
			}
		}
		unset($sql);
		unset($result);
	
	}catch(PDOException $e) {
		echo $e->getMessage();
	}
	} else {
	
		echo "Invalid Gene Name.";
	
	}
	
	
}


$db = null;

?>
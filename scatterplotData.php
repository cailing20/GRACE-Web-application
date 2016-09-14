<?php
$cohort = $_GET['cohort'];
$id = $_GET['id'];

/* $cohort = 'COAD';
$id = '2949'; */


// parse without sections
$config = parse_ini_file('../config/config.ini');
$_JSONpath = $config['JSONpath'];
$fileName = $_JSONpath . "RNACN/". $cohort . "/";
$fileName.= strval(200*floor($id/200)+1)."-".strval(200*ceil($id/200))."/".$id.".json";
$json = file_get_contents($fileName);
$dat = json_decode($json,true);

$fileName = $_JSONpath . "RNACN/" . $cohort . "/samples.json";
$json = file_get_contents($fileName);
$samples = json_decode($json,true);
$length = count($dat['RNA']);
$marker = array('symbol'=>'circle');
$color = 'rgba(229, 42, 111, .5)';
$result = array();
for ($i = 0;$i < ($length-1);$i++){
	$name = $samples['samples'][$i];
	$data = array(array($dat['CN'][$i],$dat['RNA'][$i]));
	$result['data'][$i] = array("name"=>$name,
			"color"=>$color,
			"data"=>$data,
			"marker"=>$marker
	);
}
$result['length']=$length;

echo json_encode($result);

?>

<?php

	$genename = $_GET["id"];

	include "dbminilcclmag.inc";
	require_once("dbencryt.inc");

	//open the database connection
	$connection = mysql_connect(Encryption::decrypt($hostname), Encryption::decrypt($username), Encryption::decrypt($password));

	if (!$connection)
	{
  		die('Could not connect: ' . mysql_error());
  	}


	mysql_select_db(Encryption::decrypt($dbname), $connection) or die ("Couldn't find database");

  	header("Content-type: text/plain");
  	header("Content-Disposition: attachment; filename=mutation.csv");
  	header("Content-Description: PHP Generated Data");
  	header("Content-transfer-encoding: binary");

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// output the column headings
	fputcsv($output, array('Gene Name', 'Cell Line ID', 'Mutation'));

	$rows = mysql_query("select A.GeneName as gname, B.OldID as oldid, A.Mutation as mt from Mutation A, Basic B where A.CellLineID = B.CellLineID and A.Mutation != \"WT\" and A.GeneName = \"" . $genename . "\" order by B.OldID;", $connection);


	// loop over the rows, outputting them
	while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);

	mysql_close($connection);

?>


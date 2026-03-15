<?php

/*This file is for connecting the database, in the models simply put <include 'database.php'> to access the connection'*/

	$host = 'dbhost.cs.man.ac.uk';
	// please enter your own username and password when trying to connect the database
	$username = 'y28244lw';
	$password = 'n2911_lw';
	$dbname = '2021_comp10120_r1';

	try{
 		$conn = new PDO("mysql:host=$host", $username, $password);
 		//echo "Connected to $host successfully.";
	} catch (PDOException $pe){
		$err_message = "Could not connect to $host :" . $pe->getMessage();
		//include('../view/error.php'); 
 		exit();
	}

//showDatabases($username, $password, $host);

// 	function showDatabases($username, $password, $host){
// 	$sql = "SHOW DATABASES";
// 	$pdo = new pdo("mysql:host=$host", $username, $password);
// 	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
// 	$stmt = $pdo->prepare($sql);
// 	$stmt->execute();

// 	$stmt->SetFetchMode(PDO::FETCH_ASSOC);
// 	while($row = $stmt->fetch()){
// 		print("<h3>" . $row['Database'] ."</h3>");
// 	}
// }
?>

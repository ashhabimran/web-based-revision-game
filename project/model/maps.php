<?php
	include ('database.php');

	add_map($dbname, $username, $password, $host, "TEST", "NULL");


	function add_map($dbName, $username, $password, $host, $mapId, $mapPath){
		$sql = "INSERT INTO map
				VALUES (:mapId,:mapPath)";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName", $username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
				'mapId' => $mapId,
				'mapPath' => $mapPath
			  ]);
	}
?>
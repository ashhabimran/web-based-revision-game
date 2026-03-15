<?php
	include('database.php');

	add_topic($dbname, $username, $password, $host, "Test Data", "TEST", "COMP10120");

	function add_topic($dbName, $username, $password, $host, $topic, $mapId, $course){
		$sql = "INSERT INTO topic
		VALUES (:topic,:mapId,:course)";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName", $username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
				'topic' => $topic,
				'mapId' => $mapId,
				'course' => $course
			  ]);
	}
?>
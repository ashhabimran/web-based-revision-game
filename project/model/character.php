<?php
/* This is the model for the characters, OOP */
	include ('database.php');

	add_character($dbname, $username, $password, $host, "TEST_01", "DEFAULT");

	function add_character($dbName, $username, $password, $host, $char_type, $costume){

		$sql = "INSERT INTO game_char (char_type, costume)
		VALUES (:char_type,:costume)";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName", $username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
				'char_type' => $char_type,
				'costume' => $costume
			  ]);
	}

	class character{

	}

	function update_character(){

	}
?>
<?php	

/*This file is for building the databases in the development stage, and should be removed / restrict access afterwards*/

	include('database.php');



/*All tables are now created, do not uncomment the following unless any table needs to be re-created*/

	//create_table($dbname, "character", $username, $password, $host);
	//create_table($dbname, "user", $username, $password, $host);
	//create_table($dbname, "map", $username, $password, $host);
	//create_table($dbname, "topic", $username, $password, $host);
	//create_table($dbname, "question", $username, $password, $host);
	//create_table($dbname, "answer", $username, $password, $host);
	//create_table($dbname, "review", $username, $password, $host);
	//create_table($dbname, "link", $username, $password, $host);
	//create_table($dbname, "record", $username, $password, $host);


/*-----functions------*/

	function create_table($dbName,$tblName, $username, $password, $host){

		switch($tblName){

			case "character":
				$sql = "CREATE TABLE game_char (
				charId INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				char_type VARCHAR(20) NOT NULL,
				costume VARCHAR(128) NOT NULL)";
				break;

			case "user":
				$sql = "CREATE TABLE user (
				userId INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				username VARCHAR(50) NOT NULL,
				password VARCHAR(128) NOT NULL,
				user_level INT(2) UNSIGNED NOT NULL,
				total_points INT UNSIGNED NOT NULL,
				charId INT(8) UNSIGNED NOT NULL,
				FOREIGN KEY (charId) REFERENCES game_char(charId))";
				break;

			case "review":
				$sql = "CREATE TABLE review (
				reviewId INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				topic_name VARCHAR(90),
				userId INT(8) UNSIGNED,
				points_gained DECIMAL(4,2),
				record_time DATETIME,
				FOREIGN KEY (topic_name) REFERENCES topic(topic_name),
				FOREIGN KEY (userId) REFERENCES user(userId))";
				break;

			case "question":
				$sql = "CREATE TABLE question (
				questionId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				topic_name VARCHAR(90) NOT NULL,
				question TEXT NOT NULL,
				points INT,
				type VARCHAR(16),
				FOREIGN KEY (topic_name) REFERENCES topic(topic_name))";
				break;

			case "map":
				$sql = "CREATE TABLE map (
				mapId VARCHAR(9) UNIQUE PRIMARY KEY,
				mapPath VARCHAR(128) )";
				break;

			case "topic":
				$sql = "CREATE TABLE topic(
				topic_name VARCHAR(90) NOT NULL PRIMARY KEY,
				mapId VARCHAR(9),
				course_unit VARCHAR(9) NOT NULL,
				FOREIGN KEY (mapId) REFERENCES map(mapId))";
				break;

			case "answer":
				$sql = "CREATE TABLE answer(
				answerId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				questionId INT UNSIGNED,
				answer TEXT,
				t_or_f BOOL NOT NULL,
				feedback TEXT,
				FOREIGN KEY (questionId) REFERENCES question(questionId))";
				break;

			case "link":
				$sql = "CREATE TABLE npc_in_map(
				mapId VARCHAR(9),
				charId INT (8) UNSIGNED,
				FOREIGN KEY (mapId) REFERENCES map(mapId),
				FOREIGN KEY (charId) REFERENCES game_char(charId))";
				break;

			case "record":
				$sql = "CREATE TABLE record(
				record_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				questionId INT UNSIGNED,
				reviewId INT UNSIGNED,
				points_gained INT UNSIGNED,
				FOREIGN KEY (questionId) REFERENCES question(questionId),
				FOREIGN KEY (reviewId) REFERENCES review(reviewId))";
				break;

			default:
				echo("Error");
		} 


		$pdo = new pdo("mysql:host=$host;dbname=" . $dbName . '', $username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		$pdo->query($sql);
		echo("Successfully created $tblName");

	}

	function drop_table($dbName,$tblName, $username, $password, $host){
		$sql = "DROP TABLE $tblName";
	 	$pdo = new pdo("mysql:host=$host;dbname=$dbName",
	 				   $username, $password);

	 	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	 	$pdo->query($sql); 
	}

?>
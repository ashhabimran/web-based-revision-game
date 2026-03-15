<?php
	
	include ('database.php');

/*-----for test purpose-----*/
	//$results = get_question($dbname, $username, $password, $host, "Test Data");

	// foreach ($results as $question) {
	// 	echo("<br> question: ".$question['question'] . "<br> points available: " . $question['points'] . " <br> topic: " . $question['topic_name'] . "<br>");
	// 	$answers = get_answer($dbname, $username, $password, $host, $question['questionId']);

	// 	foreach($answers as $ans){
	// 		echo($ans['answer'] . "<br>");
	// 	}
	// }


/* if there's anything wrong with get_topics, uncomment the following to see if there's any output*/
	// $topics = get_topics($dbname, $username, $password, $host);
	// foreach ($topics as $top) {
	// 	echo($top['topic_name'] . "<br>");
	// }

	function add_question($dbName, $username, $password, $host, $topic, $type, $question, $points, $feedback){
		check_topic_exist($dbName, $username, $password, $host, $topic, "COMP10120");
		$sql = "INSERT INTO question (topic_name, question, points, type, feedback)
				VALUES (:topic,:question,:points,:type, :feedback)";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName", $username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
				'topic' => $topic,
				'question' => $question,
				'points' => $points,
				'type' => $type,
				'feedback' => $feedback
			  ]);
		$last_id = $pdo -> lastInsertId();
		return $last_id;
	}

	function add_answer($dbName, $username, $password, $host, $answer, $questionId, $t_or_f){
		$sql = "INSERT INTO answer (questionId, answer, t_or_f)
				VALUES (:questionId,:answer,:t_or_f)";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName", $username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
				'questionId' => $questionId,
				'answer' => $answer,
				't_or_f' => $t_or_f,
			  ]);
	}

	function get_answer($dbName, $username, $password, $host, $questionId){
		$sql="SELECT answer, t_or_f, answerId
			  FROM answer
			  WHERE questionId = :questionId";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName",$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
					  'questionId' => $questionId
					  ]);
		$stmt->SetFetchMode(PDO::FETCH_ASSOC);
		$result = array();

		while($row = $stmt->fetch()){
			$result[] = $row;
		}
		return $result;
	}

	function get_question($dbName, $username, $password, $host, $topic){
		$sql="SELECT questionId, question, type ,points, topic_name, feedback
			  FROM question
			  WHERE topic_name = :topic";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName",$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
					  'topic' => $topic
					  ]);
		$stmt->SetFetchMode(PDO::FETCH_ASSOC);
		$result = array();

		while($row = $stmt->fetch()){
			$result[] = $row;
		}
		
		return $result;
	}

	function get_question_by_id($dbName, $username, $password, $host, $questionId){
		$sql="SELECT *
			  FROM question
			  WHERE questionId = :questionId";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName",$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
					  'questionId' => $questionId
					  ]);
		$stmt->SetFetchMode(PDO::FETCH_ASSOC);

		$row = $stmt->fetch();
		return $row;
	}

	function check_topic_exist($dbName, $username, $password, $host, $topic, $course){
		$sql="SELECT *
			  FROM topic
			  WHERE topic_name = :topic";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName",$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
					  'topic' => $topic
					  ]);
		$stmt->SetFetchMode(PDO::FETCH_ASSOC);

		$row = $stmt->fetch();
		
		if (!($row)){
			add_topic($dbName, $username, $password, $host, $topic, "TEST", $course);
		}

	}

	function add_topic($dbName, $username, $password, $host, $topic, $mapId, $course){
		$sql = "INSERT INTO topic
		VALUES (:topic_name,:mapId,:course_unit)";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName", $username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
				'topic_name' => $topic,
				'mapId' => $mapId,
				'course_unit' => $course
			  ]);
	}

	function get_topics($dbName, $username, $password, $host){
		$sql="SELECT *
			  FROM topic";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName",$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$stmt->SetFetchMode(PDO::FETCH_ASSOC);
		$result = array();

		while($row = $stmt->fetch()){
			$result[] = $row;
		}
		
		return $result;
	}


 
?>
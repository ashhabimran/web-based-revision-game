<?php
	include ('database.php');

	function store_record($dbName, $username, $password, $host, $questionId, $reviewId, $points_gained){
		$sql = "INSERT INTO record (questionId, reviewId, points_gained)
				VALUES (:questionId, :reviewId, :points_gained)";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName", $username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
				'questionId' => $questionId,
				'reviewId' => $reviewId,
				'points_gained' => $points_gained,
			  ]);
	}

	function new_review($dbName, $username, $password, $host, $topic, $userId, $total_points, $record_time){
		$sql = "INSERT INTO review (topic_name, userId, total_points_gained, record_time)
				VALUES (:topic, :userId, :total_points, :record_time)";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName", $username, $password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
				'topic' => $topic,
				'userId' => $userId,
				'total_points' => $total_points,
				'record_time' => $record_time
			  ]);

		$last_id = $pdo -> lastInsertId();
		return $last_id;
	}

	function get_review($dbName, $username, $password, $host, $userId){
		$sql="SELECT *
			  FROM review
			  WHERE userId = :userId";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName",$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
					  'userId' => $userId
					  ]);
		$stmt->SetFetchMode(PDO::FETCH_ASSOC);
		$result = array();

		while($row = $stmt->fetch()){
			$result[] = $row;
		}
		return $result;
	}

	function get_record($dbName, $username, $password, $host, $reviewId){
		$sql="SELECT *
			  FROM record
			  WHERE reviewId = :reviewId";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName",$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
					  'reviewId' => $reviewId
					  ]);
		$stmt->SetFetchMode(PDO::FETCH_ASSOC);
		$result = array();

		while($row = $stmt->fetch()){
			$result[] = $row;
		}
		return $result;
	}
?>
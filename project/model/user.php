<?php
	
	include('database.php');

	function addUser($dbName, $username, $password, $host, $user, $pass, $level, $total_points, $charId){
		if(duplication($dbName, $username, $password, $host, $user)){
			return false;
		}else{	
			$sql = "INSERT INTO user (username,password,user_level,total_points,charId)
					VALUES (:user,:pass,:level,:total_points,:charId)";

			$pdo = new pdo("mysql:host=$host;dbname=$dbName",$username,$password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

			$stmt = $pdo->prepare($sql);
			$pass = password_hash($pass, PASSWORD_DEFAULT);
			$stmt->execute([
							'user' => $user,
							'pass' => $pass,
							'level' => $level,
							'total_points' => $total_points,
							'charId' => $charId
						  ]);	
		}
		return true;	
	}


	function getUser($dbName, $username, $password, $host, $name){
		$sql="SELECT *
			  FROM user
			  WHERE username = :name";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName",$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
					  'name' => $name
					  ]);
		$stmt->SetFetchMode(PDO::FETCH_ASSOC);
		$information = array();
		while($row = $stmt->fetch()){
			$information[] = $row;
		}
		return $information;
	}

	function updatePoints($dbName, $username, $password, $host, $userId, $pts){
		$sql = "UPDATE user
				SET total_points = total_points + :pts
				WHERE userId = :userId";

		$pdo = new pdo("mysql:host=$host;dbname=$dbName",$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

		$stmt = $pdo->prepare($sql);
		$stmt->execute([
						'userId' => $userId,
						'pts' => $pts,
					  ]);	
	}


	function verification($dbName, $username, $password, $host, $user, $pass){
		$sql="SELECT password, userId
			  FROM user
			  WHERE username = :user";
		$pdo = new pdo("mysql:host=$host;dbname=$dbName",$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
						'user' => $user
					  ]);
		$stmt->SetFetchMode(PDO::FETCH_ASSOC);
		
		$row = $stmt->fetch();

		if(!$row){
			return false;
		}else{

			if(password_verify($pass, $row['password'])){
				return $row['userId'];
			}else{
				return false;
			}

		}

	}


	function duplication($dbName, $username, $password, $host, $user){
		$sql="SELECT username
			  FROM user
			  WHERE username = :user";
		$pdo = new pdo("mysql:host=$host;dbname=$dbName",$username,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
		$stmt = $pdo->prepare($sql);
		$stmt->execute([
						'user' => $user
			  		  ]);
		$stmt->SetFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->fetch();
		if(!isset($row['username'])){
			return false;
		}else{
			return true;
		}

	}

?>
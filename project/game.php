<?php
	require('model/questions.php');

	//determine whether user is logged in
	session_start();
	$user = "";
	$userId = 0;
	if(isset($_SESSION['logged'])){
		$user = $_SESSION['user'];
		$userId = $_SESSION['userId'];
	}else{
		$user = "";
		$userId = 0;
	}

	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];
	}

	if(isset($_SESSION['userId'])){
		$userId = $_SESSION['userId'];
	}


	//initializing variables
	$action = $topic = $course = $type = $CurrentQuestion = $validErr = $bossLine = "";
	$questions = $answers = $corrAns = $wrongAns = $UserAnswer = $UserRecord = $UserPoints = $QuestionIds =[];
	$questionIndex = $bossHp = $charHp = $charPoints = 0;


	if(!isset($_POST['action'])){
		// get topic & course from question
		session_start();
		$topics = get_topics($dbname, $username, $password, $host);
		$_SESSION['topics'] = $topics;
		$_SESSION['validErr'] = $validErr;
		$_SESSION['user'] = $user;
		$_SESSION['userId'] = $userId;
		header("Location: /www/first_group_project/view/select_form.php");
		exit();
	}


	// get data from select
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$action = $_POST['action'];
		if($action == "New Game"){

			$topic = $_POST['topic'];
			if($topic == 'placeholder'){
				previousPage("topic");
			}
			$course = $_POST['course'];
			$type = $_POST['type'];

			// send stuff to main_game
			session_start();
			$questions = get_question($dbname, $username, $password, $host, $topic);
			$questions = randomQuestions($questions);
			$bossHp = calBossHp($questions);
			$charHp = $bossHp;
			$initialHp = $bossHp;
			$_SESSION['questions'] = $questions;
			$_SESSION['validErr'] = $validErr;
			$_SESSION['bossHp'] = $bossHp;
			$_SESSION['charHp'] = $charHp;
			$_SESSION['initialHp'] = $initialHp;
			$_SESSION['user'] = $user;
			$_SESSION['charPoints'] = $charPoints;
			$_SESSION['UserPoints'] = $UserPoints;
			$_SESSION['QuestionIds'] = $QuestionIds;
			$_SESSION['userId'] = $userId;
			$_SESSION['topic'] = $topic;

		}


		if($action == "okay"){
			//next question
			$done = false;
			$answered = false;
			//session_start();
			$questions = $_SESSION['questions'] ;
			$questionIndex = $_SESSION['questionIndex'];
			$charHp = $_SESSION['charHp'];
			$bossHp = $_SESSION['bossHp'];
			$initialHp = $_SESSION['initialHp'];
			$charPoints = $_SESSION['charPoints'];
			$UserPoints = $_SESSION['UserPoints'];
			$QuestionIds = $_SESSION['QuestionIds'];
			$topic = $_SESSION['topic'];


			$_SESSION['validErr'] = $validErr;

			if(count($questions)-1 == $questionIndex || $questionIndex == 9){
				$done = true;
			}else{
				$questionIndex += 1;
				$_SESSION['questionIndex'] = $questionIndex;
			}
		}


		if($action == "attack"){
			// get data from main_game
			if(!empty($_POST['Options'])){
				$UserAnswer = $_POST['Options'];
				session_start();
				$corrAns = $_SESSION['corrAns'];
				$CurrentQuestion = $_SESSION['CurrentQuestion'];
				$answers = $_SESSION['answers'];
				$bossHp = $_SESSION['bossHp'];
				$charHp = $_SESSION['charHp'];
				$initialHp = $_SESSION['initialHp'];
				$charPoints = $_SESSION['charPoints'];
				$UserPoints = $_SESSION['UserPoints'];
				$QuestionIds = $_SESSION['QuestionIds'];
				$topic = $_SESSION['topic'];


				if(checkAnswer($UserAnswer, $corrAns)){
					$bossLine = "AHHHHHHH NOOOOOO";
					$bossHp -= $CurrentQuestion['points'];

				}else{
					$bossLine = "HAHAHAHAHA DUMB!!";
					$charHp -= $CurrentQuestion['points'];
				}
				$answered = true;


			}else{
				previousPage("answer");
			}
		}


		$CurrentQuestion = $questions[$questionIndex];
		$answers = get_answer($dbname, $username, $password, $host, $questions[$questionIndex]['questionId']);
		foreach($answers as $ans){
			if($ans['t_or_f'] == 1){
				array_push($corrAns, $ans['answerId']);
			}
		}
		$_SESSION['corrAns'] = $corrAns;

		// determine action
		if($answered){
			sendData("Feedback");

		}else{
			if(!$done){
				sendData("Question");

			}else{
				// determine result and navigate to result page
				// session_start();
				$UserPoints = $_SESSION['UserPoints'];
				$QuestionIds = $_SESSION['QuestionIds'];
				$userId = $_SESSION['userId'];
				$charPoints = $_SESSION['charPoints'];
				$topic = $_SESSION['topic'];
				$initialHp = $_SESSION['initialHp'];

				if($user != ""){

					include('model/records.php');
					$date = date('Y-m-d H:i:s');
					$result = round(($charPoints/$initialHp * 100),2) . "%";
					$reviewId = new_review($dbname, $username, $password, $host, $topic, $userId, $result, $date);
					for ($i=0; $i < count($QuestionIds); $i++) { 
						store_record($dbname, $username, $password, $host, $QuestionIds[$i], $reviewId, $UserPoints[$i]);
					}

					include('model/user.php');
					updatePoints($dbname, $username, $password, $host, $userId, $charPoints);
				}

				$win = true;

				if($charHp <= $bossHp){
					$win = false;
				}

				$_SESSION['win'] = $win;
				$_SESSION['user'] = $user;
				$_SESSION['userId'] = $userId;


				header("Location: /www/first_group_project/view/result.php");
				exit();


			}
		}
	}


	//passing data to main_game
	function sendData($dataWanted){
		global $answered, $CurrentQuestion, $answers, $questions, $questionIndex, $validErr, $bossLine, $bossHp, $initialHp, $charHp, $user, $charPoints, $UserPoints, $QuestionIds, $userId, $topic;
		session_start();
		if($dataWanted == "Question"){
			$_SESSION['CurrentQuestion'] = $CurrentQuestion;
			$_SESSION['answers'] = $answers;
			$_SESSION['questions'] = $questions;
			$_SESSION['questionIndex'] = $questionIndex;
		} 

		$_SESSION['bossLine'] = $bossLine;
		$_SESSION['bossHp'] = $bossHp;
		$_SESSION['charHp'] = $charHp;

		$_SESSION['initialHp'] = $initialHp;

		$_SESSION['answered'] = $answered;
		$_SESSION['validErr'] = $validErr;
		$_SESSION['charPoints'] = $charPoints;
		$_SESSION['UserPoints'] = $UserPoints;
		$_SESSION['QuestionIds'] = $QuestionIds;
		$_SESSION['topic'] = $topic;

		$_SESSION['user'] = $user;
		$_SESSION['userId'] = $userId;

		header("Location: /www/first_group_project/view/main_game.php");
		exit();

	}


	//check correctness and calculate points
	function checkAnswer($UserAnswer, $corrAns){
		global $charPoints, $UserPoints, $CurrentQuestion, $QuestionIds;
		$CurrentQuestionPoint = 0;
		foreach ($UserAnswer as $ans) {
			if(in_array($ans, $corrAns)){
				$CurrentQuestionPoint += 1;
			}
		}

		$charPoints += $CurrentQuestionPoint;
		array_push($UserPoints, $CurrentQuestionPoint);
		array_push($QuestionIds, $CurrentQuestion['questionId']);

		if(count($corrAns) != count($UserAnswer)){
			return false;
		}

		foreach($UserAnswer as $uans){
			if(!in_array($uans, $corrAns)){
				return false;
			}
		}
		return true;
	}


	// redirect to previous pages due to invalidation
	function previousPage($invalidType){

		if($invalidType == "answer"){
			$validErr = "<script>alert('Please choose your answers')</script>";
		}else if($invalidType == "topic"){
			$validErr = "<script>alert('Please choose a topic')</script>";
		}

		session_start();
		$_SESSION['validErr'] = $validErr;
		$_SESSION['user'] = $user;
		$_SESSION['userId'] = $userId;
		header("Location: {$_SERVER['HTTP_REFERER']}");
		exit();
	}



	// function  to calculate hp / total points
	function calBossHp($questionArray){

		$initialHp = 0;
		foreach ($questionArray as $q) {
			$initialHp += $q['points'];
		}
		return $initialHp;
	}


	// generate 10 or less random questions from topic
	function randomQuestions($questionArray){

		shuffle($questionArray);
		if(count($questionArray) > 10){
			array_slice($questionArray, 0, 9);
		}
		return $questionArray;
	}


?>

<?php
	require('model/questions.php');

	$topicErr=$questionErr=$optErr=$corrErr="";
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$topic = $_POST['topic'];
		$question = $_POST['question'];
		$options = $_POST['options'];
		$options = array_filter($options);
		if(!empty($_POST['correct'])){
			$correct = $_POST['correct'];			
		}else{
			$correct = [];
		}

		if(!empty($_POST['feedback'])){
			$feedback = $_POST['feedback'];		
		}else{
			$feedback = "";

		$action = $_POST['action'];


		if(check_valid()){

			//add to database...
			$points = count($correct);
			$id = add_question($dbname, $username, $password, $host, $topic, "MC", $question, $points, $feedback);

			for($i = 0; $i < count($options); $i++){
				$t = 0;
				if(isset($correct[$i])){
						$t = 1;
				}
				add_answer($dbname, $username, $password, $host, $options[$i], $id, $t);
			}

			if($action == 'Done'){
				header("Location: /www/first_group_project/game.php");
				exit();
				//return to main or whatever
			}

		}else{
			echo("Nope");
		}
		$pass = true;
		include('view/input_question_form.php');

		}

	}

	function check_valid(){
		global $topic, $question, $options, $correct;
		global $topicErr, $questionErr, $pointsErr, $optErr, $corrErr;
		$valid = true;

		if (empty($topic)){
			$topicErr = "<br>Topic is required";
			$valid = false;
		}
		if (empty($question)){
			$questionErr = "<br>Question is required";
			$valid = false;

		}

		if (empty($options) or count($options) < 2){
			$optErr = "<br>At least two options are required";
			$valid = false;
		}

		if (empty($correct)){
			$corrErr = "<br>A correct option is required";
			$valid = false;
		}

		if (count($correct) > count($options)){
			$corrErr = "<br>Empty option cannot be correct";
			$valid = false;
		}

		for($i=0; $i<count($correct); $i++){
			if(isset($correct[$i]) && !isset($options[$i])){
				$corrErr = "<br>Empty options cannot be correct";
				$valid = false;
			}
		}

		if(count(array_unique($options)) < count($options)){
			$optErr = "<br>You have duplicated options";
			$valid = false;
		}


		return $valid;
	}

?>
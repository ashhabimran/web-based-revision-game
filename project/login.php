S<?php

	require('model/user.php');



	$userErr=$passwordErr=$pointsErr=$confirmErr="";
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$usern = $_POST['UN'];
		$passw = $_POST['PW'];

		if(!empty($_POST['CPW'])){
			$confirm = $_POST['CPW'];			
		}else{
			$confirm = [];
		}

		$action = $_POST['action'];


		if(check_valid()){

			if($action == "Login"){

				$iffine = verification($dbname, $username, $password, $host, $usern, $passw);
				if (!empty($iffine)){
					session_start();
					$_SESSION['user'] = $usern;
					$_SESSION['userId'] = $iffine;
					$_SESSION['logged'] = true;
					header("Location: /www/first_group_project/game.php");
					exit();

				}else{
					$passwordErr = "incorrect username or password";
					$log = true;

					include('view/login_form.php');

				}

			}
			else{

				if(!addUser($dbname, $username, $password, $host, $usern, $passw, 0, 0, 1)){
					$userErr = "This username already exist, try again";
					$reg = true;
					include('view/register_form.php');
				}else{
					echo("fine");
					$log = true;
					include('view/login_form.php');

				}
			}
			

		}else{
			$log = true;
			include('view/login_form.php');
			
		}
	}

	

	function check_valid(){
		global $usern, $passw,$confirm,$action;
		global $userErr, $passwordErr, $confirmErr;
	    $valid = true;
		if (empty($usern))
		{
			$userErr = "User is required";
			//echo($userErr . "<br><br>");
			$valid = false;

		}
		if (empty($passw))
		{
			$passwordErr = "Password is required";
			//echo($passwordErr . "<br><br>");
			$valid = false;

		}


		if ($action == 'newuser'){

			if (empty($confirm))
			{
				$confirmErr = "Confirm password is required";
				//echo($confirmErr . "<br><br>");
				$valid = false;

			}
			if ($passw != $confirm){
				$confirmErr = "Two passwords are not the same, try again.";
				//echo($passconErr . "<br><br>");
				$valid = false;
			}
		}
		return $valid;
	}


?>

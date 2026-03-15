<!DOCTYPE html>
<link rel="shortcut icon" href="#">
<?php
	session_start();
	$logged = false;
	$userId = 0;
	$user = "";
	if(isset($_SESSION['userId'])){
		$userId = $_SESSION['userId'];
		$_SESSION['userId'] = $userId;
	}

	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];
	}


	$GPath = "http://localhost/www/first_group_project/game.php";
	$LPath = "http://localhost/www/first_group_project/view/login_form.php";
	$RPath = "http://localhost/www/first_group_project/userRecord.php";

	if(isset($_SESSION['logged'])){
		$logged = $_SESSION['logged'];
	}

	if($user != ""){
		$logged = true;
	}

	$GPath = "http://localhost/www/first_group_project/game.php";
	$LPath = "http://localhost/www/first_group_project/view/login_form.php";
	$RPath = "http://localhost/www/first_group_project/userRecord.php";
	$HPath = "http://localhost/www/first_group_project/view/home.php";
	$CPath = "http://localhost/www/first_group_project/view/input_question_form.php";


?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width", initial-scale="1.0">
	<title>Knowledge Seeker</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/www/first_group_project/view/button.css">
</head>
<body id="body">
	<div id="na">
		<div id="logo">Knowledge Seeker</div>
		<a onclick="" href="<?php echo($HPath)?>">Home</a>
		<a onclick="" href="<?php if(!$logged) echo $LPath; else echo $RPath ?>">Account</a>
		<a onclick="" href="<?php if(!$logged) echo $LPath; else echo $GPath ?>">Game</a>
		<a onclick="" href="<?php echo($CPath)?>">Customize</a>
	</div>

<br><br><br><br>
</body>

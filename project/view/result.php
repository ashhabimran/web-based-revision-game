<?php include('header.php');
	//session_start();
	$win = $_SESSION['win'];
	$user = $_SESSION['user'];
	$userId = $_SESSION['userId'];
	$message = "";
	if($win){
		$message = "You won! Well done $user :) Garry must had a bad time hehe <br><br>";
	}else{
		$message = "WASTED \n can't believe you are defeated by Garry mate :(  try again $user <br><br>";
	}

	$newGamePath = "http://localhost/www/first_group_project/game.php";
	$LeaderBoardPath = "http://localhost/www/first_group_project/userRecord.php";

	//session_destroy();

	if($user == ""){
		//session_start();
		$_SESSION['logged'] = false;
		$newGamePath = $LeaderBoardPath = "http://localhost/www/first_group_project/view/login_form.php"; 
		echo("<script>alert('Please login to start new game or to view leaderboard :) ')</script>");
	}

	$_SESSION['user'] = $user;
	$_SESSION['userId'] = $userId;
?>

<section id="resultform">
	<h1>Result</h1>

	<?php echo $message ?>

	<a href="<?php echo $newGamePath ?>">
   <button class="subbutton"> New Game</button>
	</a>

	<br><br>

	<a href="<?php echo $LeaderBoardPath?>">
   <button class="subbutton"> My Records </button>
	</a>

</section>

<?php include('footer.php')?>
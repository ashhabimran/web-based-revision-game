<?php include('header.php');
	//session_start();
	$answers = $_SESSION['answers'];
	$CurrentQuestion = $_SESSION['CurrentQuestion'];
	$bossLine = $_SESSION['bossLine'];
	$answered = $_SESSION['answered'];
	$act = "";
	$validErr = $_SESSION['validErr'];
	$bossHp = $_SESSION['bossHp'];
	$charPoints = $_SESSION['charPoints'];
	$charHp = $_SESSION['charHp'];
	$initialHp = $_SESSION['initialHp'];
	$user = $_SESSION['user'];
	$username = "Anonymous Traveller";
	if($user != ""){
		$username = $user;
	}

?>
<h1>Boss Battle</h1>
<section>
	<form action="../game.php" method="POST">

		<div id="game">
			<div id='img'>
				<div id='imgchar'>
					<?php
					echo("<label id='userID'>" . $username . "<br><br>" . "</label>");
					echo("Character HP: " . round(($charHp/$initialHp *100),2) . "% <br>");
					echo("<progress id='charHp' value='$charHp' max='$initialHp'></progress> <br><br>");
					echo("<img id='char' name = 'character' src = 'sprites/character.ext' alt='character'>");
					?>
				</div>
				<div id="imgboss">
					<?php
					echo("<label id='bossID'>Garry<br><br></label>");
					echo("Boss HP: " . round(($bossHp/$initialHp *100),2) . "% <br>");
					echo("<progress id='BossHp' value='$bossHp' max='$initialHp'></progress> <br><br>");
					echo("<img id='boss' name = 'boss' src = 'sprites/bossGary6.ext' alt='boss'>");
					?>
				</div>
			</div>
			
			<div id="conver">
				<?php
				echo("<label> Current Points: $charPoints <br><br>");

				if(!$answered){
					echo($validErr);

					echo("<label id='ques'> ". $CurrentQuestion['question'] . " </label>");
					echo("<br><br><br>");
					echo("<div id='options'>");
					foreach ($answers as $option){
						echo("<input type='checkbox' name='Options[]' value=". $option['answerId'] . ">" . $option['answer'] . "<br><br>");
					}
					echo("<br><br>");
					echo ("</div>");
					$act = "attack";

				}else{

					echo("<label>" . $bossLine . "</label><br><br>");
					echo("<label>" . $CurrentQuestion['feedback'] . "</label><br><br>");

					$act = "okay";
				}

				?>
				<br><br>
				<button class="subbutton" type="submit" name="action" value= <?php echo $act?> > <?php echo $act?>  </button>
			</div>
			
		</div>
		
	</form>
</section>

<?php include('footer.php')?>

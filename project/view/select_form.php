<?php include('header.php');

	//session_start();
	$topics = $_SESSION['topics'];
	$validErr = $_SESSION['validErr'];
	$user = $_SESSION['user'];
	$_SESSION['user'] = $user;
?>
<h1>Select A Topic</h1>
<section>
	<form id = "select" action="../game.php" method="post">
		<br><br>
		<label>Type:</label>
		<br><br>
		<select name="type" id="type">
			<option value="placeholder">-Select Type-</option>
			<option value="placeholder">-Default-</option>
			<option value="placeholder">-Customize-</option>
		</select>
		<br><br>
		<label>Course:</label>
		<br><br>
		<select name="course" id="course">
			<option value="placeholder">-Select Type-</option>
		</select>
		<br><br>
		<label>Topic:</label>
		<br><br>
		<select name="topic" id="topic">
			<option value="placeholder">-Select Type-</option>
			<?php

			foreach ($topics as $top) {
				echo("<option value='". $top['topic_name'] ."'>-" . $top['topic_name'] . "-</option>" );
			}
			echo($validErr);
			?>
		</select>
		<br><br><br>
		<input class="subbutton" type="submit" name="action" value="New Game" >
	</form>
</section>

<?php include('footer.php')?>
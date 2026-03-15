<?php include('header.php');
	if(!isset($userErr)){
		$userErr="";
	}
	if(!isset($passwordErr)){
		$passwordErr="";
	}
	if(!isset($confirmErr)){
		$confirmErr="";
	}

	if(!isset($reg)){
		$path = "../login.php";
		$logPath = "login_form.php";

	}else{
		$path = "#";
		$logPath = "view/login_form.php";
	}

?>

<section class="ftco-section">
		<style>
			body{
				background-image: url(sprites/loginback1.png);
				background-repeat: no-repeat;
				background-size: cover;
			}
		</style>

		<div class="container">
			<h1>Register</h1>
				<form action="<?php echo $path?>" method="post">
					<div class="inputWrapper">
						<!-- Username:  -->
						<input class="input_field" placeholder="Username" type="text" name="UN" autocomplete="off" id="input-1" required>
						<label class="input_label" for="input-1">Username*</label>
						<span class="error"><?php echo($userErr);?></span>
						<br><br>

						<!-- Password:  -->
						<input class="input_field2" placeholder="Password" type="password" name="PW" autocomplete="off" id="input-2" required>
						<label class="input_label2" for="input-2">Password*</label>
						<span class="error"><?php echo($passwordErr);?></span>
						<br><br>

						<!-- Confirm Password:  -->
						<input class="input_field3" placeholder="Confirm Password" type="password" name="CPW" autocomplete="off" id="input-3" required>
						<label class="input_label3" for="input-3">Confirm Password*</label>
						<span class="error"><?php echo($confirmErr);?></span>
					</div>

					<br><br>
					<button class="subbutton" type="submit" name="action" value="newuser">Register</button>
					<br><br>
					<a href="<?php echo $logPath;?>">Have an account? Login!</a>

				</form>
	</div>
</section>

<?php include('footer.php')?>

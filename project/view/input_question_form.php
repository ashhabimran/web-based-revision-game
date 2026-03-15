<?php include('header.php');

	if(!isset($topicErr)){
		$topicErr="";
	}
	if(!isset($questionErr)){
		$questionErr="";
	}

	if(!isset($optErr)){
		$optErr="";
	}
	if(!isset($corrErr)){
		$corrErr="";
	}

	if(!isset($pass)){
		$path = "../customizeQuestion.php";
	}else{
		$path = "#";
	}

	
?>
<h1>Customize</h1>
<section id="customize">
	<form action="<?php echo $path?>" method="post">
		<div id="inputWrapper">
			<label>Topic</label> <input type="text" name="topic" >
			<span class="error">*<?php echo($topicErr);?></span>
			<br><br>
			<label>Question</label> <input type="text" name="question">
			<span class="error">*<?php echo($questionErr);?></span>
			<br><br>
			<label>Option-1</label> <input type="text" name="options[]" >
			Correct? <input type="checkbox" name="correct[]" value="op1" checked>
			<span class="error"><?php echo($corrErr);?></span>
			<br><br>
			<label>Option-2</label> <input type="text" name="options[]" >
			Correct? <input type="checkbox" name="correct[]" value="op2">
			<span class="error"><?php echo($optErr);?></span>
			<br><br>
			<label>Option-3</label> <input type="text" name="options[]" >
			Correct? <input type="checkbox" name="correct[]" value="op3">
			<br><br>
			<label>Option-4</label> <input type="text" name="options[]" >
			Correct? <input type="checkbox" name="correct[]" value="op4">
			<br><br>
			<label>Feedback</label> <input type="text" name="feedback">
		</div>
		<br><br><br>
		
		<button class="subbutton" type="submit" name="action" value="Done">Done</button>
		<button class="subbutton" type="submit" name="action" value="Next">Next Question</button>
		
	</form>
</section>

<?php include('footer.php')?>
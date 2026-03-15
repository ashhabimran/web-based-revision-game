<?php include('header.php');
	
	$reviews = $_SESSION['pastReviews'];
	//var_dump($reviews);
?>
<h1>My Reviews</h1>
<section id="review">
		<form action="../userRecord.php" method="POST">
			<table id="reviewlist" align="center" border="5">
				<tr><th>Topic</th><th>Result</th><th>Time</th><th>Review Details</th></tr>
				<?php 
					foreach($reviews as $r){
						echo("<tr>");
						echo("<td>" . $r['topic_name'] . "</td>");
						echo("<td>" . $r['total_points_gained'] . "</td>");
						echo("<td>" . $r['record_time'] . "</td>");
						echo("<td><button type='submit' name='reviewId' value=" .$r['reviewId']. "> View Details </button></td>");
						echo("</tr>");
					}
				?>
			</table>
		</form>

		<form>
			<table id="records" align="center" border="5">	
				<?php 
					if(isset($_SESSION['past'])){
						$questions = $_SESSION['questions'];
						$answers = $_SESSION['answers'];
						$records = $_SESSION['records'];
						echo("<tr><th>Question</th><th>Correct Answer </th><th>Points Gained</th><th>Feedback</th></tr>");
						for($i=0; $i<count($questions); $i++){
							echo("<tr>");
							echo("<td>" . $questions[$i]['question'] . "</td>");
							echo("<td>" . $answers[$i]['answer'] . "</td>");
							echo("<td>" . $records[$i]['points_gained'] . "</td>");
							echo("<td>" . $questions[$i]['feedback'] . "</td>");
							echo("</tr>");
						}
					unset($_SESSION['past']);
					}					
				?>
			</table>
		</form>
</section>

<?php include('footer.php')?>

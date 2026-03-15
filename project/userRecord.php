<?php
	require('model/records.php');
	require('model/questions.php');

	session_start();
	if(!isset($_SESSION['userId'])){
		header("Location: /www/first_group_project/view/login_form.php");
		exit();
	}
	//$userId = $_SESSION['userId'];
	//$pastReviews = get_review($dbname, $username, $password, $host, $userId);


	if(!isset($_POST['reviewId'])){
		$userId = $_SESSION['userId'];
		$pastReviews = get_review($dbname, $username, $password, $host, $userId);
		$_SESSION['pastReviews'] = $pastReviews;

		header("Location: /www/first_group_project/view/userReviews.php");
		exit();
	}

	$reviewId = $_POST['reviewId'];
	$pastReviews = $_SESSION['pastReviews'];
	$questions = [];

	$key = array_search($reviewId, array_column($pastReviews, 'reviewId'));
	$selectedReview = $pastReviews[$key];
	$answers=[];
	$records = get_record($dbname, $username, $password, $host, $reviewId);
	foreach($records as $r) {
		array_push($questions, get_question_by_id($dbname, $username, $password, $host, $r['questionId']));
	}

	foreach ($questions as $q) {
		$EachAnswer = get_answer($dbname, $username, $password, $host, $q['questionId']);
		foreach ($EachAnswer as $ans) {
			if($ans['t_or_f'] == 1){
				array_push($answers, $ans);
			}
		}
	}

	unset($_POST['reviewId']);
	$_SESSION['past'] = true;
	$_SESSION['questions'] = $questions;
	$_SESSION['answers'] = $answers;
	$_SESSION['records'] = $records;
	header("Location: /www/first_group_project/view/userReviews.php");
	exit();

?>
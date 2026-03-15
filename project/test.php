<?php
	// echo("<p> Hello guys :) <br>");

	// $host = 'dbhost.cs.man.ac.uk';
	// // please enter your own username and password when trying to connect the database
	// $username = '';
	// $password = '';
	// $dbname = '2021_comp10120_r1';

	// try
	// {
 // 	$conn = new PDO("mysql:host=$host", $username, $password);
 // 	echo "Connected to $host successfully.";
	// }
	// catch (PDOException $pe)
	// {
 // 	die("Could not connect to $host :" . $pe->getMessage());
	// }


	$test = "hi";
	$arr = [];
	$testArr = ["1","2","3","4", "hi"];

	$total = 100;
	$g = 10;

	$st = $total + $g . "%";
	echo($st);

	if(in_array($test, $testArr)){
		array_push($arr, "bye");
	}

	changeHi();

	echo($test);
	var_dump($arr);

	function changeHi(){
		global $test;

		$test = "actually bye";
	}
?>

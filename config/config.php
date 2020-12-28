<?php 

	$timezone = date_default_timezone_set("Asia/Kolkata");

	// $DSN = 'mysql:host = localhost; dbname=blogsite';
	// $con = new PDO($DSN, 'root', '');

	$con = mysqli_connect('localhost', 'root', '', 'blogsite');
	if(mysqli_errno($con)){
		echo "Failed to connect database: " . mysqli_errno($con);
	}

 ?>
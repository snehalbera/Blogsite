<?php 

	$timezone = date_default_timezone_set("Asia/Kolkata");

	// DATA SOURCE NETWORK (DATABASE CONNECTION)
	$con = mysqli_connect('localhost', 'root', '', 'blogsite');
	if(mysqli_errno($con)){
		echo "Failed to connect database: " . mysqli_errno($con);
	}

 ?>
<?php
	/* Database connection start */
	$servername = "localhost";
	$username = "ventas-pos";
	$password = "pcnay2003";
	$dbname = "pos";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (mysqli_connect_errno())
	{
		printf("Connect failed: %sn", mysqli_connect_error());
		exit();
	}
?>
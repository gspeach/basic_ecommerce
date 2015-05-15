<?php
	define("DB_SERVER", "location");
	define("DB_USER", "username");
	define("DB_PASS", "password");
	define("DB_NAME", "dbname");

	// 1. Create a database connection
	$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	// Test if connection occurred.
	if (mysqli_connect_errno()){
		die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
	}
?>
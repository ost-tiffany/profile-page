<?php



	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "datatest";

	// Create connection
	$db = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($db->connect_error) {
	    die("Connection failed: " . $db->connect_error);
	}
	//echo "Connected successfully";
	// $db = mysqli_connect("localhost","root","","datatest");

	// $result = mysqli_query($db, "SELECT * FROM users");



	// function query($query) {
	// global $db;
	// $result = mysqli_query($db,$query);

	// $rows = [];
	// 	while ($row = mysqli_fetch.assoc($result)) {
	// 		$rows[] = $row;
	// 	}
	// 	return $rows;
	// }

 ?>
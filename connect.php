<?php

	$db = mysqli_connect("localhost","root","","datatest");

	$result = mysqli_query($db, "SELECT * FROM users");



	function query($query) {
	global $db;
	$result = mysqli_query($db,$query);

	$rows = [];
		while ($row = mysqli_fetch.assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}

	function add_user($data) {
		global $db;
		$name = $_POST["nickname"];
		$username = $_POST["user_name"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$sex = $_POST["gender"];
		$at = 


		if(isset($_POST["submit"])) {

			$query = "insert into users (user_name, nickname, email, password, birthday, gender)
			values ('$username','$name','$email','$password','','$sex')";

			mysqli_query($db,$query);
		}
	}



 ?>
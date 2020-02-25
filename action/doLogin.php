<?php
session_start();

include '../connect.php';

if (isset($_POST["login"])) {
	
	$username = $_POST["user_name"];
	$password = $_POST["password"];
	$failmessage = "password and email is not exists";

	$samesame = "SELECT * FROM users WHERE (user_name = '$username' OR email = '$username') AND password = '$password'";

	$result = $db->query($samesame);

	if ($result->num_rows == 0) {
		echo "<script> window.location.href = '../login.php?error=".$failmessage."'; </script>";
	} else {
			//$_SESSION["login"] = true;
			//$_SESSION["nickname"] =
			//$_SESSION["user_name"] =
			//$_SESSION["email"] = 
		//echo "<script> window.location.href = '../index.php?name=".$_SESSION["nickname"]."'; </script>";
	}

}

 ?>
<?php
session_start();

include '../connect.php';

if (isset($_POST["login"])) {
	
	$username = $_POST["user_name"];
	$password = $_POST["password"];
	$failmessage = "password and email is not exists";

	$samesame = "SELECT * FROM users WHERE (user_name = '$username' OR email = '$username') AND password = '$password' AND deleted_flag = 0 ";

	$result = $db->query($samesame);

	if ($result->num_rows == 0) {
		echo "<script> window.location.href = '../login.php?error=".$failmessage."'; </script>";
	} else {

			$_SESSION["login"] = true;

			//fetch disni
				while ($hasil = $result->fetch_assoc()) {
					$_SESSION["user_id"] = $hasil["user_id"];
					$_SESSION["user_name"] =  $hasil["nickname"];	
				}
			echo "<script> window.location.href = '../index.php'; </script>";
			// var_dump($hasil);	
	}
}

 ?>
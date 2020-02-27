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

			$_SESSION["login"] = true;

			//fetch disni
				while ($hasil = $result->fetch_assoc()) {
					$_SESSION["username"] = $hasil["user_name"];
					$_SESSION["nickname"] = $hasil["nickname"];
					$_SESSION["email"] = $hasil["email"];
					$_SESSION["birthday"] = $hasil["birthday"];
					$_SESSION["gender"] =  $hasil["gender"] == 1 ?
									"male" : "female";
					$_SESSION["deleted_flag"] = $hasil["deleted_flag"];
				}
			echo "<script> window.location.href = '../index.php'; </script>";
		
	}

var_dump($deleted_flag1);
}

 ?>
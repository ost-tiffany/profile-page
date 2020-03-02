<?php 
session_start();

include '../connect.php';
$deleteid = $_SESSION["user_id"];

$deleteToDB = "UPDATE users SET deleted_flag = 1 WHERE user_id = '$deleteid'";
$resultDB = $db->query($deleteToDB);


		if($resultDB) {
			header("Location:../erase.php?message=succeed");
		} else {
			header("Location:../erase.php?message=failed");
		}

 ?>
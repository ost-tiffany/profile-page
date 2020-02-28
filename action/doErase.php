<?php 
session_start();

include '../connect.php';

$userdelete = $_SESSION["username"];

$deleteToDB = "UPDATE users SET deleted_flag = 1 WHERE user_name = '$userdelete'";
$resultDB = $db->query($deleteToDB);

	if($resultDB) {
 		header("Location:../erase.php?message=succeed");
 	} else {
 		header("Location:../erase.php?message=failed");
 }
 ?>
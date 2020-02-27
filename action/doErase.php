<?php 
session_start();

include '../connect.php';

$userdelete = $_SESSION["username"];

$deleteToDB = "UPDATE users SET deleted_flag = 1 WHERE user_name = '$userdelete'";
$resultDB = $db->query($deleteToDB);

	if(!$resultDB == TRUE) {
 		header("Location:../erase.php?message=success");
 	} else {
 		header("Location:../erase.php?message=failed");
 }
 ?>
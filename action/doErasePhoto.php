<?php 
session_start();

include '../connect.php';
$deletephotoid = $_GET["id"];

$deletephotoToDB = "UPDATE products SET delete_flag = 1 WHERE product_id = '$deletephotoid'";
$resultphotoDB = $db->query($deletephotoToDB);

		if($resultphotoDB) {
			header("Location:../erasephoto.php?message=succeed");
		} else {
			header("Location:../erasephoto.php?message=failed");
		}

 ?>
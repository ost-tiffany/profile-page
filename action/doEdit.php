<?php 

session_start();

include '../connect.php';

$useredit = $_SESSION["user_id"];
$nicknameedit = $_POST['editnickname'];
$usernameedit = $_POST["edituser_name"];
$emailedit =  $_POST["editemail"];
$birthdayedit = $_POST["editbirthday"];
$passwordedit = $_POST['editpassword'];
$genderedit = $_POST["genderedit"];

$checkuser= "SELECT * FROM users WHERE (user_name = '$usernameedit' OR email = '$emailedit')";

$checkuserdb=$db->query($checkuser);
$messages = array();


	if(isset($_POST["submitedit"])) {
	 if ($checkuserdb->num_rows > 0) {
        // output data of each row
        $row = $checkuserdb->fetch_assoc();
        	if ($usernameedit==$row['user_name']) {
           		array_push($messages, "Username already exists");
        	}
     		if ($emailedit==$row['email']) {
            	array_push($messages, "Email already exists");
        	}
    	}

    	$editDB = "UPDATE users SET 
    				user_name = '$usernameedit',
    				nickname = '$nicknameedit',
    				email = '$emailedit',
    				password = '$passwordedit',
    				birthday = '$birthdayedit',
    				gender = '$genderedit',
	 				WHERE user_id = '$useredit'";
 	 	
 	 	$result = $db->query($editDB);

 	 	if ($result) {
 	 		array_push($messages, "data changed");
 	 	} 

 	 	else {
 	 		array_push($messages, "data failed to be changed");
 	 	}

		
		if(count($messages) > 0) {

		 	for ($i = 0; $i < count($messages); i++) {
  				$messages = $message;
			}
 		
 	 	}
 			header("Location:../edituser.php");
		}
 ?>
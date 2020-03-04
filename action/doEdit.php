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

	if(isset($_POST["submitedit"])) {

        // output data of each row
		while ($row = $checkuserdb->fetch_assoc()) {
			$samanama = $row['user_name'];
			$samaemail = $row['email']; 
	
		}
			

    	$editDB = "UPDATE users SET 
    				user_name = '$usernameedit',
    				nickname = '$nicknameedit',
    				email = '$emailedit',
    				password = '$passwordedit',
    				birthday = '$birthdayedit',
    				gender = '$genderedit'
	 				WHERE user_id = '$useredit'";
 	 	// echo $editDB;
 	 	$result = $db->query($editDB);
		$messages = array();
		if ($usernameedit == $samanama) {
			array_push($messages, "email already exists");
		}
		 
	  	if ($emailedit == $samaemail) {
		 	array_push($messages, "username already exists");
		}

		if(!$result) {
			array_push($messages, "error");
		}
		
		if(count($messages) > 0) {
			$message ='';
			//perulangan 
			$temp = 1;
			for ($i = 0; $i < count($messages); $i++) {
				//klo i yang ud terakhir i==1  | 2-1 = 1
				if($i == count($messages) - 1)
				{
					$message .= 'note'.$temp.'='.$messages[$i];
					//note2=username already exists
				} else {
					//note1=email already exists&
					$message .= 'note'.$temp.'='.$messages[$i].'&';
				}
				
				  //temp = temp + 1;
				  $temp++;
				  
			}
			header("Location:../edituser.php?".$message);
		} 
		
		if($result) {
			$success="data has been changed";
			//success no error 
			header("Location:../edituser.php?message=".$success);
		}

		
	}
 ?>
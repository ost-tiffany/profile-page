<?php
include '../connect.php';

//validation 


//insert database

	//klo tombol submit di click
	if(isset($_POST["submit"])) {

		$nickname = $_POST['nickname'];
		$username = $_POST['user_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$birthday = $_POST['birthday'];
		$sex = $_POST['gender'];

		$sameemail = "SELECT * FROM users WHERE email = '$email'";
		$sameusername = "SELECT * FROM users WHERE user_name = '$username'";
		$errormessage = array();

		//ini jalan, knp harus disini, karena query atribut mysqli,mysqli ini udh dibungkus di db
		$hasilemail = $db->query($sameemail);
		$hasilusername = $db->query($sameusername);

			if ($hasilemail->num_rows > 0 ) {
				//disini messagenya dipush
				array_push($errormessage, "email already exists");
			}
			if ($hasilusername->num_rows > 0) 	{
				//array_push kan baru masukin yak
				array_push($errormessage,"username already exists");

			}

			// saat ada error :
			if(count($errormessage) > 0) {
				$true_error_message ='';
				//perulangan 
				$temp = 1;
				for ($i = 0; $i < count($errormessage); $i++) {
					//klo i yang ud terakhir i==1  | 2-1 = 1
					if($i == count($errormessage) - 1)
					{
						$true_error_message .= 'note'.$temp.'='.$errormessage[$i];
						//note2=username already exists
					} else {
						//note1=email already exists&
						$true_error_message .= 'note'.$temp.'='.$errormessage[$i].'&';
					}
					
  					//temp = temp + 1;
  					$temp++;
  					
  				}
  				//echo $true_error_message;	
  				//note1=error1&note2=error2

  				//disini baru diset/lempar messagenya
				echo "<script> location.href='../registration.php?".$true_error_message."'; </script>";
				return false;
			}


			//success the validation
			$command = "INSERT INTO users (user_name,nickname,email,password,birthday,gender)
	 			VALUES ('$username','$nickname','$email','$password','$birthday','$sex')";

		 	//kalo masuk database

		 	//db->query == execute query dari db->query(QUERY)
		 	if ($db->query($command)) {
		 	// echo "New record created successfully";
		 	// echo "<script> window.location.href = '../success.php'; </script>";
		 	$last_id = $db->insert_id;

		 	echo $last_id;
		 	echo "<script> location.href='../success.php?id=".$last_id."'; </script>";

			} else {
			// echo 'エラー発生！';
			 	echo "Error: " . $query . "<br>" . $db->error;
			}
			
			// if (mysqli_num_rows($sameusername) > 0) {
			// 	echo "username already exists";
			// 	echo "<script> location.href='registration.php'; </script>";
			// 	exit;
			// }

	} 
	//kalo tombol submit ga diklik
	else {
		echo "error";
	}

?>



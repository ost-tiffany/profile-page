<?php

require 'connect.php';

$id = $_GET["id"];
//echo $id;

$query = "SELECT * FROM users WHERE user_id = $id";
//echo $query;
$result = $db->query($query); //execute select 

//num_rows = total dari select 
// if($result->num_rows != 1) {
// 	echo 'エラー！';
// } else {
// 	// klo 1
// 	while($hasildata = $result->fetch_assoc()) {
// 		// data dari database dijadiin array
// 		// var_dump($hasildata);
// 	 	 echo "<br> id: ". $hasildata["nickname"]. " - email: ". $hasildata["email"]. " " . $hasildata["birthday"] . "<br>";
// 	}
// }
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Registration Success</title>

	<meta charset="utf-8">

	<!-- redirect to login -->
	<meta http-equiv="Refresh" content="10; url=login.php" />

	<!-- responsive meta tag -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Registration</title>

	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	
	<!-- css biasa -->
	<link rel="stylesheet" type="text/css" href="style.css">

	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Bad+Script&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Satisfy&display=swap" rel="stylesheet"> 

	<!-- Javascript -->
	<script type="text/javascript" src="bootstrap/js/jquery-3.4.1.slim.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>


</head>
<body>

	<div class="mx-auto">

		<?php if($result->num_rows != 1) { ?>
			<p style="color: red;"> Fail to Sign-up </p>
		<?php } else { 

					while($hasildata = $result->fetch_assoc()) { ?>
					<h1  class="col-md-6 offset-md-3 head">New record created successfully</h1>

					<table class="rows center_form">
						<tr>
							<td><strong>Name</strong></td>
							<td>:<td>
							<td><?= $hasildata["nickname"] ?></td>
						</tr>

						<tr>
							<td><strong>User Name</strong></td>
							<td>:<td>
							<td><?= $hasildata["user_name"] ?></td>
						</tr>

						<tr>
							<td><strong>Email</strong></td>
							<td>:<td>
							<td><?= $hasildata["email"] ?></td>
						</tr>

						<tr>
							<td><strong>Birthday</strong></td>
							<td>:<td>
							<td><?= $hasildata["birthday"] ?></td>
						</tr>

						<tr>
							<td><strong>Gender</strong></td>
							<td>:<td>
							<td>
								<!-- ternary operator -->
								<?php 
									$gender = $hasildata["gender"] == 1 ?
									"male" : "female";

									echo $gender;
								?>	
							</td>
						</tr>

					</table> 

				<?php } ?>
		<?php } ?>

	</div>

	<p>automatically redirect to login after 10 seconds <br>
		 or <a href="login.php">click here</a>.</p>

</body>
</html>

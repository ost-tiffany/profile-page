<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<!-- responsive meta tag -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<title>Log In</title>

	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	
	<!-- css biasa -->
	<link rel="stylesheet" type="text/css" href="style.css">

		<!-- Javascript -->
	<script type="text/javascript" src="bootstrap/js/jquery-3.4.1.slim.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>

	<!-- Validation Javascript -->
	<script type="text/javascript" src="validation.js"></script>

</head>

<body>

	<!-- Log in  -->
	<h1>Log-In</h1>

	<form name="loginform"  id="loginform"action="" method="POST" class="rows center_form" style="width: 500px; 	text-align: center;">
	  <div class="form-group">
	    <label for="user_name">Username</label>
	    <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="myname / myname@gmail.com">
	  </div>

	  <div class="form-group">
	    <label for="Password">Password</label>
	    <input type="password" class="form-control" id="Password">
	  </div>

	  <button type="submit" class="btn btn-secondary btn-sm" onclick="">log-in</button>
	</form>



	<p style="text-align: center;">No account? <a href="registration.php">click here</a></p>

</body>
</html>
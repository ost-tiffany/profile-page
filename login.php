<?php 
session_start();
	if (isset($_SESSION["login"])) {
		header("Location: index.php");
		exit;
	}

	require'connect.php'; 


?>


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


</head>

<body>

	<!-- Log in  -->
	<h1>Log-In</h1>

	<form name="loginform"  id="loginform" action="action/doLogin.php" method="POST" class="rows center_form" style="width: 500px; text-align: center;">
	  <div class="form-group">
	    <label for="user_name">Username</label>
	    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="email or username">
	  </div>

	  <div class="form-group">
	    <label for="password">Password</label>
	    <input type="password" class="form-control" id="password" name="password">
	  </div>
 
		<input type="submit" class="btn btn-secondary btn-sm" value="Login" id="login" name="login" >

		<!-- <div class="form-group form-check" style="margin-top: 20px; font-size: 12px; text-align: left;">
    		<input type="checkbox" class="form-check-input" id="exampleCheck1">
    		<label class="form-check-label" for="exampleCheck1">Check me out</label>
    	</div> -->

    <div style="color: red;">
    	<?php
    		if(isset($_GET["error"])) {
    			$failmesssage = $_GET["error"];
    		 	 echo $failmesssage; 
    		 } 
    	?>
    </div>

 	<div id="errorcontainer">
 		<p id="errormessage" style="color: red;"></p>
 	</div>

	</form>

	

<script>
$("#loginform").submit(function(event) {

	var errormessage = [];
	var regex = RegExp("^[a-zA-Z0-9]*$");
	var username = $("#user_name").val();
	var password = $("#password").val();
  
  	if(username == "") {
    	errormessage.push("please input your username");
	}

 	if(password == "") {
    	errormessage.push("please input your password");
  	}

  	if (!regex.test(password)) {
    	errormessage.push("password format must be alphanumeric");
  	}

  	if (errormessage.length > 0 ) {
  		event.preventDefault();
  		temp = [];
  		for (var i = 0; i < errormessage.length; i++) {
  			temp.push('<p>'+errormessage[i]+'</p><br>');		
  		}

  		$("#errormessage").html(temp);
    	return false;
	}
	
	}

);
</script>

	<p style="text-align: center;">No account? <a href="registration.php">click here</a></p>

</body>
</html>


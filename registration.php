<?php require'connect.php';

if(isset($_POST["submit"])) {
	if(add_user($_POST) > 0) {
		echo " 	<script>
					alert('success adding user');
					document.location.href ='index.php';
				</script>";
	} else {
		echo "fail";
		echo mysqli_error($db);
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">

	<!-- responsive meta tag -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<title>Registration</title>

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
	<h1>Sign-Up</h1>

	<!-- Registration form -->

	<form name="signupform"  id="signupform" action="" method="POST" class="rows center_form" style="width: 600px; text-align: left;">
	  <div class="form-group row">
	  	 <label for="nickname" class="col-sm-2 col-form-label">Name</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="nickname" name="nickname" placeholder="Irene Ford">
	    </div>
	  </div>

	  <div class="form-group row">
	  	 <label for="user_name" class="col-sm-2 col-form-label">Username</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Irenef123">
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="email" class="col-sm-2 col-form-label">Email</label>
	    <div class="col-sm-10">
	      <input type="email" class="form-control" id="email" name="email" placeholder="ireneford@email.com">
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="password" class="col-sm-2 col-form-label">Password</label>
	    <div class="col-sm-10">
	      <input type="password" class="form-control" id="password" name="password">
	    </div>
	  </div>

	  <fieldset class="form-group" id="gender" name="gender">
	    <div class="row">
	      <legend class="col-form-label col-sm-2 pt-0">Sex</legend>
	      <div class="col-sm-10">
	        <div class="form-check">
	          <input class="form-check-input" type="radio" name="gender" value="1">
	          <label class="form-check-label" for="gender1">
	            Male
	          </label>
	        </div>

	        <div class="form-check">
	          <input class="form-check-input" type="radio" name="gender" value="2">
	          <label class="form-check-label" for="gender2">
	            Female
	          </label>
	        </div>
	      </div>
	    </div>
	  </fieldset>


	  <div class="form-group row">
	    <div class="col-sm-10">
	      <input type="submit" class="btn btn-secondary btn-sm" value="Sign in">
	    </div>
	  </div>

	</form>
	

	<div id="errorcontainer">
 		<p id="errormessage" style="color: red;"></p>
 	</div>


<script>
	$("#signupform").submit(function(event) {
	event.preventDefault();

	var errormessage = [];
	var regex = RegExp("^[a-zA-Z0-9]*$");
	var name = $("#nickname").val();
	var username = $("#user_name").val();
	var email =  $("#email").val();
	var password = $("#password").val();
	var sex = $("input[name='gender']:checked");
  
  	if(name == "") {
    	errormessage.push("please input your name");
	}

	if(!regex.test(name)) {
     	errormessage.push("name format must be alphanumeric");
 	}

	if(username == "") {
    	errormessage.push("please input your username");
    }

	if(!regex.test(username)) {
     	errormessage.push("username format must be alphanumeric");
 	}

 	if(email == "") {
     	errormessage.push("please input your email");
 	}

 	if(password == "") {
    	errormessage.push("please input your password");
  	}

  	if (!regex.test(password)) {
    	errormessage.push("password format must be alphanumeric");
  	}

  	if ($("input[name='gender']:checked").length === 0) {
    	errormessage.push("gender hasn't been decided");
  	}

  	if (errormessage.length > 0 ) {
  		temp = [];
  		for (var i = 0; i < errormessage.length; i++) {
  			temp.push('<p>'+errormessage[i]+'</p>');		
  		}

  		$("#errormessage").html(temp);
    	return false;
 	}

 	// $("#errormessage").hide();

});
</script>



	<p>back to <a href="login.php">Log-in</a>.</p>
</body>
</html>
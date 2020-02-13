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

	<!-- Validation Javascript -->
	<script type="text/javascript" src="validation.js"></script>


</head>


<body>
	<h1>Sign-Up</h1>

	<!-- Registration form -->

	<form name="signupform"  id="signupform" action="" method="POST" class="rows center_form" style="width: 600px; text-align: left;">
	  <div class="form-group row">
	  	 <label for="nickname" class="col-sm-2 col-form-label">Name</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="nickname" placeholder="Irene Ford">
	    </div>
	   </div>

	    <div class="form-group row">
	  	 <label for="nickname" class="col-sm-2 col-form-label">Username</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="username" placeholder="Irenef123">
	    </div>
	   </div>

	   <div class="form-group row">
	    <label for="email" class="col-sm-2 col-form-label">Email</label>
	    <div class="col-sm-10">
	      <input type="email" class="form-control" id="email" placeholder="ireneford@email.com">
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="password" class="col-sm-2 col-form-label">Password</label>
	    <div class="col-sm-10">
	      <input type="password" class="form-control" id="password">
	    </div>
	  </div>

	  <fieldset class="form-group">
	    <div class="row">
	      <legend class="col-form-label col-sm-2 pt-0">Sex</legend>
	      <div class="col-sm-10">
	        <div class="form-check">
	          <input class="form-check-input" type="radio" name="gender" id="gender1" value="male" checked>
	          <label class="form-check-label" for="gender1">
	            Male
	          </label>
	        </div>

	        <div class="form-check">
	          <input class="form-check-input" type="radio" name="gender" id="gender2" value="female">
	          <label class="form-check-label" for="gender2">
	            Female
	          </label>
	        </div>
	      </div>
	    </div>

	  </fieldset>


	  <div class="form-group row">
	    <div class="col-sm-10">
	      <button type="submit" class="btn btn-secondary btn-sm" onclick="validate()">Sign in</button>
	    </div>
	  </div>


	  <div>
	  	<p id="error"></p>
	  </div>

</form>


	<p>back to <a href="login.php">Log-in</a>.</p>
</body>
</html>
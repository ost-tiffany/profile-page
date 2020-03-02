<?php 
 session_start();
 $timeoutedit = 60;
	if (!isset($_SESSION["login"])) {
		header("Location: login.php");
		exit;
	}
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeoutedit)) {
    // last request was more than 30 minutes ago
    	session_unset();     // unset $_SESSION variable for the run-time 
    	session_destroy();   // destroy session data in storage
    	header("Location: login.php?error=no activity for 30s");
	}

	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


require'connect.php';


 ?>

 <!DOCTYPE html>
 <html>
	<?php
		include('elements/header.php');
	?>

 	<title>Edit Account</title>


 <body>

 	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

	 <!-- content -->
	<h1  class="col-md-6 offset-md-3 head"> Data </h1>


	<!-- edit form -->
	<form name="editform"  id="editform" action="action/doEdit.php" method="POST" class="rows center_form" style="width: 600px; text-align: left; margin-top:50px; margin-bottom:50px;">
		<div class="form-group row">
	  		<label for="nickname" class="col-sm-2 col-form-label">Name</label>
	    	<div class="col-sm-10">
	      		<input type="text" class="form-control" id="editnickname" name="editnickname">
	    	</div>
	  	</div>

	  	<div class="form-group row">
	  		<label for="user_name" class="col-sm-2 col-form-label">Username</label>
	    	<div class="col-sm-10">
	      		<input type="text" class="form-control" id="edituser_name" name="edituser_name">
	    	</div>
	  	</div>

	  	<div class="form-group row">
	    	<label for="email" class="col-sm-2 col-form-label">Email</label>
	    	<div class="col-sm-10">
	      		<input type="email" class="form-control" id="editemail" name="editemail">
	    	</div>
	  	</div>

	  	<div class="form-group row">
	    	<label for="password" class="col-sm-2 col-form-label">Password</label>
	    	<div class="col-sm-10">
	      		<input type="password" class="form-control" id="editpassword" name="editpassword">
	    	</div>
	  	</div>

		<div class="form-group row">
	    	<label for="password" class="col-sm-2 col-form-label">Birthday</label>
	    	<div class="col-sm-10">
	      		<input type="date" class="form-control" id="editbirthday" name="editbirthday" >
	    	</div>
	  	</div>

	  	<fieldset class="form-group" id="genderedit" name="genderedit">
	    	<div class="row">
	      		<legend class="col-form-label col-sm-2 pt-0">Sex</legend>
	      		<div class="col-sm-10">
	        		<div class="form-check">
	          			<input class="form-check-input" type="radio" name="genderedit" value="1" checked>
	          			<label class="form-check-label" for="gender1">
	            		Male
	          			</label>
	        		</div>

	        		<div class="form-check">
	          			<input class="form-check-input" type="radio" name="genderedit" value="2">
	          			<label class="form-check-label" for="gender2">
	            		Female
	          			</label>
	        		</div>
	      		</div>
	    	</div>
	  	</fieldset>


	  	<div class="form-group row">
	    	<div class="col-sm-10">
	      		<input type="submit" name="submitedit" class="btn btn-secondary btn-sm" value="edit">
	    	</div>
	  	</div>

	  	 <div>
	    	<?php
	    	if (isset($_GET["note1"])) {
	    		echo $_GET["note1"];	
	    	}
	    	 ?>
	    </div>

		
		<div>
	    	<?php
	    	if (isset($_GET["note2"])) {
	    		echo $_GET["note2"];	
	    	}
	    	 ?>
	    </div>

		<div>
	    	<?php
	    	if (isset($_GET["note3"])) {
	    		echo $_GET["note3"];	
	    	}
	    	 ?>
	    </div>

		<div>
	    	<?php
	    	if (isset($_GET["message"])) {
	    		echo $_GET["message"];	
	    	}
	    	 ?>
	    </div>



	  	<div id="errorcontainer">
 			<p id="errormessage" style="color: red;"></p>
	 	</div>

	</form>

 	<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>

	<script>
	$("#editform").submit(function(event) {
	
	var errormessage = [];
	var regex = RegExp("^[a-zA-Z0-9]*$");
	var name = $("#editnickname").val();
	var username = $("#edituser_name").val();
	var email =  $("#editemail").val();
	var password = $("#editpassword").val();
	var sex = $("input[name='genderedit']:checked");

	if(name == "" || username == "" || email == "" || password == "") {
		errormessage.push("please fill all the column");
	}
	
	if(!regex.test(name)) {
     	errormessage.push("name format must be alphanumeric");
 	}

	if(!regex.test(username)) {
     	errormessage.push("username format must be alphanumeric");
 	}

  	if (!regex.test(password)) {
    	errormessage.push("password format must be alphanumeric");
  	}

  	if (errormessage.length > 0 ) {
  		event.preventDefault();
  		temp = [];
  		for (var i = 0; i < errormessage.length; i++) {
  			temp.push('<p>'+errormessage[i]+'</p>');		
  		}

  		$("#errormessage").html(temp);
    	return false;
 	}
});
</script>

 </body>
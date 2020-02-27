<?php 
session_start();
$timeout = 30;
	if (!isset($_SESSION["login"])) {
		header("Location: login.php");
		exit;
	}
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    // last request was more than 30 minutes ago
    	session_unset();     // unset $_SESSION variable for the run-time 
    	session_destroy();   // destroy session data in storage
    	header("Location: login.php?error=no activity for 30s");
	}

	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


require'connect.php';


 ?>

<!DOCTYPE html>
<html lang="en">

<?php
	include('elements/header.php');
?>

	<title>My Page</title>



<body>

	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

	<!-- content -->
	<h1  class="col-md-6 offset-md-3 head">Your Data Profile</h1>


	<table class="col-md-6 offset-md-5" style="text-align: left; width: 500px;">
	    <tr>
	    	<tr>
				<td scope="row"> <a href="action/doEdit.php" >edit</a> | <a href="action/doErase.php" type="submit" onclick="confirm('are you sure?'); confirm('really really sure?');" name="delete" id="delete">delete</a> </td>
			</tr>	

	      <th scope="row">Username</th>
	       <td>:</td>
	      <td><?= $_SESSION['username']; ?></td>
	    </tr>
	    <tr>
	      <th scope="row">Name</th>
	       <td>:</td>
	      <td><?= $_SESSION['nickname']; ?></td>
	    </tr>
	    <tr>
	      <th scope="row">Email</th>
	       <td>:</td>
	      <td><?= $_SESSION['email']; ?></td>
	    </tr>
	    <tr>
	      <th scope="row">Gender</th>
	       <td>:</td>
	      <td><?= $_SESSION["gender"]; ?></td>
	    </tr>
	    <tr>
	      <th scope="row">Birthdate</th>
	       <td>:</td>
	      <td><?= $_SESSION["birthday"]; ?></td>
	    </tr>
		    
	</table>

	<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>

	</script>

</body>
</html>


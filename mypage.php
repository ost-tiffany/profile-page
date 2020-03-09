<?php 
session_start();
$timeout = 60;
	if (!isset($_SESSION["login"])) {
		header("Location: login.php");
		exit;
	}
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    // last request was more than 30 minutes ago
    	session_unset();     // unset $_SESSION variable for the run-time 
    	session_destroy();   // destroy session data in storage
    	header("Location: login.php?error=no activity for 60s");
	}

	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

	
require'connect.php';

// database data
$usernameaccount = $_SESSION["user_name"];	
$userprofile = "SELECT * FROM users WHERE user_name = '$usernameaccount'";
$result = $db->query($userprofile);

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

	<!-- banner -->
	<img src="images/banner4.jpg" class="img-fluid banner" alt="sky">

	<!-- content -->
	<h1  class="col-md-6 offset-md-3 head">Your Data Profile</h1>

	<?php while ($hasil = $result->fetch_assoc()) { ?>

	<table class="col-md-6 offset-md-5" style="text-align: left; width: 500px;">
	    <tr>
	    	<tr>
				<td scope="row"> 
				<a href="edituser.php" type="submit" name="edit" id="edit" >edit</a> | 
				<a href="#" type="submit" name="delete" id="delete" onclick=confirmerase();>delete</a>
				</td>
			</tr>	

		<tr>
		<th scope="row">User id</th>
	       <td>:</td>
	      <td><?=  $hasil["user_id"]; ?></td>
	    </tr>
	      <th scope="row">Username</th>
	       <td>:</td>
	      <td><?= $hasil["user_name"]; ?></td>
	    </tr>
	    <tr>
	      <th scope="row">Name</th>
	       <td>:</td>
	      <td><?= $hasil["nickname"]; ?></td>
	    </tr>
	    <tr>
	      <th scope="row">Email</th>
	       <td>:</td>
	      <td><?= $hasil["email"]; ?></td>
	    </tr>
	    <tr>
	      <th scope="row">Gender</th>
	       <td>:</td>
	      <td><?= $hasil["gender"] == 1 ?
				"male" : "female"; ?></td>
	    </tr>
	    <tr>
	      <th scope="row">Birthdate</th>
	       <td>:</td>
	      <td><?= $hasil["birthday"]; ?></td>
	    </tr>
	   
	</table>

	<script>
	function confirmerase() {
            var conf = confirm("Are you sure you want to delete your account?");
            if(!conf) { 
				document.location.href = 'mypage.php';
				return false;
            } else {
				document.getElementById("delete").href ="action/doErase.php";
			}
        }
	</script>

	<?php } ?>

	<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>

</body>
</html>


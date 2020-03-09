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

 ?>


<!DOCTYPE html>
<html lang="en">

<?php
	include('elements/header.php');
?>

	<title>Contact</title>


<body>

	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

	 <!-- banner -->
	<img src="images/banner2.png" class="img-fluid banner" alt="earth">

	 <!-- content -->
	<h1  class="col-md-6 offset-md-3 head">Contact Info </h1>

		<p>please call or email to : <br>
			070-4060-1808 <br>
			lorem@ipsun.com <p>

		<p> Thank You<p>

<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>


</body>
</html>
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

	<title>Gallery</title>

<body>
	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

	 <!-- banner -->
	<img src="images/banner3.jpg" class="img-fluid banner" alt="sky">

	  <!-- content -->
	<h1  class="col-md-6 offset-md-3 head">Gallery </h1>
	 

	 	<!-- Log-out -->
	<p class="text-center"><a href="login.php">Log-out</a>.</p>


	<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>



</body>
</html>
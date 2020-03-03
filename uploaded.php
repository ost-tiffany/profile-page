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

$message = $_GET["note"];

 ?>

 <!DOCTYPE html>
 <html>
	<?php
		include('elements/header.php');
	?>

 	<title>Upload Result</title>


 <body>

 	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

	<div class="rows center_form" style="width: 500px; border-color:lightgray; margin-top: 40px;" >
		<p><?php echo $message; ?> to upload photo<p>
	</div>
    <p style="text-align: center;">go back to <a href="gallery.php">gallery</a></p>

 	<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>
 </body>
 </html>
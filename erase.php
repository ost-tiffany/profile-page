<?php 
session_start();

$timeout = 30;
	if($_SESSION["deleted_flag"] == 0) {
		if (!isset($_SESSION["login"])) {
		header("Location: login.php");
		exit;
		}
		if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    	session_unset();    
    	session_destroy(); 
    	header("Location: login.php?error=no activity for 30s");
	}

	$_SESSION['LAST_ACTIVITY'] = time();

	} else {
		$_SESSION = [];
		session_unset();
		session_destroy();
	}


require 'connect.php';

 ?>

 <!DOCTYPE html>
 <html>
	<?php
		include('elements/header.php');
	?>

 	<title>Delete Account</title>


 <body>

 	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

	<div class="rows center_form" style="width: 500px; border-color:lightgray; margin-top: 40px;" >
		<?php if($_SESSION["deleted_flag"] == 1) { echo $success; } ?>
	</div>

 	<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>
 </body>
 </html>
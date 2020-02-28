<?php 
	session_start();
	$_SESSION = [];
	session_unset();
	session_destroy();


require 'connect.php';

$message = $_GET["message"];

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
		<p><?php echo $message; ?> to delete account<p>
	</div>

 	<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>
 </body>
 </html>
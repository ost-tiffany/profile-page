<?php 
session_start();
$timeout = 60000;
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

//orderlist data
$orderdata = "SELECT * FROM transaction";
$resultdata = $db->query($orderdata);

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

	<!-- Your Data Profile -->
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
	<?php }; ?>

	<!-- Your Order Data -->
	<h5  class="col-md-6 offset-md-3 head" style="margin-top:50px;">Order List</h5>

	<table class="col-md-6 offset-sm-5" style="text-align: left; width: 500px;">
	
		<tr>
			<th scope="row">Order No.</th>
			<th scope="row">Status</th>
			<th scope='row'>Detail</th>
	    </tr>
		<?php while ($hasilorder = $resultdata->fetch_assoc()) { ?>	
		<tr>
		    <td><?= $hasilorder["transaction_id"]; ?></td>
			<td> <? switch ($hasilorder["status"]) {
				case 1:
					echo "on process";
					break;
				case 2:
					echo "updated";
					break;
				case 3:
					echo "completed";
					break;
				case 4:
					echo "deleted";
					break;
				} ?>
			</td>
			<td><a href="detailorder.php?view=<?= $hasilorder["transaction_id"] ?>" class="btn btn-link" name="view" id="view" >view</a> </td>
	    </tr>
		<?php }; ?>
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

	<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>

</body>
</html>
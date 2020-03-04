<?php 
session_start();
$timeout = 3000;
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

$productwood = "SELECT * FROM products WHERE product_type = 1 AND delete_flag = 0";
$productresult = $db->query($productwood); 

$productother = "SELECT * FROM products WHERE product_type = 2 AND delete_flag = 0";
$otherresult = $db->query($productother); 



 ?>


<!DOCTYPE html>
<html lang="en">
<?php
	include('elements/header.php');
?>

	<title>Gallery</title>

	<!-- validation JS -->
	<script type="text/javascript" src="bootstrap/js/validating.js"></script>

<body>
	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

	 <!-- banner -->
	<img src="images/banner3.jpg" class="img-fluid banner" alt="sky">

	  <!-- content -->
	<h1  class="col-md-6 offset-md-3 head">Gallery </h1>


	<!-- navbar gallery -->

	<div class="dropdown col-4 col-md-4" >
  		<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" > Menu
  		</a>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="#upload">Upload</a>
			<a class="dropdown-item" href="#list">File List</a>
			<!-- <a class="dropdown-item" href="#update">Update</a>
			<a class="dropdown-item" href="#delete">Delete</a> -->
		</div>
	</div>
	

	<!-- Upload -->
		<h4 id='upload' class="col-md-6 offset-md-3">Upload here</h4>

		<form name="uploadform"  id="uploadform" action="confirmUpload.php" method="POST" enctype="multipart/form-data" class="center_form col-4 col-md-4" style="width:500px; text-align: left;">
			
			<div class="form-group">
				<label for="product_name">product name</label>
				<input type="text" class="form-control" id="product_name" name="product_name" placeholder="product name">
			</div>

			<div class="form-group">
				<label for="product_type">product type :</label>
					<select id="product_type" name="product_type" class="form-control">
  						<option name="product_type" value="0">Please choose</option>
  						<option name="product_type" value="1">Wood</option>
						<option name="product_type" value="2">others</option>
					</select>
			</div>

			<div class="form-group">
				<input type="file" class="form-control-file" id="uploadimage" name="uploadimage">
			</div>

			<input type="submit" class="btn btn-secondary btn-sm" id="submitupload" name="submitupload" value="upload" onclick=validate();>


			<div id="errorcontainer">
 				<p id="errormessage" style="color: red;"></p>
 			</div>

	</form>
	



	<!-- List Images -->
		<h4 id='list' class=" col-md-6 offset-md-3" style="margin-top:50px;">File List</h4>
		
		<div style="margin:10px;">
			<a  href="#wood">wood</a> |
			<a  href="#other">others</a>
		</div>
		
		<!-- wood -->
		<h5 class="col-4 col-md-5"> WOOD </h5>
		<div class="container" style="width:1000px;" name="wood" id="wood">	
			<div  class="row justify-content-md-center" >
				<?php $i = 1; ?>
					<?php foreach ($productresult as $prodrow) { ?>
						<div class="col-md-auto" style="margin-bottom:30px;">
							<a href="images/gallery/product/<?= $prodrow["product_id"] ?>/<?= $prodrow["product_image"] ?>"> 
								<img src="images/gallery/product/<?= $prodrow["product_id"] ?>/<?= $prodrow["product_image"] ?>" style="width:300px; height:300px; object-fit: cover;" class="img-fluid rounded-circle"> 
							</a> <br>

							<a href="edituser.php" type="submit" name="edit" id="edit" >edit</a> | 
							<a href="#" type="submit" name="delete" id="delete" onclick=confirmerase();>delete</a> <br>

							<?= $prodrow["product_name"] ?> <br>
							<p> creator : <strong> <?= $prodrow["created_by_user_name"] ?> </strong>
						</div>		
					<?php $i++; ?>
				<?php }; ?>
			</div>
		</div>

		<!-- other -->
		<h5 class="col-4 col-md-5"> OTHER </h5>
		<div class="container" style="width:1000px;" name="other" id="other">	
			<div  class="row justify-content-md-center" >
				<?php $i = 1; ?>
					<?php foreach ($otherresult as $othrow) { ?>
						<div class="col-md-auto" style="margin-bottom:30px;">
							<a href="images/gallery/product/<?= $othrow["product_id"] ?>/<?= $othrow["product_image"] ?>"> 
								<img src="images/gallery/product/<?= $othrow["product_id"] ?>/<?= $othrow["product_image"] ?>" style="width:300px; height:300px; object-fit: cover;" class="img-fluid rounded-circle"> 
							</a> <br>

							<a href="edituser.php" type="submit" name="edit" id="edit" >edit</a> | 
							<a href="#" type="submit" name="delete" id="delete" onclick=confirmerase();>delete</a> <br>

							<?= $othrow["product_name"] ?> <br>
							<p> creator : <strong> <?= $othrow["created_by_user_name"] ?> </strong><br>
							
						</div>		
					<?php $i++; ?>
				<?php }; ?>
			</div>
		</div>

	<!-- Update -->
		<!-- <h4 id='update' class="col-md-6 offset-md-3">Update</h4> -->
	<!-- delete -->
		<!-- <h4 id='delete' class="col-md-6 offset-md-3">Delete</h4> -->



	<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>





</body>
</html>
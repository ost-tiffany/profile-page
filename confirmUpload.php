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

	<title>Confirmation</title>

	<!-- validation JS -->
	<script type="text/javascript" src="bootstrap/js/validating.js"></script>

<body>
	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

	
	  <!-- content -->
	<h1  class="col-md-6 offset-md-3 head"> Looking good? </h1>



    <?php

		if (isset($_POST["submitupload"])) {

			 // nama product
			$namaproduct = $_POST['product_name'];

       		// tipe produk
			$selectedtipeproduct = $_POST['product_type'];
			$tipeprod =  $selectedtipeproduct == 1 ? "wood" : "others";	

        	// gambarnya
			$gambarnya = $_FILES['uploadimage']['name'];
        	$tempatgambarnya = $_FILES['uploadimage']['tmp_name']; 
				$target_dir = "images/gallery/product/temp/";
				//basename = buat tau file name from full path
            	$target_file = $target_dir  . basename($gambarnya);
            	move_uploaded_file($tempatgambarnya,$target_dir.$gambarnya);


			?>

			<form name="uploadform"  id="uploadform" action="action/doUpload.php" method="POST" enctype="multipart/form-data" class="center_form col-4 col-md-4" style="width:500px; text-align: left;">
			
				<div class="form-group">
					<label for="product_name">product name</label>
					<input class="form-control" type="hidden" name="product_name"  id="product_name" value="<?= $namaproduct ?>"> 
					<?= $namaproduct ?>
				</div>

				<div class="form-group">
					<label for="product_type">product type :</label>
						<input type="hidden" id="product_type" name="product_type" class="form-control" style="display_none"
						value="<?= $selectedtipeproduct;?>">
						<?=	$tipeprod?>
				</div>

				<div class="form-group">
					<input type="hidden" class="form-control-file" id="uploadimage"  type="hidden" name="uploadimage" value="<?= $target_file ?>">
					<input type="hidden" class="form-control-file" id="nameuploadimage"  type="hidden" name="nameuploadimage" value="<?= $gambarnya ?>">
					<img src="<?=$target_file ?>" alt="" class="img-thumbnail">
				</div>

				<input type="submit" class="btn btn-secondary btn-sm" id="submitupload" name="submitupload" value="upload"> 
				<a href="gallery.php" class="btn btn-secondary btn-sm" id="cancelupload" name="cancelupload" onclick=confirmupload();> cancel </a>

			</form>

	<?php	} ?>
	
			<script>
				document.getElementById('uploadform').addEventListener('click',function(event) {confirmupload(e);},false);
				function confirmupload(e){
            	var conf = confirm("Are you sure you want to go back? Your uploaded file will not be saved");
            		if(conf){
						document.location.href='gallery.php';
        			} else {
						event.preventDefault();
					}
        		}
			</script>


    <!-- footer -->
  	<?php
		include('elements/footer.php');
	?>



</body>
</html>
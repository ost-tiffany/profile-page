<?php 
session_start();
$timeout = 30000;
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

		if (isset($_POST["newsubmitupload"])) {

            //id product
            $idproduct = $_POST["product_id"];

			 // nama product
			$namaproduct = $_POST['product_name'];

       		// tipe produk
			$selectedtipeproduct = $_POST['product_type'];
			$tipeprod =  $selectedtipeproduct == 1 ? "wood" : "others";	

            // gambarnya yang baru
            $gambarnya = $_FILES['edituploadimage']['name'];
        	$tempatgambarnya = $_FILES['edituploadimage']['tmp_name']; 
				$target_dir = "images/gallery/product/temp/";
				//basename = buat tau file name from full path
            	$target_file = $target_dir  . basename($gambarnya);
                move_uploaded_file($tempatgambarnya,$target_dir.$gambarnya);
                
            //gambar lama
            $gambarlama = $_POST["oldimage"];

			?>

        <form name="editphotoform"  id="editphotoform" action="action/doEditPhoto.php" method="POST" enctype="multipart/form-data" class="center_form col-4 col-md-4" style="width:500px; text-align: left;">

        <div class="form-group">
                <label for="product_name">product number : </label>
                <input class="form-control" type="hidden" name="product_id"  id="product_id" value="<?= $idproduct ?>"> 
				<?= $idproduct ?>
		</div>
        
        <div class="form-group">
            <label for="product_name">product name :</label>
            <input class="form-control" type="hidden" name="product_name"  id="product_name" value="<?= $namaproduct ?>"> 
            <?= $namaproduct ?>
        </div>

        <div class="form-group">
            <label for="product_type">product type :</label>
                <input id="product_type" type="hidden" name="product_type" class="form-control" value="<?= $selectedtipeproduct ?>">
                <?= $selectedtipeproduct ?>  
        </div>

        <div class="form-group">
            <!-- gambar baru -->

            <?php if($gambarnya == '') { ?>

                <img src="images/gallery/product/<?= $idproduct ?>/<?= $gambarlama ?>" alt="" class="img-thumbnail">    
            <?php 
            } 
            
            else {
             ?>
                <input type="hidden" class="form-control-file" id="edituploadimage" name="edituploadimage"  value="<?= $target_file ?>">
                <input type="hidden" class="form-control-file" id="namedituploadimage" name="namedituploadimage"  value="<?= $gambarnya ?>">

                <!-- gambar lama -->
                <input type="hidden" id="oldimage" name="oldimage"  value="<?= $gambarlama ?>">
                <img src="<?=$target_file ?>" alt="" class="img-thumbnail">    
            <?php 
            }
            ?>
            
		</div>


        <div style="margin-top:30px;">
        <input type="submit" class="btn btn-secondary btn-sm" id="newsubmitupload" name="submitupload" value="upload"> 
        <a href="gallery.php" class="btn btn-secondary btn-sm" id="cancelupload" name="cancelupload" onclick=confirmcancelupld();> cancel </a>
        </div>
    </form>

	<?php	} ?>
	
			<script>
				document.getElementById('editphotoform').addEventListener('click',function(event) {confirmcancelupld(e);},false);
				function confirmcancelupld(e){
            	var conf = confirm("Are you sure you want to go back? Your edited file will not be saved");
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
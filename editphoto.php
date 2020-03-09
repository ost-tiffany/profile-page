<?php 
 session_start();
 $timeoutedit = 60;
	if (!isset($_SESSION["login"])) {
		header("Location: login.php");
		exit;
	}
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeoutedit)) {
    // last request was more than 30 minutes ago
    	session_unset();     // unset $_SESSION variable for the run-time 
    	session_destroy();   // destroy session data in storage
    	header("Location: login.php?error=no activity for 60s");
	}

	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


require'connect.php';

$id=$_GET["id"];
$photoprev = "SELECT * FROM products WHERE product_id = '$id'";
$resultphotoprev = $db->query($photoprev);

 ?>

 <!DOCTYPE html>
 <html>
	<?php
		include('elements/header.php');
	?>

 	<title>Edit Account</title>


 <body>

 	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

    <!-- content -->
	<h1  class="col-md-6 offset-md-3 head">Edit Photo?</h1>

    <?php while ($rownya = $resultphotoprev->fetch_assoc()) { ?>
        <form name="editphotoform"  id="editphotoform" action="confirmeditupload.php" method="POST" enctype="multipart/form-data" class="center_form col-4 col-md-4" style="width:500px; text-align: left;">
        
			<div class="form-group">
                <label for="product_name">product number : </label>
                <input class="form-control" type="hidden" name="product_id"  id="product_id" value="<?= $rownya["product_id"] ?>"> 
				<?= $rownya["product_id"] ?>
			</div>

            <div class="form-group">
                <label for="product_name">product name :</label>
                <input class="form-control" type="text" name="product_name"  id="product_name" value="<?= $rownya["product_name"] ?>"> 
            </div>

            <div class="form-group">
				<label for="product_type">product type :</label>
					<select id="product_type" name="product_type" class="form-control" value=<?= $rownya["product_type"] ?>
  						<option name="product_type" value="0">Please choose</option>
  						<option name="product_type" value="1" <?php echo($rownya["product_type"]=='1')?'selected':'' ?>>Wood</option>
						<option name="product_type" value="2" <?php echo($rownya["product_type"]=='2')?'selected':'' ?>>others</option>
					</select>
			</div>

            <div class="form-group">
				<input type="file" class="form-control-file" id="edituploadimage" name="edituploadimage"  value="">
                <input type="hidden" id="oldimage" name="oldimage"  value="<?= $rownya["product_image"] ?>">
                <img src="images/gallery/product/<?= $rownya["product_id"] ?>/<?= $rownya["product_image"] ?>" style="width:300px; height:300px; object-fit: cover;" class="img-thumbnail"> 


            <div style="margin-top:30px;">
            <input type="submit" class="btn btn-secondary btn-sm" id="newsubmitupload" name="newsubmitupload" value="upload"> 
            <a href="gallery.php" class="btn btn-secondary btn-sm" id="cancelupload" name="cancelupload" onclick=confirmcancelupld();> cancel </a>
            </div>
        </form>
    
    <?php } ?>

 	<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>


<script>
        document.getElementById('uploadform').addEventListener('click',function(event) {confirmcancelupld(e);},false);
        function confirmcancelupld(e){
        var conf = confirm("go back?");
            if(conf){
                document.location.href='gallery.php';
            } else {
                event.preventDefault();
            }
        }
    </script>


 </body>
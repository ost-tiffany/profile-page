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

//pagination
$perpage = 6;
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$start = ($page > 1) ? ($page * $perpage) - $perpage : 0;

if (isset($_GET["types"])) {
	$carihalaman = "SELECT * FROM products WHERE product_type= ".$_GET['types']." AND delete_flag = 0 LIMIT $start, $perpage";
	$resultDBhalaman = $db->query($carihalaman);
}

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

	<div>
    	<?php
    		if(isset($_GET["note"])) {
				echo $_GET["note"];
    		 } 
    	?>
    </div>


	  <!-- content -->
	<h1  class="col-md-6 offset-md-3 head">Gallery </h1>


	<!-- navbar gallery -->

	<div class="dropdown col-4 col-md-4" >
  		<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" > Menu
  		</a>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			<a class="dropdown-item" href="#upload">Upload</a>
			<a class="dropdown-item" href="#list">File List</a>
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
	<form name="listimages" id="Listimages" action="" method="GET">
		<h4 id='list' class="col-md-6 offset-md-3" style="margin-top:50px;">File List</h4>
		
		<div style="margin:10px;">
			<button type="submit" name="types" id="woodlist" value ="1" class="btn btn-link">Wood</button> |
			<button type="submit" name="types" id="otherlist" value ="2" class="btn btn-link">Other</button>
		</div>
	</form>

	<!-- search -->
	<form name="searchone" id="searchone" action="" method=GET class="input-group input-group-sm mb-3 col-md-6 offset-md-2" style="width:300px;">
			<input type="text" name="carii" id="carii" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"  placeholder="search">
				<div class="input-group-prepend">
    				<button type="submit" id="caributton" name="caributton" class="btn btn-outline-secondary" id="inputGroup-sizing-sm" onclick=search();>search</button>
  				</div>
			<p id="errormessagesearch" style="color: red;"></p>
	</form>

		<?php

		if(isset($_GET["carii"])) {
			$carii = $_GET["carii"];

			$cari = "SELECT * FROM products 
					WHERE (product_name LIKE '%$carii%' OR
						product_type LIKE '%$carii%' OR
						created_by_user_name LIKE '%$carii%' OR
						updated_by_user_id LIKE '%$carii%' OR
						product_id LIKE '%$carii%') AND
						delete_flag = 0";

			$cariDB = $db->query($cari);

				if($cariDB->num_rows == 0) {
					echo "no data match your search";
				}

				if ($cariDB->num_rows > 0) { ?>

					<h5 class="col-4 col-md-5"> <strong>　Files found for <?=$_GET["carii"];?> </strong> </h5>
					<hr style="width: 1000px; margin-bottom: 10px">
				
					<div class="container" style="width:1000px;" name="search" id="search">	
						<div  class="row justify-content-md-center" >

							<?php foreach ($cariDB as $searchrow) { ?>
								<div class="col-md-auto" style="margin-bottom:30px;">
									<a href="images/gallery/product/<?= $searchrow["product_id"] ?>/<?= $searchrow["product_image"] ?>"> 
									<img src="images/gallery/product/<?= $searchrow["product_id"] ?>/<?= $searchrow["product_image"] ?>" style="width:300px; height:300px; object-fit: cover;" class="img-fluid rounded-circle"> 
									</a> 
									<br>

									<a href="editphoto.php?id=<?= $searchrow["product_id"] ?>" type="submit" name="edit" id="edit" >edit</a> | 
									<a href="action/doErasePhoto.php?id=<?= $searchrow["product_id"]?>" type="submit" name="delete" id="delete" onclick=confirmerase();>delete</a> 
									<br>

									<?= $searchrow["product_name"] ?> <br>
									<p> creator : <strong> <?= $searchrow["created_by_user_name"] ?> </strong> </p>
								</div>		
							<?php }; ?>
						</div>
					</div>
			<?php	}
		}

		//type == woodlist
		//type == others
		if (isset($_GET["types"])) {
			$productwoodall = "SELECT * FROM products WHERE product_type = ".$_GET['types']." AND delete_flag = 0";
			$productresultall = $db->query($productwoodall);  ?>

				<h5 class="col-4 col-md-5"> <strong><?= $_GET['types'] == 1 ? "Wood" : "Others" ?></strong> </h5>
				<hr style="width: 1000px; margin-bottom: 10px">

				<div class="container" style="width:1000px;" name="woodlistall" id="woodlistall">	
					<div  class="row justify-content-md-center" >
							<?php foreach ($resultDBhalaman as $prodrowall) { ?>
								<div class="col-md-auto" style="margin-bottom:30px;">
									<a href="images/gallery/product/<?= $prodrowall["product_id"] ?>/<?= $prodrowall["product_image"] ?>"> 
										<img src="images/gallery/product/<?= $prodrowall["product_id"] ?>/<?= $prodrowall["product_image"] ?>" style="width:300px; height:300px; object-fit: cover;" class="img-fluid rounded-circle"> 
									</a> <br>

									<a href="editphoto.php?id=<?= $prodrowall["product_id"] ?>" type="submit" name="edit" id="edit" >edit</a> | 
									<a href="action/doErasePhoto.php?id=<?= $prodrowall["product_id"] ?>" type="submit" name="delete2" id="delete2" onclick=confirmerase();>delete</a> <br>

									<?= $prodrowall["product_name"] ?> <br>
									<p> creator : <strong> <?= $prodrowall["created_by_user_name"] ?> </strong> </p>
								</div>		
						<?php }; ?>
					</div>
				</div>

			<?php 
			$total = mysqli_num_rows($productresultall); //ngitung hasil data yang dimunculin
			$pages = ceil($total/$perpage);
			?>

			<div class="justify-content-center">
				<?php if ($page > 1) { ?>
					<a href="?types=<?= $_GET['types'] ?>&page=<?= $i - 1; ?>">&lt;</a>
				<?php } ?>

				<?php for($i=1; $i<=$pages; $i++) { ?>
					<a href="?types=<?= $_GET['types'] ?>&page=<?= $i ?>"> <?= $i ?></a>
				<?php }  ?>

				<?php if ($page < $pages) { ?>
					<a href="?types=<?= $_GET['types'] ?>&page=<?= $i + 1; ?>">&gt;</a>
				<?php } ?>
			</div>
	<?php
	}
		// kalo yang lain
		else { ?>
			<!-- ichiran -->
			<?php
			//looping berdasarkan product_type 
			$type_query = "select product_type from products group by product_type";
			$exec = $db->query($type_query);

			foreach($exec as $row) {
				// echo $row["product_type"]."<br>";
				
			$productother = "SELECT * FROM products WHERE product_type = ".$row["product_type"]."  AND delete_flag = 0 ORDER BY product_id DESC LIMIT 5";
			$otherresult = $db->query($productother); 
				?>
				<h5 class="col-4 col-md-5"> <strong> <?= $row["product_type"] == 1 ? "Wood" : "Others" ; ?></strong> </h5>
				<hr style="width: 1000px; margin-bottom: 10px">
	
				<div class="container" style="width:1000px;" name="other" id="other">	
					<div  class="row justify-content-md-center" >
							<?php foreach ($otherresult as $othrow) { ?>
								<div class="col-md-auto" style="margin-bottom:30px;">
									<a href="images/gallery/product/<?= $othrow["product_id"] ?>/<?= $othrow["product_image"] ?>"> 
										<img src="images/gallery/product/<?= $othrow["product_id"] ?>/<?= $othrow["product_image"] ?>" style="width:150px; height:150px; object-fit: cover;" class="img-fluid rounded-circle"> 
									</a> <br>
	
									<a href="editphoto.php?id=<?= $othrow["product_id"] ?>" type="submit" name="edit" id="edit" >edit</a> | 
									<a href="action/doErasePhoto.php?id=<?= $othrow["product_id"] ?>" type="submit" name="delete" id="delete" onclick=confirmerase();>delete</a> <br>
	
									<?= $othrow["product_name"] ?> <br>
									<p> creator : <strong> <?= $othrow["created_by_user_name"] ?> </strong><br> </p>								
								</div>		
						<?php }; ?>
					</div>
				</div>
			<?php } ?>
		<?php } ?>	

	<!-- footer -->
	<?php
		include('elements/footer.php');
	?>

<!-- validation JS -->
<script type="text/javascript" src="bootstrap/js/validating.js"></script>


</body>
</html>
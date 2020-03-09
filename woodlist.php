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

$perpage = 6; //mau berapa data di 1 page
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1; //kalo ga ada halnya, jadi hal 1
$start = ($page > 1) ? ($page * $perpage) - $perpage : 0; //next halaman bisa hitung sendiri

$carihalaman = "SELECT * FROM products WHERE product_type= 1 AND delete_flag = 0 LIMIT $start, $perpage"; //berapa banyak data yang bisa dipakein (bukan yang dimunculin, cuma kek itungin aja)

$resultDBhalaman = $db->query($carihalaman); //berapa banyak files sebenernya


$productwood = "SELECT * FROM products WHERE product_type = 1 AND delete_flag = 0";
$productresult = $db->query($productwood); 


 ?>

<!DOCTYPE html>
<html lang="en">
<?php
	include('elements/header.php');
?>

	<title>Wood List</title>

	<!-- validation JS -->
	<script type="text/javascript" src="bootstrap/js/validating.js"></script>

<body>
	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

	 <!-- banner -->
     <img src="images/banner6.jpg" class="img-fluid banner" alt="sky">

	  <!-- content -->
	<h1  class="col-md-6 offset-md-3 head"> Wood collections </h1>


	<!-- search -->
		<form name="searchone" id="searchone" action="search.php" method=POST class="input-group input-group-sm mb-3 col-md-6 offset-md-2" style="width:300px;">
  			<input type="text" name="carii" id="carii" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"  placeholder="name/creator">
				<div class="input-group-prepend">
    				<button type="submit" id="caributton" name="caributton" class="btn btn-outline-secondary" id="inputGroup-sizing-sm" onclick=search();>search</button>
  				</div>
			<p id="errormessagesearch" style="color: red;"></p>
		</form>


		<!-- ichiran -->
		
		<!-- wood -->
		<h5 class="col-4 col-md-5"> <strong>　WOOD</strong> </h5>
		
		<hr style="width: 1000px; margin-bottom: 10px">

		<div class="container" style="width:1000px;" name="wood" id="wood">	
			<div  class="row justify-content-md-center" >
				<?php $i = 1; ?>
					<?php foreach ($resultDBhalaman as $prodrow) { ?>
						<div class="col-md-auto" style="margin-bottom:30px;">
							<a href="images/gallery/product/<?= $prodrow["product_id"] ?>/<?= $prodrow["product_image"] ?>"> 
								<img src="images/gallery/product/<?= $prodrow["product_id"] ?>/<?= $prodrow["product_image"] ?>" style="width:300px; height:300px; object-fit: cover;" class="img-fluid rounded-circle"> 
							</a> <br>

							<a href="editphoto.php?id=<?= $prodrow["product_id"] ?>" type="submit" name="edit" id="edit" >edit</a> | 
							<a href="action/doErasePhoto.php?id=<?= $prodrow["product_id"] ?>" type="submit" name="delete2" id="delete2" onclick=confirmerase();>delete</a> <br>

							<?= $prodrow["product_name"] ?> <br>
							<p> creator : <strong> <?= $prodrow["created_by_user_name"] ?> </strong>
						</div>		
					<?php $i++; ?>
				<?php }; ?>

		<?php 
		$total = mysqli_num_rows($productresult); //ngitung hasil data yang dimunculin
		$pages = ceil($total/$perpage);
		?>

		<div class="col-4 col-md-5 justify-content-center">
			<?php if ($page > 1) { ?>
				<a href="?page=<?= $i - 1; ?>">&lt;</a>
			<?php } ?>

			<?php for($i=1; $i<=$pages; $i++) { ?>
				<a href="?page=<?= $i ?>"> <?= $i ?></a>
			<?php }  ?>

			<?php if ($page < $pages) { ?>
				<a href="?page=<?= $i + 1; ?>">&gt;</a>
			<?php } ?>
		</div>

	<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>

</body>
</html>
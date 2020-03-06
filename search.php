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

$perpage = 6; //mau berapa data di 1 page
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1; //kalo ga ada halnya, jadi hal 1
$start = ($page > 1) ? ($page * $perpage) - $perpage : 0; //next halaman bisa hitung sendiri

?>


<!DOCTYPE html>
<html lang="en">
<?php
	include('elements/header.php');
?>

	<title>Search</title>


    <body>

	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

	  <!-- content -->
	<h1  class="col-md-6 offset-md-3 head">Search </h1>

	<?php if (isset($_POST["caributton"])) {

        $carii = $_POST["carii"];


        $carihalaman = "SELECT * FROM products 
                        WHERE (product_name LIKE '%$carii%' OR
                                product_type LIKE '%$carii%' OR
                                created_by_user_name LIKE '%$carii%' OR
                                updated_by_user_id LIKE '%$carii%' OR
                                product_id LIKE '%$carii%') LIMIT $start, $perpage"; 
        //berapa banyak data yang bisa dipakein (bukan yang dimunculin, cuma kek itungin aja)
        $resultDBhalaman = $db->query($carihalaman); //berapa banyak files yang mau di show 1 halaman


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

                <h5 class="col-4 col-md-5"> <strong>　Files found for <?=$carii?> </strong> </h5>
				<hr style="width: 1000px; margin-bottom: 10px">

                <div class="container" style="width:1000px;" name="search" id="search">	
                    <div  class="row justify-content-md-center" >
                        <?php $i = 1; ?>
                        <?php foreach ($resultDBhalaman as $searchrow) { ?>
                            <div class="col-md-auto" style="margin-bottom:30px;">
                                <a href="images/gallery/product/<?= $searchrow["product_id"] ?>/<?= $searchrow["product_image"] ?>"> 
                                <img src="images/gallery/product/<?= $searchrow["product_id"] ?>/<?= $searchrow["product_image"] ?>" style="width:300px; height:300px; object-fit: cover;" class="img-fluid rounded-circle"> 
                                </a> 
                                <br>

                                <a href="editphoto.php?id=<?= $searchrow["product_id"] ?>" type="submit" name="edit" id="edit" >edit</a> | 
                                <a href="action/doErasePhoto.php?id=<?= $searchrow["product_id"]?>" type="submit" name="delete" id="delete" onclick=confirmerasesearch();>delete</a> 
                                <br>

                                <?= $searchrow["product_name"] ?> <br>
                                 <p> creator : <strong> <?= $searchrow["created_by_user_name"] ?> </strong> </p>
                            </div>		
                        <?php $i++; ?>
                        <?php }; ?>
                    </div>
                </div>

                <?php 
		            $total = mysqli_num_rows($cariDB); //ngitung hasil data yang dimunculin
		            $pages = ceil($total/$perpage);
		        ?>

		<div class="col-4 col-md-5 justify-content-center">
			<?php if ($page > 1) { ?>
				<a href="?carii&page=<?= $i - 1; ?>">&lt;</a>
			<?php } ?>

			<?php for($i=1; $i<=$pages; $i++) { ?>
				<a href="?caributton&page=<?= $i ?>"> <?= $i ?></a>
			<?php }  ?>

			<?php if ($page < $pages) { ?>
				<a href="?caributton&page=<?= $i + 1; ?>">&gt;</a>
			<?php } ?>
		</div>
                
    <?php	} 
    } ?>
    
    <script>

    document.getElementById('delete').addEventListener('click',function(event) {confirmerasesearch(e);},false);
        function confirmerasesearch(){
        var conf = confirm("Are you sure you want to delete this photo?");
            if(!conf){
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
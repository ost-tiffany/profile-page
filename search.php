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
                <div class="container" style="width:1000px;" name="search" id="search">	
                    <div  class="row justify-content-md-center" >
                        <?php $i = 1; ?>
                        <?php foreach ($cariDB as $searchrow) { ?>
                            <div class="col-md-auto" style="margin-bottom:30px;">
                                <a href="images/gallery/product/<?= $searchrow["product_id"] ?>/<?= $searchrow["product_image"] ?>"> 
                                <img src="images/gallery/product/<?= $searchrow["product_id"] ?>/<?= $searchrow["product_image"] ?>" style="width:300px; height:300px; object-fit: cover;" class="img-fluid rounded-circle"> 
                                </a> 
                                <br>

                                <a href="editphoto.php?id=<?= $searchrow["product_id"] ?>" type="submit" name="edit" id="edit" >edit</a> | 
                                <a href="action/doErasePhoto.php?id=<?= $searchrow["product_id"]?>" type="submit" name="delete" id="delete" onclick=confirmerasesearch();>delete</a> 
                                <br>

                                <?= $searchrow["product_name"] ?> <br>
                                 <p> creator : <strong> <?= $searchrow["created_by_user_name"] ?> </strong>
                            </div>		
                        <?php $i++; ?>
                        <?php }; ?>
                    </div>
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
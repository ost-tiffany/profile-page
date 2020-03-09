<?php 

include 'connect.php';

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
<?php	} ?>
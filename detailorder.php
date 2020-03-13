<?php 
session_start();
$timeout = 600000;
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

//orderlist data

$orderno = $_GET["view"];
$orderlist = "SELECT transaction.transaction_id, `address`,`memo`,`status`, detail_transaction.product_id, `quantity`, product_name , product_image FROM `transaction` JOIN detail_transaction ON transaction.transaction_id = detail_transaction.transaction_id JOIN products ON detail_transaction.product_id = products.product_id WHERE transaction.transaction_id = '$orderno' ";
$resultorder = $db->query($orderlist);

 ?>


<!DOCTYPE html>
<html lang="en">

<?php
	include('elements/header.php');
?>

	<title>Contact</title>


<body>

	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

	 <!-- banner -->


	 <!-- content -->
    <?php while ($hasilorder = $resultorder->fetch_assoc()) { ?>
    
    <table class="col offset-md-3" style="text-align: left; width: auto;">
        <tr>
            <td class="col-md-3">Order No.</td>
            <td><?=$hasilorder['transaction_id']?></td>
        </tr>
        <tr>
            <td class="col-md-3">Address :</td>
            <td><?= $hasilorder["address"] ?></td>
        </tr>
        <tr>
            <td class="col-md-3" colspan="2">
                <a href="editorder.php?orderno=<?=$hasilorder['transaction_id']?>" class="btn btn-secondary" type="button" name="edit" id="edit" >Edit</a> &nbsp;
                <a href="cancelorder.php?orderno=<?=$hasilorder['transaction_id']?>" class="btn btn-light" type="button" name="edit" id="edit" >Cancel</a> &nbsp;
                <a href="deleteorder.php?orderno=<?=$hasilorder['transaction_id']?>" class="btn btn-dark" type="button" name="edit" id="edit" >Delete</a>
            </td>
        </tr>
    </table>

	<table class="table table-striped col-md-6 offset-md-3" style="text-align: left;">
		<tr>
			<th scope="row">List Item</th>
            <th scope='row'>Image</th>
			<th scope='row'>Quantity</th>
	    </tr>
        <?php foreach ($resultorder as $resultss) { ?>
            <tr>
                <td class="col-md-3"><?= $resultss["product_id"]; ?> - <?= $resultss["product_name"]; ?> </td>
                <td class="col-md-3"><img src="images/gallery/product/<?=$resultss["product_id"];?>/<?=$resultss["product_image"]?>" style="width:150px;"></td>
                <td><?= $resultss["quantity"] ?></td>
            </tr>
		<?php } ?>
	</table>
	<?php }; ?>
	

<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>


</body>
</html>
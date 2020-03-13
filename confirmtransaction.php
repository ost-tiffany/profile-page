<?php 
session_start();
$timeout = 60000;
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

$date = $_POST["date"];
$address = $_POST["address"];
$memo = $_POST["memo"];
$buyerid = $_SESSION["user_id"];
$buyername = $_SESSION["user_name"];

 ?>


<!DOCTYPE html>
<html lang="en">

<?php
	include('elements/header.php');
?>

<!-- js -->
<script type="text/javascript" src="bootstrap/js/validating.js"></script>

<!-- select2 -->
<link href="bootstrap/css/select2.min.css" rel="stylesheet" />
<script src="bootstrap/js/select2.min.js"></script>

	<title>Confirm Transaction Form</title>


<body>

	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

	 <!-- content -->
	<h1  class="col-md-6 offset-md-3 head">Confirm Order</h1>

	<form name="transactionform"  id="transactionform" action="action/doTransactionOrder.php" method="POST" class="rows center_form" style="width: 600px; text-align: left;">

		<div class="form-group">
			<label for="date" >Order Date :</label>
			<input type="hidden" class="form-control" id="date" name="date" value="<?= $_POST["date"] ?>">
            <?= $_POST["date"] ?>
	  	</div>

		<div class="form-group">
			<label for="Address">Address :</label>
			<input type="hidden" class="form-control" id="address" name="address" value="<?= $_POST["address"] ?>">
            <?= $_POST["address"] ?>
		</div>

		<div class="form-group">
			<label for="memo">Memo :</label>
			<input class="form-control" type="hidden" id="memo" name="memo" value="<?= $_POST["memo"] ?>" >
            <?= $_POST["memo"] ?>
		</div>

		<hr style="width: 200px; margin-bottom: 10px">
		
		<div id="confirmtransactiondetail" name="confirmtransactiondetail" class="form-group" >
            <label for="item">Item :</label>
            <?php   $items = $_POST["item"];
                    $qtys = $_POST["quantity"]; ?>
			
                <?php foreach ($items as $index=>$item) {
                     $listproductall = $db->query("SELECT * FROM products WHERE product_id = '$item'");
                        while ($list =  $listproductall->fetch_assoc()) { ?>
                            <input type="hidden" class="form-control" id="item" name="item[]" value='<?= $item ?>'>
							
                            <input type="hidden" class="form-control" id="quantity" name="quantity[]" value=<?php echo $qtys[$index] ?>>
							
                            <?= '<br><strong>'. $list["product_id"] .' - '. $list["product_name"] .'</strong><br> Quantity : '. $qtys[$index] . '<br> <img src="images/gallery/product/'. $list["product_id"] . '/' . $list["product_image"] . ' " class="img-thumbnail" style="width:200px;"> <br>'?>
                        <?php }  ?>
			    <?php }; ?>
		</div>

		<div id="errorcontainer">
 			<p id="errororder" style="color: red;"></p>
 		</div>

		<a href="index.php" type="submit" class="btn btn-dark" name="cancel" id="cancel" onclick=confirmcancel()>cancel</a>
		<button type="submit" name="order" id="order" class="btn btn-secondary" onclick= confirmorder() >Are you sure?</button>
	</form>

	<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>
</body>
</html>
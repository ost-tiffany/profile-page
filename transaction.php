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

 ?>


<!DOCTYPE html>
<html lang="en">

<?php
	include('elements/header.php');
?>

<!-- select2 -->
<link href="bootstrap/css/select2.min.css" rel="stylesheet" />
<script src="bootstrap/js/select2.min.js"></script>

	<title>Transaction Form</title>


<body>

	<!-- nav -->
	<?php
		include('elements/navbar.php');
	?>

	 <!-- content -->
	<h1  class="col-md-6 offset-md-3 head">Transaction Form</h1>

	<form name="transactionform"  id="transactionform" action="action/doTransactionOrder.post" method="POST" class="rows center_form" style="width: 600px; text-align: left;">

		<div class="form-group">
			<label for="date" class="col-sm-2 col-form-label">Date</label>
			<input type="date" class="form-control" id="date" name="date" value="<?= date("Y-m-d",time()) ?>">
	  	</div>

		<div class="form-group">
			<label for="Address">Address</label>
			<input type="text" class="form-control" id="dddress" name="address" placeholder="1234 Main St">
		</div>

		<div class="form-group">
			<label for="memo">Memo</label>
			<textarea class="form-control" id="memo" name="memo" rows="3" placeholder="write your message here"></textarea>
		</div>

		<hr style="width: 200px; margin-bottom: 10px">

		<div class="form-row col-md-12">
				<button type="button" name="adding" id="adding" onclick=add() class="btn btn-light btn-sm btn-block">add new row</button>
		</div>

		
		<div id="transactiondetail" name="transactiondetail" class="form-row">
			<?php for ($i=1; $i<=3 ; $i++) { $listproductall = $db->query("SELECT * FROM products WHERE delete_flag = 0");?>
			<div class="form-group col-md-6">
				<label for="item">Item</label>
					<select class="js-example-basic-single form-control" id="item" name="item[]">
						<?php foreach ($listproductall as $row) { ?>
							<option value='<?=$row["product_id"] ?>'><?=$row["product_id"] .' - '. $row["product_name"] ?></option>
						<?php }; ?>
					</select>
			</div>
			<div class="form-group col-md-3">
				<label for="quantity">Qty</label>
				<input type="number" class="form-control" id="quantity" name="quantity[]" min="0">
			</div>
			<div class="form-group col-md-">
				<button type="button" name="deleterow" id="deleterow" onclick="deleterow(this)" class="btn btn-danger" style="margin-top:30px">delete</button>
			</div>
			<?php }?>
		</div>



		<a href="index.php" type="submit" class="btn btn-dark" name="cancel" id="cancel" onclick=confirmcancel()>cancel</a>
		<button type="submit" name="order" id="order" class="btn btn-secondary">Submit</button>
	</form>

	<!-- footer -->
  	<?php
		include('elements/footer.php');
	?>

	<!-- validation JS -->
	<script type="text/javascript" src="bootstrap/js/validating.js"></script>
	<script>

	function add(){
		<?php $listproductall = $db->query("SELECT * FROM products WHERE delete_flag = 0"); ?>
		var product = '<div class="form-group col-md-6"><label for="item">Item</label><select class="js-example-basic-single form-control" id="item" name="item[]"><?php foreach ($listproductall as $row) { ?><option value="<?=$row['product_id'] ?>"><?=$row["product_id"] .' - '. $row["product_name"] ?></option><?php }; ?></select></div>';

		var qty = '<div class="form-group col-md-3"><label for="quantity">Qty</label><input type="number" class="form-control" id="quantity" name="quantity[]" min="0"></div>';
		 
		$("#transactiondetail").append('<div id="transactiondetail" name="transactiondetail" class="form-row">' + product + qty + '<div class="form-group col-md-"><button type="button" name="deleterow" id="deleterow" onclick="deleterow(this)" class="btn btn-danger" style="margin-top:30px">delete</button></div></div>');
		};
		

	function deleterow(r) {
		//delete row
		var i = r.parentNode.parentNode.rowIndex;
           $("#transactiondetail").remove(i); 

	}

	// $("#deleterow").click(function() {
	// 	$("#transactiondetail").remove();
	// 	});

	</script>
</body>
</html>
<?php

session_start();

include '../connect.php';

$date = $_POST["date"];
$address = $_POST["address"];
$memo = $_POST["memo"];
$items = $_POST["item"];
$qtys = $_POST["quantity"];
$buyerid = $_SESSION["user_id"];
$buyername = $_SESSION["user_name"];
$status = 1;


$resultA = $db->query("INSERT INTO transaction (address, memo, transaction_date, status, created_by_user_id, created_by_user_name) VALUES ('$address', '$memo', '$date', '$status', '$buyerid','$buyername')");

//buat key yang nyambung ama detail transaction =
//ALTER TABLE detail_transaction ADD FOREIGN KEY (transaction_id) REFERENCES transaction (transaction_id)

if($resultA) {
    $id = $db->insert_id;
    for ($i=0; $i < count($items) ; $i++) { 
        $item = $items[$i];
        $qty = $qtys[$i];
        $query = "INSERT INTO detail_transaction(transaction_id, product_id, quantity, created_by_user_id, created_by_user_name) VALUES ('$id','$item', '$qty', '$buyerid','$buyername')";
        $db->query($query);
    }

    header("Location:../transactionsuccess.php?order=success");
} 

else {

    header("Location:../transactionsuccess.php?order=fail");
}




?>
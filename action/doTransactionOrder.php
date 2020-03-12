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


$resultA = $db->query("INSERT INTO transaction (address, memo, transaction_date, created_by_user_id, created_by_user_name) VALUES ('$address', '$memo', '$date','$buyerid','$buyername')");

//buat key yang nyambung ama detail transaction =
//ALTER TABLE detail_transaction ADD FOREIGN KEY (transaction_id) REFERENCES transaction (transaction_id)

if($resultA) {

    // foreach ($items as $index => $item) {
    //     $id = $db->insert_id;
    //     $qty = $qtys[$index];
    
    //     $resultB = $db->query("INSERT INTO detail_transaction (transaction_id, product_id, quantity, created_by_user_id, created_by_user_name) VALUES ('$id', '$item','$qty','$buyerid','$buyername')");
    //     //echo $item . '->' . $qty . '->' . $buyerid. '->'. $buyername .'<br>';
    // }

    for ($i=0; $i < count($items) ; $i++) { 
        $item = $items[$i];
        $qty = $qtys[$i];
        $id = $db->insert_id;

        $resultB = $db->query("INSERT INTO detail_transaction (transaction_id, product_id, quantity, created_by_user_id, created_by_user_name) VALUES ('$id', '$item','$qty','$buyerid','$buyername')");

    }
}




?>
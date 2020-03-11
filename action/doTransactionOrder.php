<?php

session_start();

include '../connect.php';

$date = $_POST["date"];
$address = $_POST["address"];
$memo = $_POST["memo"];
$items = $_POST["item[]"];
$qtys = $_POST["quantity[]"];
$buyerid = $_SESSION["user_id"];
$buyername = $_SESSION["user_name"];


foreach ($items as $index=>$item) {
    $qty = $qtys["$index"];

    $result = $db->query("INSERT INTO detail_transaction (product_id, quantity, created_by_user_id , created_by_user_name) VALUES ('$item','$qty', '$buyerid' , '$buyername')");
}


?>
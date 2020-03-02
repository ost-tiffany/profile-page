<?php
session_start();

include '../connect.php';


$sizegambarnya = $_FILES['uploadimage']['size']; 
$errorgambarnya = $_FILES['uploadimage']['error']; 
$tempatgambarnya = $_FILES['uploadimage']['tmp_name']; 


 ?>